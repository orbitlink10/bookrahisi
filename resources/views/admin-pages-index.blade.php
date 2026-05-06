<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Book Rahisi Admin | Pages</title>
        <meta
            name="description"
            content="Manage site pages and published content from the Book Rahisi admin console."
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
                --danger: #ef4444;
                --danger-soft: #fff1f2;
                --warning: #b7791f;
                --warning-soft: #fff8e6;
                --success: #147d46;
                --success-soft: #eaf8ef;
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
            select {
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
            .content-summary-card {
                padding: 22px;
                border: 1px solid rgba(214, 226, 240, 0.96);
                border-radius: 26px;
                background: var(--panel);
                box-shadow: var(--shadow);
            }

            .sidebar-brand-title {
                font-family: 'Outfit', sans-serif;
                font-size: 2rem;
                font-weight: 800;
                letter-spacing: -0.06em;
            }

            .sidebar-brand-subtitle,
            .content-summary-copy,
            .page-subtitle,
            .list-copy,
            .table-copy,
            .empty-state,
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
                transition: background-color 160ms ease, color 160ms ease, border-color 160ms ease;
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
            .table-head {
                color: #8aa0bb;
                font-size: 0.88rem;
                font-weight: 800;
                letter-spacing: 0.18em;
                text-transform: uppercase;
            }

            .content-summary-label {
                color: #8aa0bb;
                font-size: 0.8rem;
                font-weight: 800;
                letter-spacing: 0.14em;
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
                width: min(100%, 1500px);
                margin: 0 auto;
            }

            .page-head,
            .panel-head,
            .toolbar,
            .table-actions,
            .row-actions {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 16px;
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
            }

            h1,
            h2 {
                margin: 0;
                font-family: 'Outfit', sans-serif;
                letter-spacing: -0.06em;
            }

            h1 {
                margin-top: 14px;
                font-size: clamp(2.6rem, 4vw, 4rem);
                line-height: 0.96;
            }

            h2 {
                font-size: 2rem;
            }

            .page-subtitle {
                margin-top: 12px;
                font-size: 1rem;
            }

            .button-primary,
            .button-light,
            .button-soft,
            .button-preview,
            .button-warning,
            .button-danger {
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
                padding: 10px 16px;
            }

            .button-preview {
                background: #fff;
                border-color: #1ca4de;
                color: #1898cf;
                padding: 10px 16px;
            }

            .button-warning {
                background: #fff;
                border-color: #f5b400;
                color: #efb100;
                padding: 10px 16px;
            }

            .button-danger {
                background: #fff;
                border-color: #f2a4ad;
                color: var(--danger);
                padding: 10px 16px;
            }

            .panel {
                margin-top: 24px;
                border: 1px solid rgba(214, 226, 240, 0.96);
                border-radius: 28px;
                background: var(--panel);
                box-shadow: var(--shadow);
                overflow: hidden;
            }

            .panel-head {
                padding: 28px 30px;
                border-bottom: 1px solid rgba(214, 226, 240, 0.96);
            }

            .list-copy {
                margin-top: 10px;
                max-width: 720px;
            }

            .stats-row {
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 16px;
                margin-top: 24px;
            }

            .stat-card {
                padding: 22px;
                border: 1px solid rgba(214, 226, 240, 0.96);
                border-radius: 24px;
                background: rgba(255, 255, 255, 0.86);
            }

            .stat-card-value {
                margin-top: 12px;
                font-family: 'Outfit', sans-serif;
                font-size: 2.1rem;
                font-weight: 800;
                letter-spacing: -0.06em;
            }

            .table-toolbar,
            .table-wrap {
                padding: 24px 30px 0;
            }

            .table-toolbar {
                padding-bottom: 24px;
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
                border-color: rgba(239, 68, 68, 0.18);
                background: var(--danger-soft);
                color: #b91c1c;
            }

            .bulk-form,
            .bulk-controls {
                display: flex;
                align-items: center;
                gap: 12px;
                flex-wrap: wrap;
            }

            .field-select,
            .field-checkbox {
                min-height: 48px;
                border: 1px solid var(--line);
                background: #fff;
            }

            .field-select {
                min-width: 170px;
                padding: 0 14px;
                border-radius: 14px;
                color: var(--ink);
            }

            .field-checkbox {
                width: 22px;
                height: 22px;
                border-radius: 6px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            thead th {
                padding: 18px 16px;
                border-top: 1px solid rgba(214, 226, 240, 0.96);
                border-bottom: 1px solid rgba(214, 226, 240, 0.96);
                color: #5f7a9d;
                font-size: 0.9rem;
                font-weight: 800;
                letter-spacing: 0.16em;
                text-transform: uppercase;
                text-align: left;
                background: #f7faff;
            }

            tbody td {
                padding: 18px 16px;
                border-bottom: 1px solid rgba(214, 226, 240, 0.78);
                vertical-align: middle;
            }

            .thumb {
                width: 170px;
                height: 110px;
                border-radius: 18px;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                background-color: #eef4fb;
                overflow: hidden;
            }

            .post-number {
                font-size: 1.45rem;
                font-weight: 800;
            }

            .post-title {
                font-size: 1.2rem;
                font-weight: 800;
                line-height: 1.35;
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
                background: var(--warning-soft);
                color: var(--warning);
            }

            .row-actions {
                flex-direction: column;
                align-items: flex-start;
                justify-content: flex-start;
                gap: 12px;
            }

            .row-actions form {
                margin: 0;
            }

            .action-button {
                min-width: 0;
                padding: 9px 16px;
                gap: 8px;
                justify-content: flex-start;
            }

            .action-button svg {
                width: 18px;
                height: 18px;
                flex: none;
            }

            .action-button.is-disabled {
                cursor: default;
                opacity: 0.56;
            }

            .table-copy {
                margin-top: 6px;
                font-size: 0.92rem;
            }

            .empty-state {
                margin: 0 30px 30px;
                padding: 30px;
                border: 1px dashed var(--line);
                border-radius: 22px;
                background: #fff;
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

            @media (max-width: 960px) {
                .stats-row {
                    grid-template-columns: 1fr;
                }

                .page-head,
                .panel-head,
                .table-actions {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .table-wrap {
                    overflow-x: auto;
                }
            }

            @media (max-width: 760px) {
                .workspace {
                    padding: 22px 16px 32px;
                }

                .table-toolbar,
                .table-wrap,
                .panel-head {
                    padding-left: 20px;
                    padding-right: 20px;
                }

                .empty-state {
                    margin-left: 20px;
                    margin-right: 20px;
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
                            <span class="eyebrow">Content studio</span>
                            <h1>Pages</h1>
                            <p class="page-subtitle">Manage site pages and published content from one clean admin workspace.</p>
                        </div>

                        <div class="toolbar">
                            <a class="button-light" href="{{ route('admin.dashboard') }}">Back to dashboard</a>
                            <a class="button-primary" href="{{ route('admin.dashboard', ['section' => 'pages', 'pages_mode' => 'create']) }}">
                                <span style="font-size: 1.2rem; line-height: 1;">+</span>
                                <span>Add Page</span>
                            </a>
                        </div>
                    </section>

                    <section class="stats-row">
                        <article class="stat-card">
                            <div class="table-head">Total pages</div>
                            <div class="stat-card-value">{{ $totalBlogPosts }}</div>
                            <div class="table-copy">All saved blog pages in the content manager.</div>
                        </article>
                        <article class="stat-card">
                            <div class="table-head">Published</div>
                            <div class="stat-card-value">{{ $publishedBlogPosts }}</div>
                            <div class="table-copy">Visible on the public blog and ready for preview.</div>
                        </article>
                        <article class="stat-card">
                            <div class="table-head">Drafts</div>
                            <div class="stat-card-value">{{ $draftBlogPosts }}</div>
                            <div class="table-copy">Still being edited before going live.</div>
                        </article>
                    </section>

                    <section class="panel">
                        <div class="panel-head">
                            <div>
                                <h2>Post List</h2>
                                <p class="list-copy">Review each page, preview draft or live entries, and keep editing focused inside a dedicated page editor.</p>
                            </div>
                            <a class="button-primary" href="{{ route('admin.dashboard', ['section' => 'pages', 'pages_mode' => 'create']) }}">
                                <span style="font-size: 1.2rem; line-height: 1;">+</span>
                                <span>Add Page</span>
                            </a>
                        </div>

                        @if (! $blogPostsTableExists)
                            <div class="empty-state">The `blog_posts` table is not available on this server yet. Run the latest migrations before creating or managing pages.</div>
                        @else
                            <div class="table-toolbar">
                                <form class="bulk-form" id="bulk-pages-form" action="{{ route('admin.pages.bulk') }}" method="post">
                                    @csrf
                                    <div class="bulk-controls">
                                        <select class="field-select" name="action">
                                            <option value="">Bulk actions</option>
                                            <option value="publish">Publish</option>
                                            <option value="draft">Move to draft</option>
                                            <option value="delete">Delete</option>
                                        </select>
                                        <button class="button-primary" type="submit">Apply</button>
                                    </div>
                                </form>

                                <div class="table-wrap">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th style="width: 44px;">
                                                    <input class="field-checkbox" type="checkbox" id="select-all-posts" onclick="document.querySelectorAll('.js-post-checkbox').forEach((checkbox) => checkbox.checked = this.checked)">
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
                                                        <input class="field-checkbox js-post-checkbox" type="checkbox" name="selected_posts[]" value="{{ $blogPost->id }}" form="bulk-pages-form">
                                                    </td>
                                                    <td>
                                                        <div class="post-number">{{ $index + 1 }}</div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="thumb"
                                                            @if ($blogPost->cover_image_url)
                                                                style="background-image: linear-gradient(180deg, rgba(17, 19, 23, 0.05), rgba(17, 19, 23, 0.18)), url('{{ $blogPost->cover_image_url }}');"
                                                            @else
                                                                style="background-image: linear-gradient(135deg, #eef4fb 0%, #d8e8ff 100%);"
                                                            @endif
                                                        ></div>
                                                    </td>
                                                    <td>
                                                        <div class="post-title">{{ $blogPost->title }}</div>
                                                        <div class="table-copy">{{ $blogPost->slug }}</div>
                                                        <div class="table-copy">
                                                            <span class="status-pill {{ $blogPost->status === 'published' ? 'is-published' : 'is-draft' }}">{{ $blogPost->status }}</span>
                                                        </div>
                                                    </td>
                                                    <td>{{ $blogPost->title }}</td>
                                                    <td>Post</td>
                                                    <td>
                                                        <div class="row-actions">
                                                            <a
                                                                class="button-preview action-button"
                                                                href="{{ $blogPost->status === 'published' && $blogPost->published_at !== null ? route('blog.show', ['slug' => $blogPost->slug]) : route('admin.pages.preview', ['blogPost' => $blogPost->id]) }}"
                                                                target="_blank"
                                                                rel="noopener noreferrer"
                                                                title="Preview and open page"
                                                            >
                                                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                                                    <path d="M1.5 12s4-7.5 10.5-7.5S22.5 12 22.5 12s-4 7.5-10.5 7.5S1.5 12 1.5 12Z" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <circle cx="12" cy="12" r="3" fill="none" stroke="currentColor" stroke-width="1.7" />
                                                                </svg>
                                                                <span>Preview</span>
                                                            </a>
                                                            <a class="button-warning action-button" href="{{ route('admin.dashboard', ['section' => 'pages', 'pages_edit' => $blogPost->id]) }}">
                                                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                                                    <path d="M3 17.25V21h3.75L19.81 7.94l-3.75-3.75L3 17.25Z" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path d="M14.06 4.19 17.81 7.94" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                                <span>Update</span>
                                                            </a>
                                                            <form action="{{ route('admin.pages.destroy', ['blogPost' => $blogPost]) }}" method="post" onsubmit="return confirm('Delete this page?');">
                                                                @csrf
                                                                <button class="button-danger action-button" type="submit">
                                                                    <svg viewBox="0 0 24 24" aria-hidden="true">
                                                                        <path d="M4 7h16" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" />
                                                                        <path d="M9 7V4h6v3" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" />
                                                                        <path d="M6 7l1 13h10l1-13" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" />
                                                                        <path d="M10 11v6M14 11v6" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" />
                                                                    </svg>
                                                                    <span>Delete</span>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" style="padding: 0;">
                                                        <div class="empty-state" style="margin: 20px 0;">No pages have been created yet. Use the Add Page button to open the editor and publish your first blog page.</div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    </section>
                </div>
            </main>
        </div>
    </body>
</html>
