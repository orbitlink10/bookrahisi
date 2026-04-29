<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Business;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function signIn(): View
    {
        return view('admin-sign-in', [
            'sideImage' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=1400&q=80',
        ]);
    }

    public function signInSubmit(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $admin = User::query()
            ->where('email', $validated['email'])
            ->where('is_admin', true)
            ->where('account_status', 'active')
            ->first();

        if (! $admin || ! Hash::check($validated['password'], $admin->password)) {
            return redirect()
                ->route('admin.sign-in')
                ->withErrors(['email' => 'The admin credentials are invalid or the account is inactive.'])
                ->withInput($request->except('password'));
        }

        $request->session()->regenerate();
        $request->session()->put('admin_user_id', $admin->id);

        return redirect()->route('admin.dashboard');
    }

    public function signOut(Request $request): RedirectResponse
    {
        $request->session()->forget('admin_user_id');

        return redirect()->route('admin.sign-in');
    }

    public function dashboard(Request $request): View|RedirectResponse
    {
        $admin = $this->authenticatedAdmin($request);

        if (! $admin) {
            return redirect()->route('admin.sign-in');
        }

        $businesses = Business::query()
            ->withCount('bookings')
            ->orderByRaw("
                case approval_status
                    when 'pending' then 0
                    when 'rejected' then 1
                    else 2
                end
            ")
            ->orderByDesc('created_at')
            ->get();

        $users = User::query()
            ->orderByDesc('is_admin')
            ->orderBy('name')
            ->get();

        $bookings = Booking::query()
            ->with('business')
            ->latest()
            ->take(12)
            ->get();

        $payments = Booking::query()
            ->with('business')
            ->latest()
            ->take(12)
            ->get();

        $totalBusinesses = Business::query()->count();
        $pendingBusinesses = Business::query()->where('approval_status', 'pending')->count();
        $approvedBusinesses = Business::query()->where('approval_status', 'approved')->count();
        $rejectedBusinesses = Business::query()->where('approval_status', 'rejected')->count();

        $totalUsers = User::query()->count();
        $activeUsers = User::query()->where('account_status', 'active')->count();
        $suspendedUsers = User::query()->where('account_status', 'suspended')->count();

        $totalBookings = Booking::query()->count();
        $pendingBookings = Booking::query()->where('status', 'pending')->count();
        $confirmedBookings = Booking::query()->where('status', 'confirmed')->count();
        $completedBookings = Booking::query()->where('status', 'completed')->count();
        $cancelledBookings = Booking::query()->where('status', 'cancelled')->count();

        $paidBookings = Booking::query()->where('payment_status', 'paid')->count();
        $pendingPayments = Booking::query()->where('payment_status', 'pending')->count();
        $refundedPayments = Booking::query()->where('payment_status', 'refunded')->count();

        $topBusinesses = Business::query()
            ->withCount('bookings')
            ->orderByDesc('bookings_count')
            ->take(5)
            ->get();

        return view('admin-dashboard', [
            'activeUsers' => $activeUsers,
            'admin' => $admin,
            'approvedBusinesses' => $approvedBusinesses,
            'bookings' => $bookings,
            'businesses' => $businesses,
            'cancelledBookings' => $cancelledBookings,
            'completedBookings' => $completedBookings,
            'confirmedBookings' => $confirmedBookings,
            'paidBookings' => $paidBookings,
            'payments' => $payments,
            'pendingBookings' => $pendingBookings,
            'pendingBusinesses' => $pendingBusinesses,
            'pendingPayments' => $pendingPayments,
            'refundedPayments' => $refundedPayments,
            'rejectedBusinesses' => $rejectedBusinesses,
            'suspendedUsers' => $suspendedUsers,
            'topBusinesses' => $topBusinesses,
            'totalBookings' => $totalBookings,
            'totalBusinesses' => $totalBusinesses,
            'totalUsers' => $totalUsers,
            'users' => $users,
        ]);
    }

    public function updateBusinessApproval(Request $request, Business $business): RedirectResponse
    {
        $admin = $this->authenticatedAdmin($request);

        if (! $admin) {
            return redirect()->route('admin.sign-in');
        }

        $validated = $request->validate([
            'approval_status' => ['required', Rule::in(['pending', 'approved', 'rejected'])],
            'approval_notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $business->update([
            'approval_status' => $validated['approval_status'],
            'approved_at' => $validated['approval_status'] === 'approved' ? now() : null,
            'approval_notes' => $validated['approval_notes'] ?: null,
        ]);

        return redirect()->to($this->dashboardAnchor('businesses'))
            ->with('admin_success', 'Business approval updated for '.$business->business_name.'.');
    }

    public function updateUserStatus(Request $request, User $user): RedirectResponse
    {
        $admin = $this->authenticatedAdmin($request);

        if (! $admin) {
            return redirect()->route('admin.sign-in');
        }

        $validated = $request->validate([
            'account_status' => ['required', Rule::in(['active', 'suspended'])],
        ]);

        if ($admin->is($user) && $validated['account_status'] !== 'active') {
            return redirect()->to($this->dashboardAnchor('users'))
                ->withErrors(['account_status' => 'The current admin account cannot suspend itself.']);
        }

        $user->update([
            'account_status' => $validated['account_status'],
        ]);

        return redirect()->to($this->dashboardAnchor('users'))
            ->with('admin_success', 'User status updated for '.$user->email.'.');
    }

    public function updateBookingStatus(Request $request, Booking $booking): RedirectResponse
    {
        $admin = $this->authenticatedAdmin($request);

        if (! $admin) {
            return redirect()->route('admin.sign-in');
        }

        $validated = $request->validate([
            'status' => ['required', Rule::in(['pending', 'confirmed', 'completed', 'cancelled'])],
        ]);

        $booking->update([
            'status' => $validated['status'],
        ]);

        return redirect()->to($this->dashboardAnchor('bookings'))
            ->with('admin_success', 'Booking status updated for '.$booking->customer_name.'.');
    }

    public function updateBookingPayment(Request $request, Booking $booking): RedirectResponse
    {
        $admin = $this->authenticatedAdmin($request);

        if (! $admin) {
            return redirect()->route('admin.sign-in');
        }

        $validated = $request->validate([
            'payment_status' => ['required', Rule::in(['pending', 'paid', 'refunded', 'failed'])],
        ]);

        $booking->update([
            'payment_status' => $validated['payment_status'],
            'paid_at' => $validated['payment_status'] === 'paid' ? now() : null,
        ]);

        return redirect()->to($this->dashboardAnchor('payments'))
            ->with('admin_success', 'Payment status updated for '.$booking->customer_name.'.');
    }

    private function dashboardAnchor(string $section): string
    {
        return route('admin.dashboard').'#'.$section;
    }

    private function authenticatedAdmin(Request $request): ?User
    {
        $adminId = $request->session()->get('admin_user_id');

        if (! $adminId) {
            return null;
        }

        return User::query()
            ->whereKey($adminId)
            ->where('is_admin', true)
            ->where('account_status', 'active')
            ->first();
    }
}
