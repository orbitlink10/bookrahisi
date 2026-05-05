<?php

namespace Tests\Feature;

use App\Models\Business;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BusinessDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_business_settings_page_requires_an_owner_session(): void
    {
        $this->get('/for-business/tools/settings')->assertRedirect('/for-business/sign-in');
    }

    public function test_an_authenticated_business_owner_can_view_the_settings_console(): void
    {
        $business = $this->createBusiness();

        $this->withSession(['business_signup_email' => $business->owner_email])
            ->get('/for-business/tools/settings')
            ->assertOk()
            ->assertSeeText('Settings')
            ->assertSeeText('Business setup')
            ->assertSeeText('Scheduling')
            ->assertSeeText('Sales')
            ->assertSeeText('Clients')
            ->assertSeeText('Billing details')
            ->assertSeeText('Team')
            ->assertSeeText('Online presence')
            ->assertSeeText('Marketing')
            ->assertSeeText('Other');
    }

    public function test_the_business_dashboard_links_to_the_settings_console(): void
    {
        $business = $this->createBusiness();

        $this->withSession(['business_signup_email' => $business->owner_email])
            ->get('/for-business/tools')
            ->assertOk()
            ->assertSeeText('Settings');
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
