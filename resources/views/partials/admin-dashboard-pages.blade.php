@php
    $currentTitle = old('title', $pageEditorPost?->title ?? '');
    $currentSlug = old('slug', $pageEditorPost?->slug ?? '');
    $currentCoverImage = old('cover_image_url', $pageEditorPost?->cover_image_url ?? '');
    $currentStatus = old('status', $pageEditorPost?->status ?? 'draft');
    $currentExcerpt = old('excerpt', $pageEditorPost?->excerpt ?? '');
    $currentBody = old('body', $pageEditorPost?->body ?? '');
    $isEditingPage = ($pagesViewMode ?? 'list') !== 'list';
@endphp

<section class="pages-head" id="pages">
    <div>
        <span class="eyebrow">Content studio</span>
        <h1>Pages</h1>
        <p class="subtitle">Manage site pages and published content from the main admin dashboard.</p>
    </div>

    <div class="toolbar">
        <a class="button-light" href="{{ route('admin.dashboard') }}">Dashboard overview</a>
        <a class="button-primary" href="{{ route('admin.dashboard', ['section' => 'pages', 'pages_mode' => 'create']) }}">
            <span style="font-size: 1.2rem; line-height: 1;">+</span>
            <span>Add Page</span>
        </a>
    </div>
</section>

<section class="pages-stats-grid">
    <article class="pages-stat-card">
        <div class="report-title">Total pages</div>
        <div class="report-value">{{ $totalBlogPosts }}</div>
        <div class="entity-extra">All saved blog pages in the content manager.</div>
    </article>
    <article class="pages-stat-card">
        <div class="report-title">Published</div>
        <div class="report-value">{{ $publishedBlogPosts }}</div>
        <div class="entity-extra">Visible on the public blog and ready for preview.</div>
    </article>
    <article class="pages-stat-card">
        <div class="report-title">Drafts</div>
        <div class="report-value">{{ $draftBlogPosts }}</div>
        <div class="entity-extra">Still being edited before going live.</div>
    </article>
</section>

<section class="panel pages-panel">
    <div class="pages-panel-head">
        <div>
            <h2 class="panel-title">Post List</h2>
            <p class="panel-copy">Review each page, preview published entries, and keep editing in the same dashboard workspace.</p>
        </div>
        <a class="button-primary" href="{{ route('admin.dashboard', ['section' => 'pages', 'pages_mode' => 'create']) }}">
            <span style="font-size: 1.2rem; line-height: 1;">+</span>
            <span>Add Page</span>
        </a>
    </div>

    @if (! $blogPostsTableExists)
        <div class="pages-empty-state">The `blog_posts` table is not available on this server yet. Run the latest migrations before creating or managing pages.</div>
    @else
        <div class="pages-table-toolbar">
            <form class="pages-bulk-form" id="bulk-pages-form" action="{{ route('admin.pages.bulk') }}" method="post">
                @csrf
                <select class="field-select" name="action">
                    <option value="">Bulk actions</option>
                    <option value="publish">Publish</option>
                    <option value="draft">Move to draft</option>
                    <option value="delete">Delete</option>
                </select>
                <button class="button-primary" type="submit">Apply</button>
            </form>
        </div>

        <div class="pages-table-wrap">
            <table class="pages-table">
                <thead>
                    <tr>
                        <th style="width: 44px;">
                            <input
                                class="pages-field-checkbox"
                                type="checkbox"
                                id="select-all-posts"
                                onclick="document.querySelectorAll('.js-post-checkbox').forEach((checkbox) => checkbox.checked = this.checked)"
                            >
                        </th>
                        <th style="width: 90px;">No.</th>
                        <th style="width: 220px;">Image</th>
                        <th>Title</th>
                        <th>Alt Text</th>
                        <th style="width: 140px;">Type</th>
                        <th style="width: 280px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($blogPosts as $index => $blogPost)
                        <tr>
                            <td>
                                <input class="pages-field-checkbox js-post-checkbox" type="checkbox" name="selected_posts[]" value="{{ $blogPost->id }}" form="bulk-pages-form">
                            </td>
                            <td>
                                <div class="pages-post-number">{{ $index + 1 }}</div>
                            </td>
                            <td>
                                <div
                                    class="pages-thumb"
                                    @if ($blogPost->cover_image_url)
                                        style="background-image: linear-gradient(180deg, rgba(17, 19, 23, 0.05), rgba(17, 19, 23, 0.18)), url('{{ $blogPost->cover_image_url }}');"
                                    @else
                                        style="background-image: linear-gradient(135deg, #eef4fb 0%, #d8e8ff 100%);"
                                    @endif
                                ></div>
                            </td>
                            <td>
                                <div class="pages-post-title">{{ $blogPost->title }}</div>
                                <div class="entity-extra">{{ $blogPost->slug }}</div>
                                <div class="entity-extra">
                                    <span class="pages-status-pill {{ $blogPost->status === 'published' ? 'is-published' : 'is-draft' }}">{{ $blogPost->status }}</span>
                                </div>
                            </td>
                            <td>{{ $blogPost->title }}</td>
                            <td>Post</td>
                            <td>
                                <div class="pages-row-actions">
                                    @if ($blogPost->status === 'published')
                                        <a class="button-soft" href="{{ route('blog.show', ['slug' => $blogPost->slug]) }}" target="_blank" rel="noopener noreferrer">Preview</a>
                                    @else
                                        <span class="button-muted">Draft</span>
                                    @endif
                                    <a class="button-light" href="{{ route('admin.dashboard', ['section' => 'pages', 'pages_edit' => $blogPost->id]) }}">Update</a>
                                    <form action="{{ route('admin.pages.destroy', ['blogPost' => $blogPost]) }}" method="post" onsubmit="return confirm('Delete this page?');">
                                        @csrf
                                        <button class="button-danger" type="submit">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="padding: 0;">
                                <div class="pages-empty-state" style="margin: 20px 0 0;">No pages have been created yet. Use the Add Page button to open the editor and publish your first blog page.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endif
</section>

@if ($isEditingPage)
    <section class="panel pages-editor-shell">
        <div class="pages-panel-head">
            <div>
                <span class="eyebrow">Page editor</span>
                <h2 class="panel-title" style="margin-top: 16px;">{{ $pagesPageHeading }}</h2>
                <p class="panel-copy">{{ $pagesPageSubtitle }}</p>
            </div>
            <div class="toolbar">
                <a class="button-light" href="{{ route('admin.dashboard', ['section' => 'pages']) }}">Back to pages</a>
                @if ($pagesPreviewUrl)
                    <a class="button-soft" href="{{ $pagesPreviewUrl }}" target="_blank" rel="noopener noreferrer">Preview live page</a>
                @endif
            </div>
        </div>

        @if (! $blogPostsTableExists)
            <div class="pages-empty-state">The `blog_posts` table is missing on this server, so the editor is unavailable until the latest migrations are run.</div>
        @else
            <div class="pages-editor-grid">
                <section class="pages-editor-card">
                    <form action="{{ $pagesFormAction }}" method="post">
                        @csrf

                        <div class="form-grid">
                            <div class="field-group">
                                <label class="field-label" for="page-title">Title</label>
                                <input class="field-input" id="page-title" type="text" name="title" value="{{ $currentTitle }}" placeholder="How to prepare for your first spa visit">
                            </div>

                            <div class="field-group">
                                <label class="field-label" for="page-slug">Slug</label>
                                <input class="field-input" id="page-slug" type="text" name="slug" value="{{ $currentSlug }}" placeholder="optional-custom-slug">
                                <span class="field-hint">Leave blank to generate the slug from the title.</span>
                            </div>

                            <div class="field-group">
                                <label class="field-label" for="page-cover-image">Cover image URL</label>
                                <input class="field-input" id="page-cover-image" type="url" name="cover_image_url" value="{{ $currentCoverImage }}" placeholder="https://images.unsplash.com/...">
                            </div>

                            <div class="field-group">
                                <label class="field-label" for="page-status">Status</label>
                                <select class="field-select" id="page-status" name="status">
                                    @foreach (['draft', 'published'] as $status)
                                        <option value="{{ $status }}" @selected($currentStatus === $status)>{{ ucfirst($status) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="field-group field-group-full">
                                <label class="field-label" for="page-excerpt">Excerpt</label>
                                <textarea class="field-textarea" id="page-excerpt" name="excerpt" placeholder="Write the summary customers should see in listings and previews.">{{ $currentExcerpt }}</textarea>
                                <span class="field-hint">Use 1-3 tight paragraphs that explain what the page is about before the reader opens the full article.</span>
                            </div>

                            <div class="field-group field-group-full">
                                <label class="field-label" for="page-body">Body</label>
                                <textarea class="field-textarea pages-field-body" id="page-body" name="body" placeholder="Write the full page or blog content here. Line breaks are preserved on the public page.">{{ $currentBody }}</textarea>
                            </div>
                        </div>

                        <div class="toolbar" style="margin-top: 24px;">
                            <button class="button-primary" type="submit">{{ $pagesViewMode === 'create' ? 'Create page' : 'Save changes' }}</button>
                            <a class="button-light" href="{{ route('admin.dashboard', ['section' => 'pages']) }}">Cancel</a>
                        </div>
                    </form>
                </section>

                <aside class="pages-meta-stack">
                    <section class="pages-meta-card">
                        <div class="pages-meta-label">Content Type</div>
                        <div class="pages-meta-value">Blog Post</div>
                        <p class="entity-extra">This editor publishes rich content to the public blog and keeps page management inside the same admin dashboard.</p>
                    </section>

                    <section class="pages-meta-card">
                        <div class="pages-meta-label">Publish State</div>
                        <div class="pages-meta-value">
                            <span class="pages-status-pill {{ $currentStatus === 'published' ? 'is-published' : 'is-draft' }}">{{ $currentStatus }}</span>
                        </div>
                        <p class="entity-extra">
                            {{ $currentStatus === 'published'
                                ? 'Published pages can be previewed and visited on the public blog immediately.'
                                : 'Draft pages stay private until you switch them to published.' }}
                        </p>
                    </section>

                    <section class="pages-meta-card">
                        <div class="pages-meta-label">Cover Preview</div>
                        <div
                            class="pages-cover-preview"
                            @if ($currentCoverImage !== '')
                                style="background-image: linear-gradient(180deg, rgba(17, 19, 23, 0.05), rgba(17, 19, 23, 0.18)), url('{{ $currentCoverImage }}');"
                            @else
                                style="background-image: linear-gradient(135deg, #eef4fb 0%, #d8e8ff 100%);"
                            @endif
                        ></div>
                        <p class="entity-extra" style="margin-top: 12px;">Use a strong horizontal image URL for the pages list and featured article previews.</p>
                    </section>

                    @if ($pageEditorPost)
                        <section class="pages-meta-card">
                            <div class="pages-meta-label">Page Details</div>
                            <div class="pages-meta-value">{{ $pageEditorPost->slug }}</div>
                            <p class="entity-extra">Created {{ $pageEditorPost->created_at?->format('j M Y, g:i a') }}. Last updated {{ $pageEditorPost->updated_at?->format('j M Y, g:i a') }}.</p>
                        </section>
                    @endif
                </aside>
            </div>
        @endif
    </section>
@endif
