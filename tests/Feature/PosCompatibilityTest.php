<?php

namespace Tests\Feature;

use App\Models\Business;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class PosCompatibilityTest extends TestCase
{
    use RefreshDatabase;

    public function test_business_signup_still_works_when_business_role_column_has_not_been_migrated(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->dropColumn('business_role');
        });

        $this->post(route('for-business.sign-in.submit'), [
            'intent' => 'register',
            'first_name' => 'Francis',
            'last_name' => 'Muchiri',
            'business_name' => 'Taji Spa',
            'phone' => '+254729299439',
            'business_category' => 'Spa',
            'email' => 'tajirakamau@gmail.com',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ])
            ->assertRedirect(route('for-business.tools'))
            ->assertSessionHas('business_signup_email', 'tajirakamau@gmail.com');

        $this->assertDatabaseHas('users', [
            'email' => 'tajirakamau@gmail.com',
            'name' => 'Francis Muchiri',
            'phone_number' => '+254729299439',
            'is_admin' => false,
            'account_status' => 'active',
        ]);
    }

    public function test_pos_route_redirects_to_tools_when_pos_tables_are_not_migrated(): void
    {
        $business = $this->createBusiness();

        Schema::dropIfExists('expenses');

        $this->withSession(['business_signup_email' => $business->owner_email])
            ->get(route('for-business.pos'))
            ->assertRedirect(route('for-business.tools'))
            ->assertSessionHas('dashboard_warning');
    }

    public function test_pos_receipt_route_redirects_to_tools_when_pos_tables_are_not_migrated(): void
    {
        $business = $this->createBusiness();

        Schema::dropIfExists('expenses');

        $this->withSession(['business_signup_email' => $business->owner_email])
            ->get(route('for-business.pos.receipt', ['sale' => 999]))
            ->assertRedirect(route('for-business.tools'))
            ->assertSessionHas('dashboard_warning');
    }

    private function createBusiness(array $overrides = []): Business
    {
        User::query()->create([
            'name' => 'Amina Njeri',
            'email' => 'owner@bookrahisi.test',
            'phone_number' => '+254711223344',
            'password' => 'password',
            'is_admin' => false,
            'account_status' => 'active',
            'business_role' => 'Admin',
        ]);

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
