<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Book Rahisi Admin | {{ $pageHeading }}</title>
        <meta
            name="description"
            content="Create and edit blog pages from the Book Rahisi admin console."
        >
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700,800|manrope:400,500,600,700,800" rel="stylesheet" />
        <style>
            :root {
                --ink: #17304d;
                --muted: #7188a2;
                --line: #d6e2f0;
                --page: #eef4fb;
                --panel: rgba(255, 255, 255, 0.96);
                --primary: #1a75ff;
                --primary-soft: #edf4ff;
                --success: #147d46;
                --success-soft: #eaf8ef;
                --danger: #b91c1c;
                --danger-soft: #fff1f2;
                --shadow: 0 24px 44px rgba(28, 66, 104, 0.12);
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                min-height: 100vh;
                background: linear-gradient(180deg, #f8fbff 0%, var(--page) 100%);
                color: var(--ink);
                font-family: 'Manrope', sans-serif;
            }

            a {
                color: inherit;
                text-decoration: none;
            }

            button,
            input,
            select,
            textarea {
                font: inherit;
            }

            .content-app {
                display: grid;
                grid-template-columns: 320px minmax(0, 1fr);
                min-height: 100vh;
            }

            .content-sidebar {
                display: grid;
                align-content: start;
                gap: 22px;
                padding: 28px 22px;
                background: rgba(255, 255, 255, 0.82);
                backdrop-filter: blur(18px);
                border-right: 1px solid rgba(214, 226, 240, 0.9);
            }

            .sidebar-brand-card,
            .content-summary-card,
            .meta-card {
                padding: 22px;
                border: 1px solid rgba(214, 226, 240, 0.96);
                border-radius: 26px;
                background: var(--panel);
                box-shadow: var(--shadow);
            }

            .sidebar-brand-title,
            h1,
            h2 {
                font-family: 'Outfit', sans-serif;
                letter-spacing: -0.06em;
            }

            .sidebar-brand-title {
                font-size: 2rem;
                font-weight: 800;
            }

            .sidebar-brand-subtitle,
            .content-summary-copy,
            .page-subtitle,
            .field-hint,
            .meta-copy,
            .banner {
                color: var(--muted);
                line-height: 1.7;
            }

            .content-nav {
                display: grid;
                gap: 10px;
            }

            .content-link {
                display: flex;
                align-items: center;
                gap: 14px;
                padding: 14px 16px;
                border-radius: 18px;
                color: #4f6581;
                font-size: 1rem;
                font-weight: 800;
                border: 1px solid transparent;
            }

            .content-link:hover,
            .content-link.is-active {
                background: var(--panel);
                color: var(--ink);
                border-color: rgba(214, 226, 240, 0.96);
            }

            .content-link-icon {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 42px;
                height: 42px;
                border-radius: 14px;
                background: #dde7f5;
                color: #5b708b;
                font-size: 0.84rem;
                font-weight: 800;
            }

            .content-group-label,
            .content-summary-label {
                color: #8aa0bb;
                font-size: 0.84rem;
                font-weight: 800;
                letter-spacing: 0.16em;
                text-transform: uppercase;
            }

            .content-summary-value {
                margin-top: 12px;
                font-family: 'Outfit', sans-serif;
                font-size: 2.35rem;
                font-weight: 800;
                letter-spacing: -0.06em;
            }

            .workspace {
                padding: 32px 28px 42px;
            }

            .workspace-shell {
                width: min(100%, 1520px);
                margin: 0 auto;
            }

            .page-head,
            .page-toolbar,
            .form-grid,
            .meta-stack {
                display: grid;
                gap: 18px;
            }

            .page-head {
                grid-template-columns: minmax(0, 1fr) auto;
                align-items: end;
            }

            .eyebrow {
                display: inline-flex;
                align-items: center;
                padding: 10px 16px;
                border-radius: 999px;
                background: var(--primary-soft);
                color: var(--primary);
                font-size: 0.86rem;
                font-weight: 800;
                width: fit-content;
            }

            h1 {
                margin: 14px 0 0;
                font-size: clamp(2.6rem, 4vw, 4rem);
                line-height: 0.96;
            }

            h2 {
                margin: 0;
                font-size: 1.6rem;
            }

            .page-subtitle {
                margin-top: 12px;
                font-size: 1rem;
                max-width: 820px;
            }

            .button-primary,
            .button-light,
            .button-soft,
            .button-preview {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                padding: 14px 20px;
                border-radius: 999px;
                border: 1px solid transparent;
                font-family: 'Manrope', sans-serif;
                font-size: 0.96rem;
                font-weight: 800;
                line-height: 1.2;
                cursor: pointer;
            }

            .button-primary {
                background: var(--primary);
                color: #fff;
                box-shadow: 0 18px 32px rgba(26, 117, 255, 0.18);
            }

            .button-light {
                background: #fff;
                border-color: var(--line);
                color: var(--ink);
            }

            .button-soft {
                background: rgba(255, 255, 255, 0.94);
                border-color: #21a1c5;
                color: #1294b8;
            }

            .button-preview {
                background: #fff;
                border-color: #1ca4de;
                color: #1898cf;
            }

            .action-button svg {
                width: 18px;
                height: 18px;
                flex: none;
            }

            .banner {
                margin-bottom: 18px;
                padding: 16px 18px;
                border-radius: 18px;
                border: 1px solid rgba(214, 226, 240, 0.96);
                background: #fff;
            }

            .banner.is-success {
                border-color: rgba(20, 125, 70, 0.14);
                background: var(--success-soft);
                color: var(--success);
            }

            .banner.is-error {
                border-color: rgba(185, 28, 28, 0.16);
                background: var(--danger-soft);
                color: var(--danger);
            }

            .editor-grid {
                display: grid;
                grid-template-columns: minmax(0, 1.25fr) minmax(320px, 0.75fr);
                gap: 20px;
                margin-top: 24px;
            }

            .editor-card {
                padding: 28px;
                border: 1px solid rgba(214, 226, 240, 0.96);
                border-radius: 28px;
                background: var(--panel);
                box-shadow: var(--shadow);
            }

            .form-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .field-group {
                display: grid;
                gap: 10px;
            }

            .field-group-full {
                grid-column: 1 / -1;
            }

            .field-label {
                font-size: 0.92rem;
                font-weight: 800;
            }

            .field-input,
            .field-select,
            .field-textarea {
                width: 100%;
                min-height: 52px;
                padding: 0 14px;
                border: 1px solid var(--line);
                border-radius: 16px;
                outline: none;
                background: #fff;
                color: var(--ink);
                font-size: 0.96rem;
            }

            .field-textarea {
                min-height: 170px;
                padding: 16px;
                resize: vertical;
            }

            .field-body {
                min-height: 340px;
            }

            .field-input:focus,
            .field-select:focus,
            .field-textarea:focus {
                border-color: var(--primary);
                box-shadow: 0 0 0 4px rgba(26, 117, 255, 0.08);
            }

            .meta-stack {
                align-content: start;
            }

            .meta-card-label {
                color: #8aa0bb;
                font-size: 0.8rem;
                font-weight: 800;
                letter-spacing: 0.16em;
                text-transform: uppercase;
            }

            .meta-card-value {
                margin-top: 12px;
                font-family: 'Outfit', sans-serif;
                font-size: 1.7rem;
                font-weight: 800;
                letter-spacing: -0.05em;
            }

            .cover-preview {
                min-height: 220px;
                margin-top: 14px;
                border-radius: 22px;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                background-color: #eef4fb;
            }

            .status-pill {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 8px 12px;
                border-radius: 999px;
                font-size: 0.8rem;
                font-weight: 800;
                text-transform: capitalize;
            }

            .status-pill.is-published {
                background: var(--success-soft);
                color: var(--success);
            }

            .status-pill.is-draft {
                background: #fff8e6;
                color: #b7791f;
            }

            @media (max-width: 1280px) {
                .content-app {
                    grid-template-columns: 1fr;
                }

                .content-sidebar {
                    border-right: 0;
                    border-bottom: 1px solid rgba(214, 226, 240, 0.9);
                }
            }

            @media (max-width: 1100px) {
                .editor-grid,
                .page-head,
                .form-grid {
                    grid-template-columns: 1fr;
                }
            }

            @media (max-width: 760px) {
                .workspace {
                    padding: 22px 16px 32px;
                }

                .editor-card {
                    padding: 22px;
                }
            }
        </style>
    </head>
    <body>
        <div class="content-app">
            @include('partials.admin-pages-sidebar', ['activeSection' => 'pages'])

            <main class="workspace">
                <div class="workspace-shell">
                    @if (session('admin_success'))
                        <div class="banner is-success">{{ session('admin_success') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="banner is-error">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <section class="page-head">
                        <div>
                            <span class="eyebrow">Page editor</span>
                            <h1>{{ $pageHeading }}</h1>
                            <p class="page-subtitle">{{ $pageSubtitle }}</p>
                        </div>

                        @php
                            $resolvedPreviewUrl = $previewUrl
                                ?? (($blogPost ?? null)
                                    ? (($blogPost->status === 'published' && $blogPost->published_at !== null)
                                        ? route('blog.show', ['slug' => $blogPost->slug])
                                        : route('admin.pages.preview', ['blogPost' => $blogPost->id]))
                                    : null);
                        @endphp

                        <div class="page-toolbar">
                            <a class="button-light" href="{{ route('admin.dashboard', ['section' => 'pages']) }}">Back to pages</a>
                            @if ($resolvedPreviewUrl)
                                <a class="button-preview action-button" href="{{ $resolvedPreviewUrl }}" target="_blank" rel="noopener noreferrer" title="Preview and open page">
                                    <svg viewBox="0 0 24 24" aria-hidden="true">
                                        <path d="M1.5 12s4-7.5 10.5-7.5S22.5 12 22.5 12s-4 7.5-10.5 7.5S1.5 12 1.5 12Z" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" />
                                        <circle cx="12" cy="12" r="3" fill="none" stroke="currentColor" stroke-width="1.7" />
                                    </svg>
                                    <span>Preview</span>
                                </a>
                            @endif
                        </div>
                    </section>

                    @if (! $blogPostsTableExists)
                        <section class="editor-card" style="margin-top: 24px;">
                            <h2>Blog setup incomplete</h2>
                            <p class="page-subtitle" style="margin-top: 10px;">The `blog_posts` table is missing on this server, so the editor is unavailable until the latest migrations are run.</p>
                        </section>
                    @else
                        @php
                            $currentTitle = old('title', $blogPost?->title ?? '');
                            $currentSlug = old('slug', $blogPost?->slug ?? '');
                            $currentCoverImage = old('cover_image_url', $blogPost?->cover_image_url ?? '');
                            $currentStatus = old('status', $blogPost?->status ?? 'draft');
                            $currentExcerpt = old('excerpt', $blogPost?->excerpt ?? '');
                            $currentBody = old('body', $blogPost?->body ?? '');
                        @endphp

                        <div class="editor-grid">
                            <section class="editor-card">
                                <form action="{{ $formAction }}" method="post">
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
                                            <textarea class="field-textarea field-body" id="page-body" name="body" placeholder="Write the full page or blog content here. Line breaks are preserved on the public page.">{{ $currentBody }}</textarea>
                                        </div>
                                    </div>

                                    <div class="page-toolbar" style="margin-top: 24px;">
                                        <button class="button-primary" type="submit">{{ $formMode === 'create' ? 'Create page' : 'Save changes' }}</button>
                                        <a class="button-light" href="{{ route('admin.dashboard', ['section' => 'pages']) }}">Cancel</a>
                                    </div>
                                </form>
                            </section>

                            <aside class="meta-stack">
                                <section class="meta-card">
                                    <div class="meta-card-label">Content Type</div>
                                    <div class="meta-card-value">Blog Post</div>
                                    <p class="meta-copy">This editor publishes rich content to the public blog and uses the same page model for previews and live entries.</p>
                                </section>

                                <section class="meta-card">
                                    <div class="meta-card-label">Publish State</div>
                                    <div class="meta-card-value">
                                        <span class="status-pill {{ $currentStatus === 'published' ? 'is-published' : 'is-draft' }}">{{ $currentStatus }}</span>
                                    </div>
                                    <p class="meta-copy">
                                        {{ $currentStatus === 'published'
                                            ? 'Published pages can be previewed and visited on the public blog immediately.'
                                            : 'Draft pages stay private on the public blog, but you can still preview them from the admin area.' }}
                                    </p>
                                </section>

                                <section class="meta-card">
                                    <div class="meta-card-label">Cover Preview</div>
                                    <div
                                        class="cover-preview"
                                        @if ($currentCoverImage !== '')
                                            style="background-image: linear-gradient(180deg, rgba(17, 19, 23, 0.05), rgba(17, 19, 23, 0.18)), url('{{ $currentCoverImage }}');"
                                        @else
                                            style="background-image: linear-gradient(135deg, #eef4fb 0%, #d8e8ff 100%);"
                                        @endif
                                    ></div>
                                    <p class="meta-copy" style="margin-top: 12px;">Use a strong horizontal image URL for the pages list and featured article previews.</p>
                                </section>

                                @if ($blogPost)
                                    <section class="meta-card">
                                        <div class="meta-card-label">Page Details</div>
                                        <div class="meta-card-value">{{ $blogPost->slug }}</div>
                                        <p class="meta-copy">Created {{ $blogPost->created_at?->format('j M Y, g:i a') }}. Last updated {{ $blogPost->updated_at?->format('j M Y, g:i a') }}.</p>
                                    </section>
                                @endif
                            </aside>
                        </div>
                    @endif
                </div>
            </main>
        </div>
    </body>
</html>
