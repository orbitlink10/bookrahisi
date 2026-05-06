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
use Illuminate\Validation\ValidationException;
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
        $blogPostMissingEnhancedColumns = $blogPostsTableExists
            ? $this->blogPostMissingEnhancedColumns()
            : [];
        $pagesViewMode = 'list';
        $pageEditorPost = null;
        $pagesFormAction = route('admin.pages.store');
        $pagesPageHeading = 'Add New Post';
        $pagesPageSubtitle = 'Create a new page with page metadata, a featured image, and rich text content.';
        $pagesPreviewUrl = null;

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
                $pagesViewMode = 'create';
            }

            if ($pagesEditId !== null && $blogPostsTableExists) {
                $pageEditorPost = BlogPost::query()->findOrFail($pagesEditId);
                $pagesViewMode = 'edit';
                $pagesFormAction = route('admin.pages.update', ['blogPost' => $pageEditorPost]);
                $pagesPageHeading = 'Update Post';
                $pagesPageSubtitle = 'Refine the page metadata, layout copy, and publishing settings from the same dashboard workspace.';
                $pagesPreviewUrl = $pageEditorPost->status === 'published'
                    ? route('blog.show', ['slug' => $pageEditorPost->slug])
                    : null;
            }
        }

        return view('admin-dashboard', [
            'activeAdminSection' => $activeAdminSection,
            'activeUsers' => $activeUsers,
            'admin' => $admin,
            'approvedBusinesses' => $approvedBusinesses,
            'blogPosts' => $blogPosts,
            'blogPostMissingEnhancedColumns' => $blogPostMissingEnhancedColumns,
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
            'pageEditorPost' => $pageEditorPost,
            'pagesFormAction' => $pagesFormAction,
            'pagesPageHeading' => $pagesPageHeading,
            'pagesPageSubtitle' => $pagesPageSubtitle,
            'pagesPreviewUrl' => $pagesPreviewUrl,
            'pagesViewMode' => $pagesViewMode,
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
        $blogPost = BlogPost::query()->create($this->blogPostPersistenceAttributes(
            validated: $validated,
            admin: $admin,
            publishedAt: $status === 'published' ? now() : null,
        ));

        return redirect()->route('admin.dashboard', [
            'section' => 'pages',
            'pages_edit' => $blogPost->id,
        ])->with('admin_success', $this->blogPostSavedMessage('created'));
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
        $blogPostRecord->update($this->blogPostPersistenceAttributes(
            validated: $validated,
            admin: $admin,
            publishedAt: $publishedAt,
            existingPost: $blogPostRecord,
        ));

        return redirect()->route('admin.dashboard', [
            'section' => 'pages',
            'pages_edit' => $blogPostRecord->id,
        ])->with('admin_success', $this->blogPostSavedMessage('updated'));
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

    private function blogPostColumnNames(): array
    {
        if (! $this->blogPostsTableExists()) {
            return [];
        }

        return Schema::getColumnListing('blog_posts');
    }

    private function blogPostMissingEnhancedColumns(): array
    {
        $availableColumns = $this->blogPostColumnNames();
        $enhancedColumns = ['meta_title', 'heading_two', 'image_alt_text', 'content_type'];

        return array_values(array_diff($enhancedColumns, $availableColumns));
    }

    private function blogPostPersistenceAttributes(array $validated, User $admin, ?\Illuminate\Support\Carbon $publishedAt, ?BlogPost $existingPost = null): array
    {
        $availableColumns = $this->blogPostColumnNames();
        $body = $validated['body'];

        if (! in_array('heading_two', $availableColumns, true)) {
            $body = $this->bodyWithLegacyHeadingTwo($body, $validated['heading_two']);
        }

        $attributes = [
            'admin_user_id' => $admin->id,
            'author_name' => $admin->name,
            'meta_title' => $validated['meta_title'],
            'title' => $validated['title'],
            'heading_two' => $validated['heading_two'],
            'slug' => $this->uniqueBlogPostSlug($validated['slug'], $validated['title'], $existingPost),
            'cover_image_url' => $validated['cover_image_url'],
            'image_alt_text' => $validated['image_alt_text'],
            'status' => $validated['status'],
            'content_type' => $validated['content_type'],
            'excerpt' => $validated['meta_description'],
            'body' => $body,
            'published_at' => $publishedAt,
        ];

        return array_intersect_key($attributes, array_flip($availableColumns));
    }

    private function bodyWithLegacyHeadingTwo(string $body, ?string $headingTwo): string
    {
        $headingTwo = trim((string) $headingTwo);

        if ($headingTwo === '') {
            return $body;
        }

        if (Str::contains(Str::lower(strip_tags($body)), Str::lower($headingTwo))) {
            return $body;
        }

        return '<h2>'.e($headingTwo).'</h2>'.$body;
    }

    private function blogPostSavedMessage(string $action): string
    {
        $message = 'Page '.($action === 'created' ? 'created' : 'updated').' successfully.';

        if ($this->blogPostMissingEnhancedColumns() === []) {
            return $message;
        }

        return $message.' This server is still missing the newer page columns, so advanced metadata fields will save fully after the latest migrations are run.';
    }

    private function validatedBlogPostData(Request $request): array
    {
        if (! $request->has('meta_description') && $request->has('excerpt')) {
            $request->merge([
                'meta_description' => $request->input('excerpt'),
            ]);
        }

        if (! $request->has('meta_title') && $request->filled('title')) {
            $request->merge([
                'meta_title' => $request->input('title'),
            ]);
        }

        if (! $request->has('image_alt_text') && $request->filled('title')) {
            $request->merge([
                'image_alt_text' => $request->input('title'),
            ]);
        }

        if (! $request->has('content_type')) {
            $request->merge([
                'content_type' => 'post',
            ]);
        }

        $validated = $request->validate([
            'meta_title' => ['required', 'string', 'max:160'],
            'meta_description' => ['required', 'string', 'max:600'],
            'title' => ['required', 'string', 'max:160'],
            'heading_two' => ['nullable', 'string', 'max:160'],
            'slug' => ['nullable', 'string', 'max:180'],
            'cover_image_url' => ['nullable', 'url', 'max:2048'],
            'image_alt_text' => ['required', 'string', 'max:255'],
            'status' => ['required', Rule::in(['draft', 'published'])],
            'content_type' => ['required', Rule::in(['post'])],
            'body' => ['required', 'string', 'max:50000'],
        ]);

        $validated['meta_title'] = strip_tags(trim($validated['meta_title']));
        $validated['meta_description'] = strip_tags(trim($validated['meta_description']));
        $validated['title'] = strip_tags(trim($validated['title']));
        $validated['heading_two'] = strip_tags(trim((string) ($validated['heading_two'] ?? ''))) ?: null;
        $validated['slug'] = strip_tags(trim((string) ($validated['slug'] ?? '')));
        $validated['cover_image_url'] = trim((string) ($validated['cover_image_url'] ?? '')) ?: null;
        $validated['image_alt_text'] = strip_tags(trim($validated['image_alt_text']));
        $validated['content_type'] = strip_tags(trim($validated['content_type']));
        $validated['body'] = $this->sanitizeBlogPostBody($validated['body']);

        if (trim(strip_tags($validated['body'])) === '') {
            throw ValidationException::withMessages([
                'body' => 'Page description is required.',
            ]);
        }

        return $validated;
    }

    private function sanitizeBlogPostBody(string $body): string
    {
        $body = trim($body);

        if ($body === '') {
            return '';
        }

        if ($body === strip_tags($body)) {
            return $this->plainTextToHtml($body);
        }

        $document = new \DOMDocument('1.0', 'UTF-8');
        $wrappedBody = '<div>'.$body.'</div>';

        libxml_use_internal_errors(true);
        $document->loadHTML(
            mb_convert_encoding($wrappedBody, 'HTML-ENTITIES', 'UTF-8'),
            LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD
        );
        libxml_clear_errors();

        $allowedTags = [
            'a',
            'blockquote',
            'br',
            'code',
            'div',
            'em',
            'figcaption',
            'figure',
            'h2',
            'h3',
            'h4',
            'iframe',
            'img',
            'li',
            'ol',
            'p',
            'pre',
            'source',
            'span',
            'strong',
            'u',
            'ul',
            'video',
        ];

        $allowedAttributes = [
            '*' => ['class'],
            'a' => ['href', 'target', 'rel'],
            'iframe' => ['allow', 'allowfullscreen', 'frameborder', 'height', 'src', 'title', 'width'],
            'img' => ['alt', 'src', 'title'],
            'source' => ['src', 'type'],
            'video' => ['controls', 'height', 'poster', 'preload', 'src', 'width'],
        ];

        $this->sanitizeRichTextNode($document->documentElement, $allowedTags, $allowedAttributes);

        return trim($this->innerHtml($document->documentElement));
    }

    private function sanitizeRichTextNode(\DOMNode $node, array $allowedTags, array $allowedAttributes): void
    {
        foreach (iterator_to_array($node->childNodes) as $childNode) {
            if ($childNode instanceof \DOMComment) {
                if ($childNode->parentNode === $node) {
                    $node->removeChild($childNode);
                }

                continue;
            }

            if (! $childNode instanceof \DOMElement) {
                continue;
            }

            $tagName = strtolower($childNode->tagName);

            $this->sanitizeRichTextNode($childNode, $allowedTags, $allowedAttributes);

            if (in_array($tagName, ['script', 'style', 'meta', 'link'], true)) {
                if ($childNode->parentNode === $node) {
                    $node->removeChild($childNode);
                }

                continue;
            }

            if (! in_array($tagName, $allowedTags, true)) {
                while ($childNode->firstChild) {
                    $node->insertBefore($childNode->firstChild, $childNode);
                }

                if ($childNode->parentNode === $node) {
                    $node->removeChild($childNode);
                }

                continue;
            }

            foreach (iterator_to_array($childNode->attributes) as $attribute) {
                $attributeName = strtolower($attribute->name);
                $tagAttributes = $allowedAttributes[$tagName] ?? [];
                $globalAttributes = $allowedAttributes['*'] ?? [];

                if (! in_array($attributeName, $tagAttributes, true) && ! in_array($attributeName, $globalAttributes, true)) {
                    $childNode->removeAttributeNode($attribute);

                    continue;
                }

                if (in_array($attributeName, ['href', 'src'], true) && ! $this->allowedRichTextUrl($attribute->value, $tagName)) {
                    $childNode->removeAttributeNode($attribute);
                }
            }

            if ($tagName === 'a' && $childNode->getAttribute('target') === '_blank') {
                $childNode->setAttribute('rel', 'noopener noreferrer');
            }

            if ($tagName === 'iframe') {
                $childNode->setAttribute('loading', 'lazy');
            }

            if ($tagName === 'video' && ! $childNode->hasAttribute('controls')) {
                $childNode->setAttribute('controls', 'controls');
            }
        }
    }

    private function allowedRichTextUrl(string $url, string $tagName): bool
    {
        $url = trim($url);

        if ($url === '') {
            return false;
        }

        if (Str::startsWith($url, ['#', '/'])) {
            return true;
        }

        $parts = parse_url($url);

        if ($parts === false) {
            return false;
        }

        $scheme = strtolower((string) ($parts['scheme'] ?? ''));

        if ($tagName === 'a' && in_array($scheme, ['mailto', 'tel'], true)) {
            return true;
        }

        if (! in_array($scheme, ['http', 'https'], true)) {
            return false;
        }

        if ($tagName !== 'iframe') {
            return true;
        }

        $host = strtolower((string) ($parts['host'] ?? ''));

        return Str::contains($host, [
            'youtube.com',
            'youtu.be',
            'player.vimeo.com',
            'vimeo.com',
        ]);
    }

    private function plainTextToHtml(string $body): string
    {
        $paragraphs = preg_split("/(\r\n|\n|\r){2,}/", trim($body)) ?: [];
        $paragraphs = array_filter(array_map('trim', $paragraphs), static fn (string $paragraph): bool => $paragraph !== '');

        if ($paragraphs === []) {
            $paragraphs = [trim($body)];
        }

        return collect($paragraphs)
            ->map(static fn (string $paragraph): string => '<p>'.nl2br(e($paragraph)).'</p>')
            ->implode("\n");
    }

    private function innerHtml(\DOMElement $element): string
    {
        $html = '';

        foreach ($element->childNodes as $childNode) {
            $html .= $element->ownerDocument->saveHTML($childNode);
        }

        return $html;
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
