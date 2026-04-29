<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Business;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_admin_sign_in_page_renders(): void
    {
        $response = $this->get('/admin/sign-in');

        $response
            ->assertOk()
            ->assertSeeText('Book Rahisi Admin')
            ->assertSeeText('Marketplace owner access')
            ->assertSeeText('Open admin dashboard');
    }

    public function test_admin_can_sign_in_and_view_the_dashboard(): void
    {
        $admin = $this->createAdminUser();

        $response = $this->post('/admin/sign-in', [
            'email' => $admin->email,
            'password' => 'password',
        ]);

        $response
            ->assertRedirect('/admin/dashboard')
            ->assertSessionHas('admin_user_id', $admin->id);

        $this->withSession(['admin_user_id' => $admin->id])
            ->get('/admin/dashboard')
            ->assertOk()
            ->assertSeeText('Admin dashboard')
            ->assertSeeText('Businesses')
            ->assertSeeText('Users')
            ->assertSeeText('Bookings')
            ->assertSeeText('Payments')
            ->assertSeeText('Reports');
    }

    public function test_non_admin_users_cannot_sign_in_to_the_admin_dashboard(): void
    {
        $user = User::factory()->create([
            'email' => 'user@bookrahisi.test',
            'password' => 'password',
            'is_admin' => false,
            'account_status' => 'active',
        ]);

        $response = $this->from('/admin/sign-in')->post('/admin/sign-in', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response
            ->assertRedirect('/admin/sign-in')
            ->assertSessionHasErrors('email')
            ->assertSessionMissing('admin_user_id');
    }

    public function test_the_admin_dashboard_requires_an_authenticated_admin_session(): void
    {
        $this->get('/admin/dashboard')->assertRedirect('/admin/sign-in');
    }

    public function test_admin_can_approve_a_business_and_publish_it_to_the_marketplace(): void
    {
        $admin = $this->createAdminUser();
        $business = $this->createBusiness([
            'slug' => 'pending-glow-house',
            'approval_status' => 'pending',
            'approved_at' => null,
        ]);

        $this->get('/business/pending-glow-house')->assertNotFound();

        $response = $this
            ->withSession(['admin_user_id' => $admin->id])
            ->post(route('admin.businesses.approval', ['business' => $business]), [
                'approval_status' => 'approved',
                'approval_notes' => 'Listing approved for public launch.',
            ]);

        $response
            ->assertRedirect(route('admin.dashboard').'#businesses')
            ->assertSessionHas('admin_success');

        $business->refresh();

        $this->assertSame('approved', $business->approval_status);
        $this->assertSame('Listing approved for public launch.', $business->approval_notes);
        $this->assertNotNull($business->approved_at);

        $this->get('/business/pending-glow-house')
            ->assertOk()
            ->assertSeeText($business->business_name);
    }

    public function test_admin_can_suspend_and_reactivate_marketplace_users(): void
    {
        $admin = $this->createAdminUser();
        $user = User::factory()->create([
            'email' => 'member@bookrahisi.test',
            'password' => 'password',
            'is_admin' => false,
            'account_status' => 'active',
        ]);

        $this->withSession(['admin_user_id' => $admin->id])
            ->post(route('admin.users.status', ['user' => $user]), [
                'account_status' => 'suspended',
            ])
            ->assertRedirect(route('admin.dashboard').'#users');

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'account_status' => 'suspended',
        ]);

        $this->withSession(['admin_user_id' => $admin->id])
            ->post(route('admin.users.status', ['user' => $user]), [
                'account_status' => 'active',
            ])
            ->assertRedirect(route('admin.dashboard').'#users');

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'account_status' => 'active',
        ]);
    }

    public function test_admin_cannot_suspend_the_current_admin_account(): void
    {
        $admin = $this->createAdminUser();

        $response = $this
            ->withSession(['admin_user_id' => $admin->id])
            ->post(route('admin.users.status', ['user' => $admin]), [
                'account_status' => 'suspended',
            ]);

        $response
            ->assertRedirect(route('admin.dashboard').'#users')
            ->assertSessionHasErrors('account_status');

        $this->assertDatabaseHas('users', [
            'id' => $admin->id,
            'account_status' => 'active',
        ]);
    }

    public function test_admin_can_update_booking_status(): void
    {
        $admin = $this->createAdminUser();
        $business = $this->createBusiness();
        $booking = $this->createBooking($business);

        $response = $this
            ->withSession(['admin_user_id' => $admin->id])
            ->post(route('admin.bookings.status', ['booking' => $booking]), [
                'status' => 'confirmed',
            ]);

        $response->assertRedirect(route('admin.dashboard').'#bookings');

        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
            'status' => 'confirmed',
        ]);
    }

    public function test_admin_can_update_booking_payment_status(): void
    {
        $admin = $this->createAdminUser();
        $business = $this->createBusiness();
        $booking = $this->createBooking($business);

        $response = $this
            ->withSession(['admin_user_id' => $admin->id])
            ->post(route('admin.bookings.payment', ['booking' => $booking]), [
                'payment_status' => 'paid',
            ]);

        $response->assertRedirect(route('admin.dashboard').'#payments');

        $booking->refresh();

        $this->assertSame('paid', $booking->payment_status);
        $this->assertNotNull($booking->paid_at);
    }

    private function createAdminUser(array $overrides = []): User
    {
        return User::factory()->create(array_merge([
            'name' => 'Book Rahisi Owner',
            'email' => 'admin@bookrahisi.test',
            'password' => 'password',
            'is_admin' => true,
            'account_status' => 'active',
        ], $overrides));
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

    private function createBooking(Business $business, array $overrides = []): Booking
    {
        return $business->bookings()->create(array_merge([
            'service_slug' => 'head-and-shoulder-massage',
            'service_name' => 'Head and Shoulder Massage',
            'appointment_date' => now()->format('Y-m-d'),
            'appointment_time' => '9:00 am',
            'staff_slug' => 'zuri',
            'staff_name' => 'Zuri',
            'customer_name' => 'Jane Customer',
            'customer_phone' => '+254700000001',
            'customer_notes' => 'Please keep the slot on time.',
            'status' => 'pending',
            'payment_status' => 'pending',
            'paid_at' => null,
        ], $overrides));
    }
}
