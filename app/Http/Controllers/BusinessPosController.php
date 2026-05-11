<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pos\StorePosAppointmentRequest;
use App\Http\Requests\Pos\StorePosCustomerRequest;
use App\Http\Requests\Pos\StorePosExpenseRequest;
use App\Http\Requests\Pos\StorePosProductRequest;
use App\Http\Requests\Pos\StorePosRoomChairRequest;
use App\Http\Requests\Pos\StorePosSaleRequest;
use App\Http\Requests\Pos\StorePosServiceRequest;
use App\Http\Requests\Pos\StorePosStaffRequest;
use App\Models\Branch;
use App\Models\Business;
use App\Models\Membership;
use App\Models\RoomChair;
use App\Models\Sale;
use App\Models\User;
use App\Services\Pos\AppointmentService;
use App\Services\Pos\PosReferenceGenerator;
use App\Services\Pos\PosReportService;
use App\Services\Pos\SaleProcessor;
use App\Support\BusinessConsoleSchema;
use App\Support\PosOptions;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BusinessPosController extends Controller
{
    public function __construct(
        private readonly AppointmentService $appointmentService,
        private readonly PosReferenceGenerator $referenceGenerator,
        private readonly PosReportService $reportService,
        private readonly SaleProcessor $saleProcessor,
    ) {
    }

    public function index(Request $request): View|RedirectResponse
    {
        if ($redirect = $this->posModuleUnavailableRedirect()) {
            return $redirect;
        }

        $context = $this->ownerContext($request);

        if ($context instanceof RedirectResponse) {
            return $context;
        }

        ['business' => $business, 'accountSetup' => $accountSetup, 'profileReady' => $profileReady, 'email' => $email] = $context;

        $branch = $this->ensurePrimaryBranch($business);
        $this->ensureStarterResources($business, $branch);

        $report = $this->reportService->build($business);
        $customers = $business->customers()->with('membership', 'preferredStaff')->orderBy('full_name')->get();
        $staffMembers = $business->staffMembers()->orderBy('full_name')->get();
        $services = $business->services()->orderBy('name')->get();
        $products = $business->products()->orderBy('name')->get();
        $branches = $business->branches()->orderByDesc('is_primary')->orderBy('name')->get();
        $resources = RoomChair::query()->where('business_id', $business->id)->orderBy('resource_type')->orderBy('name')->get();
        $appointmentsCalendar = $business->appointments()
            ->with(['customer', 'service', 'staff', 'roomChair'])
            ->whereBetween('booking_date', [now()->toDateString(), now()->addDays(6)->toDateString()])
            ->orderBy('booking_date')
            ->orderBy('start_time')
            ->get()
            ->groupBy(fn ($appointment) => $appointment->booking_date?->format('Y-m-d') ?? (string) $appointment->booking_date);
        $lastReceipt = session('receipt_sale_id')
            ? $business->sales()->whereKey(session('receipt_sale_id'))->first()
            : null;

        return view('for-business-pos', [
            'accountSetup' => $accountSetup,
            'activeTab' => (string) $request->query('tab', 'overview'),
            'appointmentsCalendar' => $appointmentsCalendar,
            'bookingCount' => $business->appointments()->count(),
            'branches' => $branches,
            'businessSlug' => $business->slug,
            'currentRole' => $this->currentBusinessRole($email),
            'currentUserEmail' => $email,
            'customers' => $customers,
            'email' => $email,
            'lastReceipt' => $lastReceipt,
            'listingStatus' => ucfirst((string) $business->approval_status),
            'options' => [
                'bookingStatuses' => PosOptions::bookingStatuses(),
                'commissionTypes' => PosOptions::commissionTypes(),
                'customerGenders' => PosOptions::customerGenders(),
                'customerTypes' => PosOptions::customerTypes(),
                'expenseCategories' => PosOptions::expenseCategories(),
                'membershipTypes' => PosOptions::membershipTypes(),
                'paymentMethods' => PosOptions::settlementMethods(),
                'paymentStatuses' => PosOptions::paymentStatuses(),
                'permissionMatrix' => PosOptions::permissionMatrix(),
                'productCategories' => PosOptions::productCategories(),
                'resourceTypes' => PosOptions::resourceTypes(),
                'salesChannels' => PosOptions::salesChannels(),
                'serviceCategories' => PosOptions::serviceCategories(),
                'serviceGenderTypes' => PosOptions::serviceGenderTypes(),
                'staffRoles' => PosOptions::staffRoles(),
                'statuses' => PosOptions::statuses(),
                'systemRoles' => PosOptions::systemRoles(),
            ],
            'pendingBookingCount' => $business->appointments()->where('status', 'Pending')->count(),
            'products' => $products,
            'profileReady' => $profileReady,
            'report' => $report,
            'resources' => $resources,
            'services' => $services,
            'staffMembers' => $staffMembers,
            'todayBookingCount' => $business->appointments()->whereDate('booking_date', today())->count(),
        ]);
    }

    public function storeCustomer(StorePosCustomerRequest $request): RedirectResponse
    {
        if ($redirect = $this->posModuleUnavailableRedirect()) {
            return $redirect;
        }

        $business = $this->businessOrRedirect($request);

        if ($business instanceof RedirectResponse) {
            return $business;
        }

        $branch = $this->resolveBranchFromRequest($business, $request->integer('branch_id'));
        $staffId = $request->integer('preferred_staff_id') ?: null;

        $customer = $business->customers()->create([
            'branch_id' => $branch?->id,
            'customer_code' => $this->referenceGenerator->next(
                business: $business,
                prefix: 'CUS',
                query: $business->customers(),
                column: 'customer_code',
            ),
            'full_name' => $request->string('full_name')->toString(),
            'phone_number' => $request->string('phone_number')->toString(),
            'email' => $request->input('email'),
            'gender' => $request->input('gender'),
            'date_of_birth' => $request->input('date_of_birth'),
            'customer_type' => $request->string('customer_type')->toString(),
            'preferred_staff_id' => $staffId,
            'visit_notes' => $request->input('visit_notes'),
            'allergies' => $request->input('allergies'),
            'skin_type' => $request->input('skin_type'),
            'hair_type' => $request->input('hair_type'),
            'preferred_massage_pressure' => $request->input('preferred_massage_pressure'),
            'loyalty_points' => $request->integer('loyalty_points'),
            'last_visit_date' => $request->input('last_visit_date'),
            'referral_source' => $request->input('referral_source'),
            'sms_reminder_ready' => $request->boolean('sms_reminder_ready', true),
            'whatsapp_reminder_ready' => $request->boolean('whatsapp_reminder_ready', true),
        ]);

        Membership::query()->create([
            'business_id' => $business->id,
            'customer_id' => $customer->id,
            'membership_number' => $this->referenceGenerator->next(
                business: $business,
                prefix: 'MEM',
                query: Membership::query()->where('business_id', $business->id),
                column: 'membership_number',
            ),
            'membership_type' => 'Silver',
            'points_earned' => $customer->loyalty_points,
            'points_redeemed' => 0,
            'reward_balance' => $customer->loyalty_points,
            'membership_expiry_date' => now()->addYear()->toDateString(),
            'is_active' => true,
        ]);

        return redirect()
            ->route('for-business.pos', ['tab' => 'customers'])
            ->with('pos_success', 'Customer profile saved to the POS.');
    }

    public function storeStaff(StorePosStaffRequest $request): RedirectResponse
    {
        if ($redirect = $this->posModuleUnavailableRedirect()) {
            return $redirect;
        }

        $business = $this->businessOrRedirect($request);

        if ($business instanceof RedirectResponse) {
            return $business;
        }

        $branch = $this->resolveBranchFromRequest($business, $request->integer('branch_id'));

        $business->staffMembers()->create([
            'branch_id' => $branch?->id,
            'staff_code' => $this->referenceGenerator->next(
                business: $business,
                prefix: 'STF',
                query: $business->staffMembers(),
                column: 'staff_code',
            ),
            'full_name' => $request->string('full_name')->toString(),
            'role' => $request->string('role')->toString(),
            'phone_number' => $request->string('phone_number')->toString(),
            'email' => $request->input('email'),
            'commission_type' => $request->input('commission_type'),
            'commission_rate' => $request->input('commission_rate'),
            'shift_schedule' => $request->filled('shift_schedule')
                ? ['summary' => $request->string('shift_schedule')->toString()]
                : null,
            'can_receive_product_commission' => $request->boolean('can_receive_product_commission'),
            'status' => $request->string('status')->toString(),
        ]);

        return redirect()
            ->route('for-business.pos', ['tab' => 'staff'])
            ->with('pos_success', 'Staff member added to the POS roster.');
    }

    public function storeService(StorePosServiceRequest $request): RedirectResponse
    {
        if ($redirect = $this->posModuleUnavailableRedirect()) {
            return $redirect;
        }

        $business = $this->businessOrRedirect($request);

        if ($business instanceof RedirectResponse) {
            return $business;
        }

        $branch = $this->resolveBranchFromRequest($business, $request->integer('branch_id'));
        $requiredProducts = [];

        if ($request->filled('required_product_id') && $request->filled('required_product_quantity')) {
            $requiredProducts[] = [
                'product_id' => $request->integer('required_product_id'),
                'quantity' => (float) $request->input('required_product_quantity'),
            ];
        }

        $business->services()->create([
            'branch_id' => $branch?->id,
            'service_code' => $this->referenceGenerator->next(
                business: $business,
                prefix: 'SRV',
                query: $business->services(),
                column: 'service_code',
            ),
            'name' => $request->string('name')->toString(),
            'category' => $request->string('category')->toString(),
            'price' => $request->input('price'),
            'duration_minutes' => $request->integer('duration_minutes'),
            'commission_type' => $request->input('commission_type'),
            'commission_rate' => $request->input('commission_rate'),
            'vat_applicable' => $request->boolean('vat_applicable'),
            'vat_rate' => $request->input('vat_rate', PosOptions::DEFAULT_VAT_RATE),
            'gender_type' => $request->string('gender_type')->toString(),
            'required_products' => $requiredProducts !== [] ? $requiredProducts : null,
            'description' => $request->input('description'),
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('for-business.pos', ['tab' => 'services'])
            ->with('pos_success', 'Service saved and ready for checkout and bookings.');
    }

    public function storeProduct(StorePosProductRequest $request): RedirectResponse
    {
        if ($redirect = $this->posModuleUnavailableRedirect()) {
            return $redirect;
        }

        $business = $this->businessOrRedirect($request);

        if ($business instanceof RedirectResponse) {
            return $business;
        }

        $branch = $this->resolveBranchFromRequest($business, $request->integer('branch_id'));

        $business->products()->create([
            'branch_id' => $branch?->id,
            'product_code' => $this->referenceGenerator->next(
                business: $business,
                prefix: 'PRD',
                query: $business->products(),
                column: 'product_code',
            ),
            'name' => $request->string('name')->toString(),
            'barcode' => $request->input('barcode'),
            'category' => $request->string('category')->toString(),
            'supplier' => $request->input('supplier'),
            'buying_price' => $request->input('buying_price'),
            'selling_price' => $request->input('selling_price'),
            'current_stock' => $request->input('current_stock'),
            'reorder_level' => $request->input('reorder_level'),
            'expiry_date' => $request->input('expiry_date'),
            'vat_rate' => $request->input('vat_rate'),
            'shelf_location' => $request->input('shelf_location'),
            'commission_enabled' => $request->boolean('commission_enabled'),
            'commission_type' => $request->input('commission_type'),
            'commission_rate' => $request->input('commission_rate'),
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('for-business.pos', ['tab' => 'inventory'])
            ->with('pos_success', 'Product added to inventory.');
    }

    public function storeRoomChair(StorePosRoomChairRequest $request): RedirectResponse
    {
        if ($redirect = $this->posModuleUnavailableRedirect()) {
            return $redirect;
        }

        $business = $this->businessOrRedirect($request);

        if ($business instanceof RedirectResponse) {
            return $business;
        }

        $branch = $this->resolveBranchFromRequest($business, $request->integer('branch_id'));

        RoomChair::query()->create([
            'business_id' => $business->id,
            'branch_id' => $branch?->id,
            'resource_code' => $this->referenceGenerator->next(
                business: $business,
                prefix: 'RSC',
                query: RoomChair::query()->where('business_id', $business->id),
                column: 'resource_code',
            ),
            'name' => $request->string('name')->toString(),
            'resource_type' => $request->string('resource_type')->toString(),
            'status' => $request->string('status')->toString(),
            'notes' => $request->input('notes'),
        ]);

        return redirect()
            ->route('for-business.pos', ['tab' => 'settings'])
            ->with('pos_success', 'Room or chair added to booking resources.');
    }

    public function storeAppointment(StorePosAppointmentRequest $request): RedirectResponse
    {
        if ($redirect = $this->posModuleUnavailableRedirect()) {
            return $redirect;
        }

        $business = $this->businessOrRedirect($request);

        if ($business instanceof RedirectResponse) {
            return $business;
        }

        $this->appointmentService->schedule($business, $request->validated());

        return redirect()
            ->route('for-business.pos', ['tab' => 'appointments'])
            ->with('pos_success', 'Appointment booked and conflict-checked.');
    }

    public function storeSale(StorePosSaleRequest $request): RedirectResponse
    {
        if ($redirect = $this->posModuleUnavailableRedirect()) {
            return $redirect;
        }

        $business = $this->businessOrRedirect($request);

        if ($business instanceof RedirectResponse) {
            return $business;
        }

        $sale = $this->saleProcessor->process($business, $request->validated());

        return redirect()
            ->route('for-business.pos', ['tab' => 'checkout'])
            ->with('pos_success', 'Sale recorded and receipt generated.')
            ->with('receipt_sale_id', $sale->id);
    }

    public function storeExpense(StorePosExpenseRequest $request): RedirectResponse
    {
        if ($redirect = $this->posModuleUnavailableRedirect()) {
            return $redirect;
        }

        $business = $this->businessOrRedirect($request);

        if ($business instanceof RedirectResponse) {
            return $business;
        }

        $branch = $this->resolveBranchFromRequest($business, $request->integer('branch_id'));

        $business->expenses()->create([
            'branch_id' => $branch?->id,
            'expense_code' => $this->referenceGenerator->next(
                business: $business,
                prefix: 'EXP',
                query: $business->expenses(),
                column: 'expense_code',
            ),
            'expense_category' => $request->string('expense_category')->toString(),
            'amount' => $request->input('amount'),
            'vendor' => $request->input('vendor'),
            'payment_method' => $request->string('payment_method')->toString(),
            'expense_date' => $request->input('expense_date'),
            'notes' => $request->input('notes'),
        ]);

        return redirect()
            ->route('for-business.pos', ['tab' => 'reports'])
            ->with('pos_success', 'Expense recorded for reporting.');
    }

    public function receipt(Request $request, Sale $sale): View|RedirectResponse
    {
        if ($redirect = $this->posModuleUnavailableRedirect()) {
            return $redirect;
        }

        $business = $this->businessOrRedirect($request);

        if ($business instanceof RedirectResponse) {
            return $business;
        }

        abort_unless((int) $sale->business_id === (int) $business->id, 403);

        return view('for-business-pos-receipt', [
            'business' => $business,
            'sale' => $sale->load([
                'appointment',
                'customer.membership',
                'items.service',
                'items.product',
                'items.staff',
                'payments.mpesaTransaction',
                'staff',
            ]),
        ]);
    }

    private function ownerContext(Request $request): array|RedirectResponse
    {
        $email = $request->session()->get('business_signup_email');

        if (! $email) {
            return redirect()->route('for-business.sign-in');
        }

        $this->hydrateOwnerSessionFromDatabase($request);

        $accountSetup = $request->session()->get('business_account_setup');

        if (! is_array($accountSetup) || $accountSetup === []) {
            return redirect()->route('for-business.account-setup');
        }

        $business = $this->findOwnedBusinessByEmail($email);

        if (! $business) {
            return redirect()->route('for-business.profile-details');
        }

        $profileDetails = $this->profileDetailsFromBusiness($business);

        return [
            'accountSetup' => $this->accountSetupFromBusiness($business),
            'business' => $business,
            'email' => $business->owner_email,
            'profileReady' => $profileDetails !== [],
            'profileDetails' => $profileDetails,
        ];
    }

    private function businessOrRedirect(Request $request): Business|RedirectResponse
    {
        $context = $this->ownerContext($request);

        if ($context instanceof RedirectResponse) {
            return $context;
        }

        return $context['business'];
    }

    private function ensurePrimaryBranch(Business $business): Branch
    {
        return $business->primaryBranch()->first() ?? $business->branches()->create([
            'branch_code' => $this->referenceGenerator->next(
                business: $business,
                prefix: 'BR',
                query: $business->branches(),
                column: 'branch_code',
            ),
            'name' => $business->business_name.' Main Branch',
            'phone' => $business->phone,
            'email' => $business->owner_email,
            'address_line' => $business->address_line,
            'city' => $business->city,
            'is_primary' => true,
            'is_active' => true,
        ]);
    }

    private function ensureStarterResources(Business $business, Branch $branch): void
    {
        if (RoomChair::query()->where('business_id', $business->id)->exists()) {
            return;
        }

        $resourceType = str_contains(strtolower($business->business_category), 'spa') || str_contains(strtolower($business->business_category), 'massage')
            ? 'Room'
            : 'Chair';

        RoomChair::query()->create([
            'business_id' => $business->id,
            'branch_id' => $branch->id,
            'resource_code' => $this->referenceGenerator->next(
                business: $business,
                prefix: 'RSC',
                query: RoomChair::query()->where('business_id', $business->id),
                column: 'resource_code',
            ),
            'name' => $resourceType.' 1',
            'resource_type' => $resourceType,
            'status' => 'Active',
        ]);
    }

    private function resolveBranchFromRequest(Business $business, ?int $branchId): ?Branch
    {
        if ($branchId) {
            return $business->branches()->whereKey($branchId)->firstOrFail();
        }

        return $this->ensurePrimaryBranch($business);
    }

    private function currentBusinessRole(string $email): string
    {
        if (! BusinessConsoleSchema::hasBusinessRoleColumn()) {
            return 'Admin';
        }

        return User::query()
            ->where('email', $email)
            ->value('business_role') ?: 'Admin';
    }

    private function posModuleUnavailableRedirect(): ?RedirectResponse
    {
        if (BusinessConsoleSchema::hasPosModuleTables()) {
            return null;
        }

        return redirect()
            ->route('for-business.tools')
            ->with('dashboard_warning', 'The POS module database migration has not been applied on this environment yet. Run `php artisan migrate` to enable POS features.');
    }

    private function hydrateOwnerSessionFromDatabase(Request $request): void
    {
        $email = $request->session()->get('business_signup_email');

        if (! $email) {
            return;
        }

        $business = $this->findOwnedBusinessByEmail($email);

        if (! $business) {
            return;
        }

        $request->session()->put('business_signup_email', $business->owner_email);
        $request->session()->put('business_account_setup', $this->accountSetupFromBusiness($business));
        $request->session()->put('business_profile_details', $this->profileDetailsFromBusiness($business));
    }

    private function findOwnedBusinessByEmail(?string $email): ?Business
    {
        if (! $email) {
            return null;
        }

        return Business::query()
            ->where('owner_email', $email)
            ->first();
    }

    private function accountSetupFromBusiness(Business $business): array
    {
        return [
            'first_name' => $business->owner_first_name,
            'last_name' => $business->owner_last_name,
            'business_name' => $business->business_name,
            'phone' => $business->phone,
            'business_category' => $business->business_category,
        ];
    }

    private function profileDetailsFromBusiness(Business $business): array
    {
        $details = [
            'business_name' => $business->business_name,
            'tagline' => $business->tagline,
            'address_line' => $business->address_line,
            'city' => $business->city,
            'neighborhood' => $business->neighborhood,
            'opening_time' => $business->opening_time,
            'closing_time' => $business->closing_time,
            'about' => $business->about,
        ];

        return collect($details)->filter(fn ($value) => filled($value))->all();
    }
}
