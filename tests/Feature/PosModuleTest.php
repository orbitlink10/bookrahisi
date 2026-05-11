<?php

namespace Tests\Feature;

use App\Models\Appointment;
use App\Models\Branch;
use App\Models\Business;
use App\Models\Customer;
use App\Models\Membership;
use App\Models\Product;
use App\Models\RoomChair;
use App\Models\Service;
use App\Models\Staff;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PosModuleTest extends TestCase
{
    use RefreshDatabase;

    public function test_business_owner_can_create_a_customer_profile_and_membership_from_pos(): void
    {
        $business = $this->createBusiness();
        $branch = $this->createBranch($business);
        $staff = $this->createStaff($business, $branch);

        $this->withSession(['business_signup_email' => $business->owner_email])
            ->post(route('for-business.pos.customers.store'), [
                'branch_id' => $branch->id,
                'full_name' => 'Jane Spa Client',
                'phone_number' => '0712345678',
                'email' => 'jane.client@bookrahisi.test',
                'gender' => 'Female',
                'customer_type' => 'VIP',
                'preferred_staff_id' => $staff->id,
                'skin_type' => 'Sensitive',
                'hair_type' => 'Curly',
                'preferred_massage_pressure' => 'Medium',
                'loyalty_points' => 12,
                'referral_source' => 'Instagram',
                'sms_reminder_ready' => '1',
                'whatsapp_reminder_ready' => '1',
            ])
            ->assertRedirect(route('for-business.pos', ['tab' => 'customers']));

        $customer = Customer::query()->firstOrFail();

        $this->assertSame('+254712345678', $customer->phone_number);
        $this->assertDatabaseHas('memberships', [
            'customer_id' => $customer->id,
            'membership_type' => 'Silver',
            'reward_balance' => 12,
        ]);
    }

    public function test_pos_appointment_creation_prevents_double_booking_for_staff(): void
    {
        $business = $this->createBusiness();
        $branch = $this->createBranch($business);
        $staff = $this->createStaff($business, $branch);
        $customer = $this->createCustomer($business, $branch, $staff);
        $service = $this->createService($business, $branch);
        $resource = $this->createRoomChair($business, $branch);

        Appointment::query()->create([
            'business_id' => $business->id,
            'branch_id' => $branch->id,
            'customer_id' => $customer->id,
            'service_id' => $service->id,
            'staff_id' => $staff->id,
            'room_chair_id' => $resource->id,
            'appointment_number' => 'BKG-20260511-0001',
            'booking_date' => '2026-05-12',
            'start_time' => '10:00:00',
            'end_time' => '10:45:00',
            'duration_minutes' => 45,
            'status' => 'Confirmed',
        ]);

        $this->withSession(['business_signup_email' => $business->owner_email])
            ->post(route('for-business.pos.appointments.store'), [
                'branch_id' => $branch->id,
                'customer_id' => $customer->id,
                'service_id' => $service->id,
                'staff_id' => $staff->id,
                'room_chair_id' => $resource->id,
                'booking_date' => '2026-05-12',
                'start_time' => '10:15',
                'duration_minutes' => 30,
                'status' => 'Confirmed',
            ])
            ->assertSessionHasErrors(['start_time']);

        $this->assertDatabaseCount('appointments', 1);
    }

    public function test_recording_a_sale_updates_inventory_loyalty_commissions_and_mpesa_records(): void
    {
        $business = $this->createBusiness();
        $branch = $this->createBranch($business);
        $staff = $this->createStaff($business, $branch, [
            'can_receive_product_commission' => true,
            'commission_type' => 'Percentage',
            'commission_rate' => 10,
        ]);
        $customer = $this->createCustomer($business, $branch, $staff, [
            'loyalty_points' => 40,
        ]);

        Membership::query()->create([
            'business_id' => $business->id,
            'customer_id' => $customer->id,
            'membership_number' => 'MEM-20260511-0001',
            'membership_type' => 'Gold',
            'points_earned' => 0,
            'points_redeemed' => 0,
            'reward_balance' => 40,
            'membership_expiry_date' => now()->addYear()->toDateString(),
            'is_active' => true,
        ]);

        $serviceProduct = $this->createProduct($business, $branch, [
            'product_code' => 'PRD-20260511-0001',
            'name' => 'Treatment Oil',
            'current_stock' => 10,
            'selling_price' => 900,
            'buying_price' => 450,
            'commission_enabled' => false,
        ]);

        $retailProduct = $this->createProduct($business, $branch, [
            'product_code' => 'PRD-20260511-0002',
            'name' => 'Finishing Pomade',
            'current_stock' => 6,
            'selling_price' => 1200,
            'buying_price' => 600,
            'commission_enabled' => true,
            'commission_type' => 'Percentage',
            'commission_rate' => 5,
        ]);

        $service = $this->createService($business, $branch, [
            'price' => 2000,
            'commission_type' => 'Percentage',
            'commission_rate' => 10,
            'required_products' => [
                ['product_id' => $serviceProduct->id, 'quantity' => 0.5],
            ],
        ]);

        $response = $this->withSession(['business_signup_email' => $business->owner_email])
            ->post(route('for-business.pos.sales.store'), [
                'branch_id' => $branch->id,
                'customer_id' => $customer->id,
                'staff_id' => $staff->id,
                'transaction_date' => now()->format('Y-m-d H:i:s'),
                'sales_channel' => 'Walk-in',
                'discount_amount' => 0,
                'loyalty_points_to_redeem' => 20,
                'service_items' => [
                    [
                        'service_id' => $service->id,
                        'staff_id' => $staff->id,
                        'quantity' => 1,
                        'discount_amount' => 0,
                        'deduct_products' => true,
                    ],
                ],
                'product_items' => [
                    [
                        'product_id' => $retailProduct->id,
                        'staff_id' => $staff->id,
                        'quantity' => 2,
                        'discount_amount' => 0,
                    ],
                ],
                'package_items' => [],
                'payments' => [
                    [
                        'payment_method' => 'M-Pesa',
                        'amount' => 5000,
                        'status' => 'Paid',
                        'reference' => 'POS-DEMO',
                        'paid_at' => now()->format('Y-m-d H:i:s'),
                        'notes' => 'Demo payment',
                        'mpesa_code' => 'SE2K7H98TQ',
                        'phone_number' => '0712345678',
                        'till_or_paybill' => 'Till 123456',
                    ],
                ],
            ]);

        $response
            ->assertRedirect(route('for-business.pos', ['tab' => 'checkout']))
            ->assertSessionHas('receipt_sale_id');

        $this->assertDatabaseCount('sales', 1);
        $this->assertDatabaseCount('payments', 1);
        $this->assertDatabaseCount('mpesa_transactions', 1);
        $this->assertDatabaseCount('commissions', 2);
        $this->assertDatabaseCount('inventory_logs', 2);

        $this->assertDatabaseHas('products', [
            'id' => $retailProduct->id,
            'current_stock' => 4,
        ]);

        $this->assertDatabaseHas('products', [
            'id' => $serviceProduct->id,
            'current_stock' => 9.5,
        ]);

        $this->assertDatabaseHas('mpesa_transactions', [
            'mpesa_code' => 'SE2K7H98TQ',
            'phone_number' => '+254712345678',
            'till_or_paybill' => 'Till 123456',
        ]);

        $customer->refresh();

        $this->assertGreaterThan(20, $customer->loyalty_points);
        $this->assertDatabaseHas('loyalty_points', [
            'customer_id' => $customer->id,
            'points_redeemed' => 20,
        ]);
    }

    private function createBusiness(array $overrides = []): Business
    {
        return Business::query()->create(array_merge([
            'owner_email' => 'owner@bookrahisi.test',
            'owner_first_name' => 'Amina',
            'owner_last_name' => 'Njeri',
            'business_name' => 'Glow House',
            'slug' => 'glow-house',
            'phone' => '+254711223344',
            'business_category' => 'Salon',
            'tagline' => 'Modern salon care for busy city clients.',
            'address_line' => 'Prestige Plaza, Ngong Road',
            'city' => 'Nairobi',
            'neighborhood' => 'Kilimani',
            'opening_time' => '09:00',
            'closing_time' => '19:00',
            'about' => 'We focus on precision cuts, healthy hair routines, and a calm guest experience.',
            'approval_status' => 'approved',
            'approved_at' => now(),
        ], $overrides));
    }

    private function createBranch(Business $business): Branch
    {
        return Branch::query()->create([
            'business_id' => $business->id,
            'branch_code' => 'BR-20260511-0001',
            'name' => 'Main Branch',
            'phone' => $business->phone,
            'email' => $business->owner_email,
            'address_line' => $business->address_line,
            'city' => $business->city,
            'is_primary' => true,
            'is_active' => true,
        ]);
    }

    private function createStaff(Business $business, Branch $branch, array $overrides = []): Staff
    {
        return Staff::query()->create(array_merge([
            'business_id' => $business->id,
            'branch_id' => $branch->id,
            'staff_code' => 'STF-20260511-0001',
            'full_name' => 'Brian Otieno',
            'role' => 'Barber',
            'phone_number' => '+254701112233',
            'email' => 'brian@bookrahisi.test',
            'commission_type' => 'Percentage',
            'commission_rate' => 10,
            'shift_schedule' => ['summary' => 'Mon-Sat / 9:00 am - 7:00 pm'],
            'can_receive_product_commission' => false,
            'status' => 'Active',
        ], $overrides));
    }

    private function createCustomer(Business $business, Branch $branch, Staff $staff, array $overrides = []): Customer
    {
        return Customer::query()->create(array_merge([
            'business_id' => $business->id,
            'branch_id' => $branch->id,
            'customer_code' => 'CUS-20260511-0001',
            'full_name' => 'Kelvin Mugo',
            'phone_number' => '+254700000011',
            'email' => 'kelvin@bookrahisi.test',
            'gender' => 'Male',
            'customer_type' => 'Regular',
            'preferred_staff_id' => $staff->id,
            'loyalty_points' => 0,
            'sms_reminder_ready' => true,
            'whatsapp_reminder_ready' => true,
        ], $overrides));
    }

    private function createProduct(Business $business, Branch $branch, array $overrides = []): Product
    {
        return Product::query()->create(array_merge([
            'business_id' => $business->id,
            'branch_id' => $branch->id,
            'product_code' => 'PRD-20260511-9999',
            'name' => 'Default Product',
            'barcode' => 'SKU001',
            'category' => 'Gel',
            'supplier' => 'Supplier',
            'buying_price' => 500,
            'selling_price' => 1000,
            'current_stock' => 8,
            'reorder_level' => 2,
            'expiry_date' => now()->addMonths(6)->toDateString(),
            'vat_rate' => 16,
            'shelf_location' => 'A1',
            'commission_enabled' => false,
            'commission_type' => null,
            'commission_rate' => null,
            'is_active' => true,
        ], $overrides));
    }

    private function createService(Business $business, Branch $branch, array $overrides = []): Service
    {
        return Service::query()->create(array_merge([
            'business_id' => $business->id,
            'branch_id' => $branch->id,
            'service_code' => 'SRV-20260511-0001',
            'name' => 'Signature Service',
            'category' => 'Barber',
            'price' => 1500,
            'duration_minutes' => 45,
            'commission_type' => 'Percentage',
            'commission_rate' => 10,
            'vat_applicable' => true,
            'vat_rate' => 16,
            'gender_type' => 'Unisex',
            'required_products' => null,
            'description' => 'Test service.',
            'is_active' => true,
        ], $overrides));
    }

    private function createRoomChair(Business $business, Branch $branch): RoomChair
    {
        return RoomChair::query()->create([
            'business_id' => $business->id,
            'branch_id' => $branch->id,
            'resource_code' => 'RSC-20260511-0001',
            'name' => 'Chair 1',
            'resource_type' => 'Chair',
            'status' => 'Active',
        ]);
    }
}
