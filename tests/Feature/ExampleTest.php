<?php

namespace Tests\Feature;

use App\Models\Business;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_homepage_renders_book_rahisi_content(): void
    {
        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertSeeText('Book your next self-care session')
            ->assertSeeText('Daily Deals')
            ->assertSeeText('Find a Service in a City Near You')
            ->assertSeeText('For Business')
            ->assertSee('/for-business/sign-in', false);
    }

    public function test_the_for_business_page_renders(): void
    {
        $response = $this->get('/for-business');

        $response
            ->assertOk()
            ->assertSeeText('The #1 software for Salons and Spas')
            ->assertSeeText('Business types')
            ->assertSeeText('Fitness & recovery')
            ->assertSeeText('Features')
            ->assertSeeText('Pricing');
    }

    public function test_the_business_sign_in_page_renders(): void
    {
        $response = $this->get('/for-business/sign-in');

        $response
            ->assertOk()
            ->assertSeeText('Book Rahisi for professionals')
            ->assertSeeText('Continue with Facebook')
            ->assertSeeText('Continue with Google')
            ->assertSeeText('Continue with Apple');
    }

    public function test_the_business_sign_in_form_accepts_a_valid_email_for_a_new_owner(): void
    {
        $response = $this->post('/for-business/sign-in', [
            'email' => 'owner@bookrahisi.test',
        ]);

        $response
            ->assertRedirect('/for-business/account-setup')
            ->assertSessionHas('business_signup_email', 'owner@bookrahisi.test');
    }

    public function test_the_business_sign_in_form_redirects_existing_owners_to_business_tools(): void
    {
        $business = $this->createBusiness();

        $response = $this->post('/for-business/sign-in', [
            'email' => $business->owner_email,
        ]);

        $response
            ->assertRedirect('/for-business/tools')
            ->assertSessionHas('business_signup_email', $business->owner_email)
            ->assertSessionHas('business_account_setup', $this->accountSetupSession())
            ->assertSessionHas('business_profile_details', $this->profileDetailsSession());
    }

    public function test_the_business_sign_in_form_rejects_an_invalid_email(): void
    {
        $response = $this->from('/for-business/sign-in')->post('/for-business/sign-in', [
            'email' => 'not-an-email',
        ]);

        $response
            ->assertRedirect('/for-business/sign-in')
            ->assertSessionHasErrors('email');
    }

    public function test_the_business_account_setup_page_renders_after_email_step(): void
    {
        $response = $this
            ->withSession(['business_signup_email' => 'owner@bookrahisi.test'])
            ->get('/for-business/account-setup');

        $response
            ->assertOk()
            ->assertSeeText('Set up your business account')
            ->assertSee('owner@bookrahisi.test', false)
            ->assertSeeText('Continue to business setup');
    }

    public function test_the_business_account_setup_form_advances_to_the_business_setup_page(): void
    {
        $response = $this
            ->withSession(['business_signup_email' => 'owner@bookrahisi.test'])
            ->post('/for-business/account-setup', $this->accountSetupSession());

        $response
            ->assertRedirect('/for-business/business-setup')
            ->assertSessionHas('business_account_setup', $this->accountSetupSession());
    }

    public function test_the_business_account_setup_form_rejects_missing_required_fields(): void
    {
        $response = $this
            ->from('/for-business/account-setup')
            ->withSession(['business_signup_email' => 'owner@bookrahisi.test'])
            ->post('/for-business/account-setup', [
                'first_name' => '',
                'last_name' => '',
                'business_name' => '',
                'phone' => '',
                'business_category' => '',
            ]);

        $response
            ->assertRedirect('/for-business/account-setup')
            ->assertSessionHasErrors([
                'first_name',
                'last_name',
                'business_name',
                'phone',
                'business_category',
            ]);
    }

    public function test_the_business_account_setup_page_redirects_without_email_in_session(): void
    {
        $response = $this->get('/for-business/account-setup');

        $response->assertRedirect('/for-business/sign-in');
    }

    public function test_the_business_setup_page_renders_after_account_setup(): void
    {
        $response = $this
            ->withSession($this->ownerOnboardingSession())
            ->get('/for-business/business-setup');

        $response
            ->assertOk()
            ->assertSeeText('Business setup started')
            ->assertSeeText('Glow House')
            ->assertSeeText('Next setup tasks')
            ->assertSee('/for-business/tools', false)
            ->assertSeeText('Go to business tools');
    }

    public function test_the_business_setup_page_redirects_if_account_details_are_missing(): void
    {
        $response = $this
            ->withSession(['business_signup_email' => 'owner@bookrahisi.test'])
            ->get('/for-business/business-setup');

        $response->assertRedirect('/for-business/account-setup');
    }

    public function test_the_business_tools_page_renders_after_business_setup(): void
    {
        $response = $this
            ->withSession($this->ownerOnboardingSession())
            ->get('/for-business/tools');

        $response
            ->assertOk()
            ->assertSeeText('Business dashboard')
            ->assertSeeText('Your dashboard is ready')
            ->assertSeeText('Update profile')
            ->assertSeeText('Customer bookings')
            ->assertSeeText('Recent bookings')
            ->assertSee('/for-business/tools/profile', false);
    }

    public function test_the_business_tools_page_redirects_if_setup_is_incomplete(): void
    {
        $response = $this
            ->withSession(['business_signup_email' => 'owner@bookrahisi.test'])
            ->get('/for-business/tools');

        $response->assertRedirect('/for-business/account-setup');
    }

    public function test_the_business_profile_details_page_renders_after_tools_step(): void
    {
        $response = $this
            ->withSession($this->ownerOnboardingSession())
            ->get('/for-business/tools/profile');

        $response
            ->assertOk()
            ->assertSeeText('Build the page customers will book from')
            ->assertSeeText('Business profile details')
            ->assertSee('/business/glow-house', false);
    }

    public function test_the_business_profile_details_form_persists_the_business_and_redirects_to_the_dashboard(): void
    {
        $response = $this
            ->withSession($this->ownerOnboardingSession())
            ->post('/for-business/tools/profile', $this->profileDetailsSession());

        $response
            ->assertRedirect('/for-business/tools')
            ->assertSessionHas('business_profile_details', $this->profileDetailsSession())
            ->assertSessionHas('dashboard_success');

        $this->assertDatabaseHas('businesses', [
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
            'about' => 'We focus on precision cuts, healthy hair routines, and a calm guest experience.',
        ]);
    }

    public function test_the_public_business_page_renders_without_an_owner_session_once_the_business_is_saved(): void
    {
        $this->createBusiness();

        $response = $this->get('/business/glow-house');

        $response
            ->assertOk()
            ->assertSeeText('Glow House')
            ->assertSeeText('Services')
            ->assertSeeText('Head and Shoulder Massage')
            ->assertSeeText('Team')
            ->assertSeeText('Reviews')
            ->assertSeeText('Opening times')
            ->assertSeeText('Additional information')
            ->assertSeeText('About Glow House')
            ->assertSeeText('Get directions')
            ->assertSee('/business/glow-house/book', false)
            ->assertSeeText('Book now');
    }

    public function test_the_public_business_page_returns_not_found_if_the_business_does_not_exist(): void
    {
        $response = $this->get('/business/glow-house');

        $response->assertNotFound();
    }

    public function test_the_business_booking_page_renders_publicly_after_profile_setup(): void
    {
        $this->createBusiness();

        $response = $this->get('/business/glow-house/book?service=head-and-shoulder-massage');

        $response
            ->assertOk()
            ->assertSeeText('Book your appointment')
            ->assertSeeText('Choose a service')
            ->assertSeeText('Choose a date')
            ->assertSeeText('Confirm booking request');
    }

    public function test_the_business_booking_form_persists_a_valid_booking_request(): void
    {
        $this->createBusiness();

        $appointmentDate = now()->format('Y-m-d');

        $response = $this->post('/business/glow-house/book', [
            'service' => 'head-and-shoulder-massage',
            'appointment_date' => $appointmentDate,
            'appointment_time' => '9:00 am',
            'staff' => 'zuri',
            'customer_name' => 'Jane Customer',
            'customer_phone' => '+254700000001',
            'customer_notes' => 'Please keep the slot on time.',
        ]);

        $response
            ->assertRedirect('/business/glow-house/book?service=head-and-shoulder-massage&staff=zuri')
            ->assertSessionHas('booking_success');

        $this->assertDatabaseHas('bookings', [
            'service_slug' => 'head-and-shoulder-massage',
            'service_name' => 'Head and Shoulder Massage',
            'appointment_time' => '9:00 am',
            'staff_slug' => 'zuri',
            'staff_name' => 'Zuri',
            'customer_name' => 'Jane Customer',
            'customer_phone' => '+254700000001',
            'customer_notes' => 'Please keep the slot on time.',
            'status' => 'pending',
        ]);

        $booking = Business::query()
            ->where('slug', 'glow-house')
            ->firstOrFail()
            ->bookings()
            ->firstOrFail();

        $this->assertSame($appointmentDate, $booking->appointment_date?->format('Y-m-d'));
    }

    public function test_the_owner_can_view_bookings_from_the_business_tools_area(): void
    {
        $business = $this->createBusiness();

        $business->bookings()->create([
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
        ]);

        $response = $this
            ->withSession(['business_signup_email' => 'owner@bookrahisi.test'])
            ->get('/for-business/tools/bookings');

        $response
            ->assertOk()
            ->assertSeeText('Customer bookings')
            ->assertSeeText('Jane Customer')
            ->assertSeeText('Head and Shoulder Massage')
            ->assertSeeText('+254700000001')
            ->assertSeeText('Please keep the slot on time.');
    }

    public function test_the_owner_dashboard_shows_recent_bookings_after_login(): void
    {
        $business = $this->createBusiness();

        $business->bookings()->create([
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
        ]);

        $response = $this
            ->withSession(['business_signup_email' => 'owner@bookrahisi.test'])
            ->get('/for-business/tools');

        $response
            ->assertOk()
            ->assertSeeText('Your dashboard is ready')
            ->assertSeeText('Recent bookings')
            ->assertSeeText('Jane Customer')
            ->assertSeeText('Head and Shoulder Massage')
            ->assertSeeText('Please keep the slot on time.');
    }

    public function test_the_owner_bookings_page_redirects_to_sign_in_without_an_owner_session(): void
    {
        $response = $this->get('/for-business/tools/bookings');

        $response->assertRedirect('/for-business/sign-in');
    }

    private function ownerOnboardingSession(): array
    {
        return [
            'business_signup_email' => 'owner@bookrahisi.test',
            'business_account_setup' => $this->accountSetupSession(),
        ];
    }

    private function accountSetupSession(): array
    {
        return [
            'first_name' => 'Amina',
            'last_name' => 'Njeri',
            'business_name' => 'Glow House',
            'phone' => '+254711223344',
            'business_category' => 'Salon',
        ];
    }

    private function profileDetailsSession(): array
    {
        return [
            'tagline' => 'Modern salon care for busy city clients.',
            'address_line' => 'Prestige Plaza, Ngong Road',
            'city' => 'Nairobi',
            'neighborhood' => 'Kilimani',
            'opening_time' => '09:00',
            'closing_time' => '19:00',
            'about' => 'We focus on precision cuts, healthy hair routines, and a calm guest experience.',
        ];
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
}
