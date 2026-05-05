<?php

namespace Tests\Feature;

use App\Mail\BookingPlacedMail;
use App\Models\Business;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CustomerModuleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_customer_registration_page_renders(): void
    {
        $response = $this->get('/customer/register');

        $response
            ->assertOk()
            ->assertSeeText('Create your Book Rahisi account')
            ->assertSeeText('Name')
            ->assertSeeText('Email')
            ->assertSeeText('Phone Number')
            ->assertSeeText('Confirm Password');
    }

    public function test_a_customer_can_register_and_is_redirected_to_the_dashboard(): void
    {
        $response = $this->post('/customer/register', [
            'name' => 'Jane Customer',
            'email' => 'jane@bookrahisi.test',
            'phone_number' => '+254700000001',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ]);

        $response
            ->assertRedirect('/customer/dashboard')
            ->assertSessionHas('customer_user_id');

        $this->assertDatabaseHas('users', [
            'email' => 'jane@bookrahisi.test',
            'name' => 'Jane Customer',
            'phone_number' => '+254700000001',
            'is_admin' => false,
            'account_status' => 'active',
        ]);
    }

    public function test_the_customer_sign_in_page_renders(): void
    {
        $response = $this->get('/customer/sign-in');

        $response
            ->assertOk()
            ->assertSeeText('Welcome back to Book Rahisi')
            ->assertSeeText('Open customer dashboard');
    }

    public function test_a_customer_can_sign_in_and_view_the_dashboard(): void
    {
        $customer = $this->createCustomer();
        $business = $this->createBusiness();

        $response = $this->post('/customer/sign-in', [
            'email' => $customer->email,
            'password' => 'password',
        ]);

        $response
            ->assertRedirect('/customer/dashboard')
            ->assertSessionHas('customer_user_id', $customer->id);

        $this->withSession(['customer_user_id' => $customer->id])
            ->get('/customer/dashboard')
            ->assertOk()
            ->assertSeeText('Customer dashboard')
            ->assertSeeText($business->business_name)
            ->assertSeeText('Browse Businesses');
    }

    public function test_the_customer_dashboard_requires_authentication(): void
    {
        $this->get('/customer/dashboard')->assertRedirect('/customer/sign-in');
        $this->get('/customer/bookings')->assertRedirect('/customer/sign-in');
    }

    public function test_an_authenticated_customer_booking_is_linked_to_their_account(): void
    {
        $customer = $this->createCustomer();
        $this->createBusiness();
        Mail::fake();
        Storage::fake('public');

        $response = $this
            ->withSession(['customer_user_id' => $customer->id])
            ->post('/business/glow-house/book', [
                'service' => 'head-and-shoulder-massage',
                'appointment_date' => now()->format('Y-m-d'),
                'appointment_time' => '9:00 am',
                'staff' => 'zuri',
                'customer_name' => 'Jane Customer',
                'customer_email' => $customer->email,
                'customer_phone' => '+254700000001',
                'customer_image' => UploadedFile::fake()->create('customer-reference.png', 256, 'image/png'),
                'customer_notes' => 'Please confirm the appointment.',
            ]);

        $response
            ->assertRedirect('/business/glow-house/book?service=head-and-shoulder-massage&staff=zuri')
            ->assertSessionHas('booking_success');

        $this->assertDatabaseHas('bookings', [
            'customer_user_id' => $customer->id,
            'customer_email' => $customer->email,
            'customer_name' => 'Jane Customer',
            'customer_phone' => '+254700000001',
        ]);

        $booking = Booking::query()->latest('id')->firstOrFail();

        $this->assertNotNull($booking->customer_image_path);
        Storage::disk('public')->assertExists($booking->customer_image_path);

        Mail::assertSent(BookingPlacedMail::class, function (BookingPlacedMail $mail) use ($customer, $booking): bool {
            return $mail->hasTo($customer->email)
                && $mail->booking->is($booking);
        });
    }

    public function test_a_customer_can_view_and_cancel_their_own_booking(): void
    {
        $customer = $this->createCustomer();
        $business = $this->createBusiness();
        $booking = $this->createBooking($business, $customer, [
            'status' => 'confirmed',
        ]);

        $this->withSession(['customer_user_id' => $customer->id])
            ->get('/customer/bookings')
            ->assertOk()
            ->assertSeeText('My bookings')
            ->assertSeeText($booking->service_name)
            ->assertSeeText($business->business_name);

        $this->withSession(['customer_user_id' => $customer->id])
            ->post(route('customer.bookings.cancel', ['booking' => $booking]))
            ->assertRedirect('/customer/bookings#upcoming');

        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
            'status' => 'cancelled',
        ]);
    }

    public function test_a_customer_can_review_a_completed_booking_and_the_review_appears_publicly(): void
    {
        $customer = $this->createCustomer();
        $business = $this->createBusiness();
        $booking = $this->createBooking($business, $customer, [
            'status' => 'completed',
            'payment_status' => 'paid',
            'paid_at' => now(),
        ]);

        $this->withSession(['customer_user_id' => $customer->id])
            ->post(route('customer.bookings.review', ['booking' => $booking]), [
                'rating' => 5,
                'body' => 'Excellent service and timing.',
            ])
            ->assertRedirect('/customer/bookings#history');

        $this->assertDatabaseHas('reviews', [
            'booking_id' => $booking->id,
            'business_id' => $business->id,
            'user_id' => $customer->id,
            'rating' => 5,
            'body' => 'Excellent service and timing.',
        ]);

        $this->get('/business/glow-house')
            ->assertOk()
            ->assertSeeText('Excellent service and timing.')
            ->assertSeeText('Jane Customer');
    }

    private function createCustomer(array $overrides = []): User
    {
        return User::factory()->create(array_merge([
            'name' => 'Jane Customer',
            'email' => 'jane@bookrahisi.test',
            'phone_number' => '+254700000001',
            'password' => 'password',
            'is_admin' => false,
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

    private function createBooking(Business $business, User $customer, array $overrides = []): Booking
    {
        return $business->bookings()->create(array_merge([
            'customer_user_id' => $customer->id,
            'customer_email' => $customer->email,
            'service_slug' => 'head-and-shoulder-massage',
            'service_name' => 'Head and Shoulder Massage',
            'appointment_date' => now()->format('Y-m-d'),
            'appointment_time' => '9:00 am',
            'staff_slug' => 'zuri',
            'staff_name' => 'Zuri',
            'customer_name' => $customer->name,
            'customer_phone' => $customer->phone_number,
            'customer_notes' => 'Please keep the slot on time.',
            'status' => 'pending',
            'payment_status' => 'pending',
            'paid_at' => null,
        ], $overrides));
    }
}
