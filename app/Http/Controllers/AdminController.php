<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BlogPost;
use App\Models\Business;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
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

        $activeAdminSection = $request->query('section') === 'pages'
            ? 'pages'
            : 'overview';
        $blogPostsTableExists = $this->blogPostsTableExists();

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

        $blogPosts = $blogPostsTableExists
            ? BlogPost::query()
                ->latest('published_at')
                ->latest()
                ->get()
            : collect();

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

        $totalBlogPosts = $blogPostsTableExists ? BlogPost::query()->count() : 0;
        $publishedBlogPosts = $blogPostsTableExists ? BlogPost::query()->where('status', 'published')->count() : 0;
        $draftBlogPosts = $blogPostsTableExists ? BlogPost::query()->where('status', 'draft')->count() : 0;

        $topBusinesses = Business::query()
            ->withCount('bookings')
            ->orderByDesc('bookings_count')
            ->take(5)
            ->get();

        if ($activeAdminSection === 'pages') {
            $pagesEditId = $request->query('pages_edit');
            $pagesMode = $request->query('pages_mode');

            if ($pagesMode === 'create') {
                return view('admin-pages-form', [
                    'admin' => $admin,
                    'blogPost' => null,
                    'blogPostsTableExists' => $blogPostsTableExists,
                    'draftBlogPosts' => $draftBlogPosts,
                    'formAction' => route('admin.pages.store'),
                    'formMode' => 'create',
                    'pageHeading' => 'Add Page',
                    'pageSubtitle' => 'Create a new blog page with a title, cover image, summary, and full content body.',
                    'previewUrl' => null,
                    'publishedBlogPosts' => $publishedBlogPosts,
                ]);
            }

            if ($pagesEditId !== null && $blogPostsTableExists) {
                $blogPostRecord = BlogPost::query()->findOrFail($pagesEditId);

                return view('admin-pages-form', [
                    'admin' => $admin,
                    'blogPost' => $blogPostRecord,
                    'blogPostsTableExists' => true,
                    'draftBlogPosts' => $draftBlogPosts,
                    'formAction' => route('admin.pages.update', ['blogPost' => $blogPostRecord]),
                    'formMode' => 'edit',
                    'pageHeading' => 'Update Page',
                    'pageSubtitle' => 'Refine the page copy, media, slug, and publish state from one focused editor.',
                    'previewUrl' => $blogPostRecord->status === 'published'
                        ? route('blog.show', ['slug' => $blogPostRecord->slug])
                        : null,
                    'publishedBlogPosts' => $publishedBlogPosts,
                ]);
            }

            return view('admin-pages-index', [
                'admin' => $admin,
                'blogPosts' => $blogPosts,
                'blogPostsTableExists' => $blogPostsTableExists,
                'draftBlogPosts' => $draftBlogPosts,
                'publishedBlogPosts' => $publishedBlogPosts,
                'totalBlogPosts' => $totalBlogPosts,
            ]);
        }

        return view('admin-dashboard', [
            'activeAdminSection' => $activeAdminSection,
            'activeUsers' => $activeUsers,
            'admin' => $admin,
            'approvedBusinesses' => $approvedBusinesses,
            'blogPosts' => $blogPosts,
            'blogPostsTableExists' => $blogPostsTableExists,
            'bookings' => $bookings,
            'businesses' => $businesses,
            'cancelledBookings' => $cancelledBookings,
            'completedBookings' => $completedBookings,
            'confirmedBookings' => $confirmedBookings,
            'draftBlogPosts' => $draftBlogPosts,
            'paidBookings' => $paidBookings,
            'payments' => $payments,
            'pendingBookings' => $pendingBookings,
            'pendingBusinesses' => $pendingBusinesses,
            'pendingPayments' => $pendingPayments,
            'publishedBlogPosts' => $publishedBlogPosts,
            'refundedPayments' => $refundedPayments,
            'rejectedBusinesses' => $rejectedBusinesses,
            'suspendedUsers' => $suspendedUsers,
            'topBusinesses' => $topBusinesses,
            'totalBlogPosts' => $totalBlogPosts,
            'totalBookings' => $totalBookings,
            'totalBusinesses' => $totalBusinesses,
            'totalUsers' => $totalUsers,
            'users' => $users,
        ]);
    }

    public function pagesIndex(Request $request): View|RedirectResponse
    {
        return redirect()->route('admin.dashboard', ['section' => 'pages']);
    }

    public function createPage(Request $request): View|RedirectResponse
    {
        return redirect()->route('admin.dashboard', [
            'section' => 'pages',
            'pages_mode' => 'create',
        ]);
    }

    public function editPage(Request $request, string $blogPost): View|RedirectResponse
    {
        return redirect()->route('admin.dashboard', [
            'section' => 'pages',
            'pages_edit' => $blogPost,
        ]);
    }

    public function storeBlogPost(Request $request): RedirectResponse
    {
        $admin = $this->authenticatedAdmin($request);

        if (! $admin) {
            return redirect()->route('admin.sign-in');
        }

        if (! $this->blogPostsTableExists()) {
            return redirect()->route('admin.dashboard', ['section' => 'pages'])
                ->withErrors(['blog_posts' => 'The blog post table is missing on this server. Run migrations before creating blog posts.']);
        }

        $validated = $this->validatedBlogPostData($request);
        $status = $validated['status'];

        $blogPost = BlogPost::query()->create([
            'admin_user_id' => $admin->id,
            'author_name' => $admin->name,
            'title' => $validated['title'],
            'slug' => $this->uniqueBlogPostSlug($validated['slug'], $validated['title']),
            'cover_image_url' => $validated['cover_image_url'],
            'status' => $status,
            'excerpt' => $validated['excerpt'],
            'body' => $validated['body'],
            'published_at' => $status === 'published' ? now() : null,
        ]);

        return redirect()->route('admin.dashboard', [
            'section' => 'pages',
            'pages_edit' => $blogPost->id,
        ])->with('admin_success', 'Page created successfully.');
    }

    public function updateBlogPost(Request $request, string $blogPost): RedirectResponse
    {
        $admin = $this->authenticatedAdmin($request);

        if (! $admin) {
            return redirect()->route('admin.sign-in');
        }

        if (! $this->blogPostsTableExists()) {
            return redirect()->route('admin.dashboard', ['section' => 'pages'])
                ->withErrors(['blog_posts' => 'The blog post table is missing on this server. Run migrations before updating blog posts.']);
        }

        $blogPostRecord = BlogPost::query()->findOrFail($blogPost);

        $validated = $this->validatedBlogPostData($request);
        $status = $validated['status'];
        $publishedAt = $status === 'published'
            ? ($blogPostRecord->published_at ?? now())
            : null;

        $blogPostRecord->update([
            'admin_user_id' => $admin->id,
            'author_name' => $admin->name,
            'title' => $validated['title'],
            'slug' => $this->uniqueBlogPostSlug($validated['slug'], $validated['title'], $blogPostRecord),
            'cover_image_url' => $validated['cover_image_url'],
            'status' => $status,
            'excerpt' => $validated['excerpt'],
            'body' => $validated['body'],
            'published_at' => $publishedAt,
        ]);

        return redirect()->route('admin.dashboard', [
            'section' => 'pages',
            'pages_edit' => $blogPostRecord->id,
        ])->with('admin_success', 'Page updated successfully.');
    }

    public function bulkUpdateBlogPosts(Request $request): RedirectResponse
    {
        $admin = $this->authenticatedAdmin($request);

        if (! $admin) {
            return redirect()->route('admin.sign-in');
        }

        if (! $this->blogPostsTableExists()) {
            return redirect()->route('admin.dashboard', ['section' => 'pages'])
                ->withErrors(['blog_posts' => 'The blog post table is missing on this server. Run migrations before managing pages.']);
        }

        $validated = $request->validate([
            'action' => ['required', Rule::in(['publish', 'draft', 'delete'])],
            'selected_posts' => ['required', 'array', 'min:1'],
            'selected_posts.*' => ['integer'],
        ]);

        $selectedPosts = BlogPost::query()
            ->whereIn('id', $validated['selected_posts'])
            ->get();

        if ($selectedPosts->isEmpty()) {
            return redirect()->route('admin.dashboard', ['section' => 'pages'])
                ->withErrors(['selected_posts' => 'Select at least one page to continue.']);
        }

        if ($validated['action'] === 'delete') {
            BlogPost::query()
                ->whereIn('id', $selectedPosts->pluck('id'))
                ->delete();

            return redirect()->route('admin.dashboard', ['section' => 'pages'])
                ->with('admin_success', 'Selected pages deleted successfully.');
        }

        $selectedPosts->each(function (BlogPost $blogPost) use ($validated): void {
            $blogPost->update([
                'status' => $validated['action'] === 'publish' ? 'published' : 'draft',
                'published_at' => $validated['action'] === 'publish'
                    ? ($blogPost->published_at ?? now())
                    : null,
            ]);
        });

        return redirect()->route('admin.dashboard', ['section' => 'pages'])
            ->with('admin_success', $validated['action'] === 'publish'
                ? 'Selected pages published successfully.'
                : 'Selected pages moved to draft successfully.');
    }

    public function deleteBlogPost(Request $request, string $blogPost): RedirectResponse
    {
        $admin = $this->authenticatedAdmin($request);

        if (! $admin) {
            return redirect()->route('admin.sign-in');
        }

        if (! $this->blogPostsTableExists()) {
            return redirect()->route('admin.dashboard', ['section' => 'pages'])
                ->withErrors(['blog_posts' => 'The blog post table is missing on this server. Run migrations before deleting pages.']);
        }

        $blogPostRecord = BlogPost::query()->findOrFail($blogPost);
        $blogPostRecord->delete();

        return redirect()->route('admin.dashboard', ['section' => 'pages'])
            ->with('admin_success', 'Page deleted successfully.');
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

    private function blogPostsTableExists(): bool
    {
        return Schema::hasTable('blog_posts');
    }

    private function validatedBlogPostData(Request $request): array
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:160'],
            'slug' => ['nullable', 'string', 'max:180'],
            'cover_image_url' => ['nullable', 'url', 'max:2048'],
            'status' => ['required', Rule::in(['draft', 'published'])],
            'excerpt' => ['required', 'string', 'max:600'],
            'body' => ['required', 'string', 'max:20000'],
        ]);

        $validated['title'] = trim($validated['title']);
        $validated['slug'] = trim((string) ($validated['slug'] ?? ''));
        $validated['cover_image_url'] = trim((string) ($validated['cover_image_url'] ?? '')) ?: null;
        $validated['excerpt'] = trim($validated['excerpt']);
        $validated['body'] = trim($validated['body']);

        return $validated;
    }

    private function uniqueBlogPostSlug(?string $requestedSlug, string $title, ?BlogPost $ignore = null): string
    {
        $baseSlug = Str::slug($requestedSlug ?: $title);
        $baseSlug = $baseSlug !== '' ? $baseSlug : 'blog-post';
        $slug = $baseSlug;
        $counter = 2;

        while (BlogPost::query()
            ->when($ignore, fn ($query) => $query->where('id', '!=', $ignore->id))
            ->where('slug', $slug)
            ->exists()) {
            $slug = $baseSlug.'-'.$counter;
            $counter++;
        }

        return $slug;
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
