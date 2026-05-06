<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\BlogPost;
use App\Models\Business;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
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
            ->assertSeeText('Pages')
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

    public function test_the_admin_dashboard_still_renders_when_the_blog_posts_table_is_missing(): void
    {
        $admin = $this->createAdminUser();

        Schema::drop('blog_posts');

        $this->withSession(['admin_user_id' => $admin->id])
            ->get('/admin/dashboard')
            ->assertOk()
            ->assertSeeText('Admin dashboard')
            ->assertSeeText('Blog setup is incomplete on this server');
    }

    public function test_admin_can_view_the_pages_manager_and_create_page_screen(): void
    {
        $admin = $this->createAdminUser();

        $this->withSession(['admin_user_id' => $admin->id])
            ->get(route('admin.dashboard', ['section' => 'pages']))
            ->assertOk()
            ->assertSeeText('Pages')
            ->assertSeeText('Manage site pages and published content.')
            ->assertSeeText('Post List')
            ->assertSeeText('Add Page')
            ->assertDontSeeText('Content Admin')
            ->assertDontSeeText('Admin dashboard');

        $this->withSession(['admin_user_id' => $admin->id])
            ->get(route('admin.dashboard', ['section' => 'pages', 'pages_mode' => 'create']))
            ->assertOk()
            ->assertSeeText('Manage Pages')
            ->assertSeeText('Add New Post')
            ->assertSeeText('Meta Title')
            ->assertSeeText('Meta Description')
            ->assertSeeText('Page Description:')
            ->assertSeeText('Create page')
            ->assertDontSeeText('Content Admin')
            ->assertDontSeeText('Admin dashboard');
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

    public function test_admin_can_create_a_published_blog_post_from_the_dashboard(): void
    {
        $admin = $this->createAdminUser();

        $response = $this
            ->withSession(['admin_user_id' => $admin->id])
            ->post(route('admin.pages.store'), [
                'meta_title' => 'First Spa Visit Guide',
                'meta_description' => 'A short guide for customers who want a smoother first spa booking experience.',
                'title' => 'How to prepare for your first spa visit',
                'heading_two' => 'What to know before you arrive',
                'slug' => '',
                'cover_image_url' => 'https://images.unsplash.com/photo-1515377905703-c4788e51af15?auto=format&fit=crop&w=1200&q=80',
                'image_alt_text' => 'Woman enjoying a calming spa treatment',
                'status' => 'published',
                'content_type' => 'post',
                'body' => '<p><strong>Arrive early</strong>, confirm your preferred treatment, and communicate any sensitivities before your appointment starts.</p>',
            ]);

        $blogPost = BlogPost::query()->firstOrFail();

        $response
            ->assertRedirect(route('admin.dashboard', ['section' => 'pages', 'pages_edit' => $blogPost->id]))
            ->assertSessionHas('admin_success');

        $this->assertSame('First Spa Visit Guide', $blogPost->meta_title);
        $this->assertSame('How to prepare for your first spa visit', $blogPost->title);
        $this->assertSame('What to know before you arrive', $blogPost->heading_two);
        $this->assertSame('Woman enjoying a calming spa treatment', $blogPost->image_alt_text);
        $this->assertSame('post', $blogPost->content_type);
        $this->assertSame('how-to-prepare-for-your-first-spa-visit', $blogPost->slug);
        $this->assertSame('published', $blogPost->status);
        $this->assertNotNull($blogPost->published_at);

        $this->withSession(['admin_user_id' => $admin->id])
            ->get(route('admin.dashboard', ['section' => 'pages', 'pages_edit' => $blogPost->id]))
            ->assertOk()
            ->assertSeeText('Update Post')
            ->assertSee($blogPost->title, false);

        $this->get(route('blog.index'))
            ->assertOk()
            ->assertSeeText($blogPost->title)
            ->assertSee(route('blog.show', ['slug' => $blogPost->slug]), false);

        $this->get(route('blog.show', ['slug' => $blogPost->slug]))
            ->assertOk()
            ->assertSeeText($blogPost->title)
            ->assertSeeText('What to know before you arrive')
            ->assertSee('<strong>Arrive early</strong>', false);
    }

    public function test_admin_blog_post_creation_fails_cleanly_when_the_blog_posts_table_is_missing(): void
    {
        $admin = $this->createAdminUser();

        Schema::drop('blog_posts');

        $this->withSession(['admin_user_id' => $admin->id])
            ->post(route('admin.pages.store'), [
                'meta_title' => 'Server not migrated yet',
                'meta_description' => 'This should not crash when the table is missing.',
                'title' => 'Server not migrated yet',
                'slug' => '',
                'cover_image_url' => '',
                'image_alt_text' => 'Server not migrated yet',
                'status' => 'draft',
                'content_type' => 'post',
                'body' => 'The request should redirect back to the dashboard with an actionable error.',
            ])
            ->assertRedirect(route('admin.dashboard', ['section' => 'pages']))
            ->assertSessionHasErrors('blog_posts');

        $this->get(route('blog.index'))
            ->assertOk()
            ->assertSeeText('The blog is not available yet');
    }

    public function test_draft_blog_posts_are_not_visible_publicly(): void
    {
        $admin = $this->createAdminUser();

        $response = $this->withSession(['admin_user_id' => $admin->id])
            ->post(route('admin.pages.store'), [
                'meta_title' => 'Draft only story',
                'meta_description' => 'This should stay private until an admin publishes it.',
                'title' => 'Draft only story',
                'slug' => '',
                'cover_image_url' => '',
                'image_alt_text' => 'Draft only story',
                'status' => 'draft',
                'content_type' => 'post',
                'body' => 'Internal draft content that should not appear on the public blog.',
            ]);

        $blogPost = BlogPost::query()->firstOrFail();

        $response->assertRedirect(route('admin.dashboard', ['section' => 'pages', 'pages_edit' => $blogPost->id]));

        $this->assertSame('draft', $blogPost->status);
        $this->assertNull($blogPost->published_at);

        $this->get(route('blog.index'))
            ->assertOk()
            ->assertDontSeeText('Draft only story');

        $this->get(route('blog.show', ['slug' => $blogPost->slug]))
            ->assertNotFound();
    }

    public function test_admin_can_update_and_publish_an_existing_blog_post(): void
    {
        $admin = $this->createAdminUser();
        $blogPost = $this->createBlogPost([
            'status' => 'draft',
            'published_at' => null,
            'slug' => 'quiet-draft',
            'title' => 'Quiet draft',
        ]);

        $response = $this
            ->withSession(['admin_user_id' => $admin->id])
            ->post(route('admin.pages.update', ['blogPost' => $blogPost]), [
                'meta_title' => 'Quiet Draft Now Live',
                'meta_description' => 'The draft has been updated and moved to the live blog.',
                'title' => 'Quiet draft now live',
                'heading_two' => 'The page is now public',
                'slug' => 'quiet-draft-now-live',
                'cover_image_url' => 'https://images.unsplash.com/photo-1544161515-4ab6ce6db874?auto=format&fit=crop&w=1200&q=80',
                'image_alt_text' => 'Relaxing spa scene for a published article',
                'status' => 'published',
                'content_type' => 'post',
                'body' => '<p>This article is now visible to readers on the public blog.</p>',
            ]);

        $response->assertRedirect(route('admin.dashboard', ['section' => 'pages', 'pages_edit' => $blogPost->id]));

        $blogPost->refresh();

        $this->assertSame('Quiet draft now live', $blogPost->title);
        $this->assertSame('Quiet Draft Now Live', $blogPost->meta_title);
        $this->assertSame('The page is now public', $blogPost->heading_two);
        $this->assertSame('quiet-draft-now-live', $blogPost->slug);
        $this->assertSame('published', $blogPost->status);
        $this->assertNotNull($blogPost->published_at);

        $this->get(route('blog.show', ['slug' => $blogPost->slug]))
            ->assertOk()
            ->assertSeeText('Quiet draft now live')
            ->assertSeeText('This article is now visible');
    }

    public function test_admin_can_publish_pages_in_bulk_from_the_pages_manager(): void
    {
        $admin = $this->createAdminUser();
        $first = $this->createBlogPost(['status' => 'draft', 'published_at' => null]);
        $second = $this->createBlogPost(['status' => 'draft', 'published_at' => null]);

        $this->withSession(['admin_user_id' => $admin->id])
            ->post(route('admin.pages.bulk'), [
                'action' => 'publish',
                'selected_posts' => [$first->id, $second->id],
            ])
            ->assertRedirect(route('admin.dashboard', ['section' => 'pages']))
            ->assertSessionHas('admin_success');

        $first->refresh();
        $second->refresh();

        $this->assertSame('published', $first->status);
        $this->assertSame('published', $second->status);
        $this->assertNotNull($first->published_at);
        $this->assertNotNull($second->published_at);
    }

    public function test_admin_can_delete_a_page_from_the_pages_manager(): void
    {
        $admin = $this->createAdminUser();
        $blogPost = $this->createBlogPost();

        $this->withSession(['admin_user_id' => $admin->id])
            ->post(route('admin.pages.destroy', ['blogPost' => $blogPost]))
            ->assertRedirect(route('admin.dashboard', ['section' => 'pages']))
            ->assertSessionHas('admin_success');

        $this->assertDatabaseMissing('blog_posts', [
            'id' => $blogPost->id,
        ]);
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

    private function createBlogPost(array $overrides = []): BlogPost
    {
        $admin = $this->createAdminUser([
            'email' => 'blog-admin-'.uniqid().'@bookrahisi.test',
        ]);

        return BlogPost::query()->create(array_merge([
            'admin_user_id' => $admin->id,
            'author_name' => $admin->name,
            'meta_title' => 'Sample blog post',
            'title' => 'Sample blog post',
            'heading_two' => 'Sample supporting heading',
            'slug' => 'sample-blog-post-'.uniqid(),
            'cover_image_url' => 'https://images.unsplash.com/photo-1519823551278-64ac92734fb1?auto=format&fit=crop&w=1200&q=80',
            'image_alt_text' => 'Sample blog post',
            'status' => 'published',
            'content_type' => 'post',
            'excerpt' => 'Sample excerpt for a published blog post.',
            'body' => 'Sample body copy for a published blog post.',
            'published_at' => now(),
        ], $overrides));
    }
}
