@php
    $currentMetaTitle = old('meta_title', $pageEditorPost?->meta_title ?? $pageEditorPost?->title ?? '');
    $currentMetaDescription = old('meta_description', $pageEditorPost?->excerpt ?? '');
    $currentTitle = old('title', $pageEditorPost?->title ?? '');
    $currentImageAltText = old('image_alt_text', $pageEditorPost?->image_alt_text ?? $pageEditorPost?->title ?? '');
    $currentHeadingTwo = old('heading_two', $pageEditorPost?->heading_two ?? '');
    $currentSlug = old('slug', $pageEditorPost?->slug ?? '');
    $currentCoverImage = old('cover_image_url', $pageEditorPost?->cover_image_url ?? '');
    $currentStatus = old('status', $pageEditorPost?->status ?? 'draft');
    $currentContentType = old('content_type', $pageEditorPost?->content_type ?? 'post');
    $currentBody = old('body', $pageEditorPost?->body ?? '');
    $isEditingPage = ($pagesViewMode ?? 'list') !== 'list';
    $editorBodyHtml = old('body') !== null
        ? nl2br(e($currentBody))
        : ($currentBody === strip_tags($currentBody)
            ? nl2br(e($currentBody))
            : $currentBody);
@endphp

@if ($isEditingPage)
    <section class="pages-compose-head" id="pages">
        <div>
            <h1>Manage Pages</h1>
        </div>

        <div class="toolbar">
            <a class="button-light" href="{{ route('admin.dashboard', ['section' => 'pages']) }}">Back to Pages</a>
            @if ($pagesPreviewUrl)
                <a class="button-preview" href="{{ $pagesPreviewUrl }}" target="_blank" rel="noopener noreferrer">Preview</a>
            @endif
        </div>
    </section>

    <section class="panel pages-compose-panel">
        <div class="pages-compose-banner">{{ $pagesPageHeading }}</div>

        @if (! $blogPostsTableExists)
            <div class="pages-empty-state">The `blog_posts` table is missing on this server, so the page editor is unavailable until the latest migrations are run.</div>
        @else
            @if (($blogPostMissingEnhancedColumns ?? []) !== [])
                <div class="pages-empty-state" style="margin-top: 28px; margin-bottom: 0;">
                    This server is still using the older blog schema. You can keep posting pages, but fields like Meta Title, Heading 2, Image Alt Text, and Type will only save separately after the latest migrations are run.
                </div>
            @endif

            <form action="{{ $pagesFormAction }}" method="post" class="pages-compose-form">
                @csrf

                <div class="pages-form-stack">
                    <div class="pages-field-group">
                        <label class="pages-field-label" for="page-meta-title">Meta Title</label>
                        <input class="pages-field-input" id="page-meta-title" type="text" name="meta_title" value="{{ $currentMetaTitle }}" placeholder="Enter Meta Title">
                    </div>

                    <div class="pages-field-group">
                        <label class="pages-field-label" for="page-meta-description">Meta Description</label>
                        <input class="pages-field-input" id="page-meta-description" type="text" name="meta_description" value="{{ $currentMetaDescription }}" placeholder="Enter Meta Description">
                    </div>

                    <div class="pages-field-group">
                        <label class="pages-field-label" for="page-title">Page Title</label>
                        <input class="pages-field-input" id="page-title" type="text" name="title" value="{{ $currentTitle }}" placeholder="Enter Keyword Title">
                    </div>

                    <div class="pages-field-group">
                        <label class="pages-field-label" for="page-image-alt-text">Image Alt Text</label>
                        <input class="pages-field-input" id="page-image-alt-text" type="text" name="image_alt_text" value="{{ $currentImageAltText }}" placeholder="Enter Image Alt Text">
                    </div>

                    <div class="pages-field-group">
                        <label class="pages-field-label" for="page-heading-two">Heading 2</label>
                        <input class="pages-field-input" id="page-heading-two" type="text" name="heading_two" value="{{ $currentHeadingTwo }}" placeholder="Enter Heading 2">
                    </div>

                    <div class="pages-field-group">
                        <label class="pages-field-label" for="page-content-type">Type</label>
                        <select class="pages-field-input pages-field-select" id="page-content-type" name="content_type">
                            <option value="post" @selected($currentContentType === 'post')>Post</option>
                        </select>
                    </div>

                    <div class="pages-field-group pages-field-group-full">
                        <label class="pages-field-label" for="page-description-editor">Page Description:</label>

                        <div class="pages-rich-editor" data-rich-editor>
                            <div class="pages-editor-menu">
                                <span>File</span>
                                <span>Edit</span>
                                <span>View</span>
                                <span>Insert</span>
                                <span>Format</span>
                                <span>Tools</span>
                                <span>Table</span>
                            </div>

                            <div class="pages-editor-toolbar" data-editor-toolbar>
                                <button class="pages-toolbar-button" type="button" data-command="undo" aria-label="Undo">&#8630;</button>
                                <button class="pages-toolbar-button" type="button" data-command="redo" aria-label="Redo">&#8631;</button>
                                <button class="pages-toolbar-button" type="button" data-command="bold" aria-label="Bold"><strong>B</strong></button>
                                <button class="pages-toolbar-button" type="button" data-command="italic" aria-label="Italic"><em>I</em></button>
                                <button class="pages-toolbar-button" type="button" data-command="justifyLeft" aria-label="Align left">L</button>
                                <button class="pages-toolbar-button" type="button" data-command="justifyCenter" aria-label="Align center">C</button>
                                <button class="pages-toolbar-button" type="button" data-command="justifyRight" aria-label="Align right">R</button>
                                <button class="pages-toolbar-button" type="button" data-command="insertUnorderedList" aria-label="Bulleted list">UL</button>
                                <button class="pages-toolbar-button" type="button" data-command="outdent" aria-label="Outdent">&lt;</button>
                                <button class="pages-toolbar-button" type="button" data-command="indent" aria-label="Indent">&gt;</button>
                                <button class="pages-toolbar-button" type="button" data-editor-link aria-label="Insert link">Link</button>
                                <button class="pages-toolbar-button" type="button" data-editor-image aria-label="Insert image">Img</button>
                                <button class="pages-toolbar-button" type="button" data-editor-video aria-label="Insert video">Vid</button>
                                <button class="pages-toolbar-button" type="button" data-editor-code aria-label="Toggle code view">&lt;/&gt;</button>
                                <button class="pages-toolbar-button" type="button" data-editor-fullscreen aria-label="Fullscreen">[]</button>
                            </div>

                            <div
                                class="pages-editor-surface"
                                id="page-description-editor"
                                contenteditable="true"
                                data-editor-surface
                            >{!! $editorBodyHtml !!}</div>

                            <textarea class="pages-editor-source" data-editor-source hidden>{{ $currentBody }}</textarea>
                            <textarea name="body" data-editor-input hidden>{{ $currentBody }}</textarea>
                        </div>
                    </div>

                    <div class="pages-settings-grid">
                        <div class="pages-field-group">
                            <label class="pages-field-label" for="page-cover-image">Featured Image URL</label>
                            <input class="pages-field-input" id="page-cover-image" type="url" name="cover_image_url" value="{{ $currentCoverImage }}" placeholder="https://example.com/featured-image.jpg">
                        </div>

                        <div class="pages-field-group">
                            <label class="pages-field-label" for="page-slug">Slug</label>
                            <input class="pages-field-input" id="page-slug" type="text" name="slug" value="{{ $currentSlug }}" placeholder="optional-custom-slug">
                        </div>

                        <div class="pages-field-group">
                            <label class="pages-field-label" for="page-status">Publish Status</label>
                            <select class="pages-field-input pages-field-select" id="page-status" name="status">
                                @foreach (['draft', 'published'] as $status)
                                    <option value="{{ $status }}" @selected($currentStatus === $status)>{{ ucfirst($status) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="pages-compose-actions">
                        <button class="button-primary" type="submit">{{ $pagesViewMode === 'create' ? 'Create page' : 'Save changes' }}</button>
                        <a class="button-light" href="{{ route('admin.dashboard', ['section' => 'pages']) }}">Cancel</a>
                    </div>
                </div>
            </form>
        @endif
    </section>
@else
    <section class="pages-head" id="pages">
        <div>
            <h1>Pages</h1>
            <p class="subtitle">Manage site pages and published content.</p>
        </div>
    </section>

    <section class="panel pages-panel">
        <div class="pages-panel-head">
            <div>
                <h2 class="panel-title">Post List</h2>
            </div>
            <a class="button-page-add" href="{{ route('admin.dashboard', ['section' => 'pages', 'pages_mode' => 'create']) }}">
                <span style="font-size: 1.2rem; line-height: 1;">+</span>
                <span>Add Page</span>
            </a>
        </div>

        @if (! $blogPostsTableExists)
            <div class="pages-empty-state">The `blog_posts` table is not available on this server yet. Run the latest migrations before creating or managing pages.</div>
        @else
            @if (($blogPostMissingEnhancedColumns ?? []) !== [])
                <div class="pages-empty-state" style="margin-top: 28px; margin-bottom: 0;">
                    This server is still using the older blog schema. You can manage pages here, but the newer metadata fields will only save separately after the latest migrations are run.
                </div>
            @endif

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
                            <th style="width: 260px;">Image</th>
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
                                </td>
                                <td>{{ $blogPost->image_alt_text ?: $blogPost->title }}</td>
                                <td>{{ ucfirst($blogPost->content_type ?: 'post') }}</td>
                                <td>
                                    <div class="pages-row-actions">
                                        @if ($blogPost->status === 'published')
                                            <a class="button-preview" href="{{ route('blog.show', ['slug' => $blogPost->slug]) }}" target="_blank" rel="noopener noreferrer">Preview</a>
                                        @else
                                            <span class="button-draft">Draft</span>
                                        @endif
                                        <a class="button-warning" href="{{ route('admin.dashboard', ['section' => 'pages', 'pages_edit' => $blogPost->id]) }}">Update</a>
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
@endif

@once
    <script>
        (() => {
            const editorRoots = document.querySelectorAll('[data-rich-editor]');

            if (editorRoots.length === 0) {
                return;
            }

            const normalizeEditorHtml = (html) => {
                const trimmed = html.trim();

                if (trimmed === '' || trimmed === '<br>' || trimmed === '<p></p>' || trimmed === '<p><br></p>') {
                    return '';
                }

                return trimmed;
            };

            const buildVideoMarkup = (url) => {
                if (!url) {
                    return '';
                }

                try {
                    const parsed = new URL(url);
                    const host = parsed.hostname.toLowerCase();

                    if (host.includes('youtube.com') || host.includes('youtu.be')) {
                        const videoId = host.includes('youtu.be')
                            ? parsed.pathname.replace('/', '')
                            : parsed.searchParams.get('v');

                        if (videoId) {
                            return '<iframe src="https://www.youtube.com/embed/' + videoId + '" title="Embedded video" width="560" height="315" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                        }
                    }

                    if (host.includes('vimeo.com')) {
                        const videoId = parsed.pathname.split('/').filter(Boolean).pop();

                        if (videoId) {
                            return '<iframe src="https://player.vimeo.com/video/' + videoId + '" title="Embedded video" width="560" height="315" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>';
                        }
                    }

                    return '<video controls src="' + parsed.href + '"></video>';
                } catch (error) {
                    return '';
                }
            };

            editorRoots.forEach((root) => {
                const editorSurface = root.querySelector('[data-editor-surface]');
                const sourceArea = root.querySelector('[data-editor-source]');
                const hiddenInput = root.querySelector('[data-editor-input]');
                const toolbar = root.querySelector('[data-editor-toolbar]');
                let sourceMode = false;

                if (!editorSurface || !sourceArea || !hiddenInput || !toolbar) {
                    return;
                }

                const syncHiddenInput = () => {
                    hiddenInput.value = sourceMode
                        ? sourceArea.value
                        : normalizeEditorHtml(editorSurface.innerHTML);
                };

                const switchMode = () => {
                    sourceMode = !sourceMode;

                    if (sourceMode) {
                        sourceArea.hidden = false;
                        sourceArea.value = normalizeEditorHtml(editorSurface.innerHTML);
                        editorSurface.hidden = true;
                    } else {
                        editorSurface.innerHTML = sourceArea.value.trim() === '' ? '<p></p>' : sourceArea.value;
                        sourceArea.hidden = true;
                        editorSurface.hidden = false;
                    }

                    syncHiddenInput();
                };

                toolbar.addEventListener('click', (event) => {
                    const commandButton = event.target.closest('[data-command]');
                    const linkButton = event.target.closest('[data-editor-link]');
                    const imageButton = event.target.closest('[data-editor-image]');
                    const videoButton = event.target.closest('[data-editor-video]');
                    const codeButton = event.target.closest('[data-editor-code]');
                    const fullscreenButton = event.target.closest('[data-editor-fullscreen]');

                    if (!commandButton && !linkButton && !imageButton && !videoButton && !codeButton && !fullscreenButton) {
                        return;
                    }

                    event.preventDefault();

                    if (sourceMode && !codeButton && !fullscreenButton) {
                        sourceArea.focus();

                        return;
                    }

                    editorSurface.focus();

                    if (commandButton) {
                        document.execCommand(commandButton.dataset.command, false, null);
                        syncHiddenInput();

                        return;
                    }

                    if (linkButton) {
                        const url = window.prompt('Enter the link URL');

                        if (url) {
                            document.execCommand('createLink', false, url);
                            syncHiddenInput();
                        }

                        return;
                    }

                    if (imageButton) {
                        const url = window.prompt('Enter the image URL');

                        if (url) {
                            const alt = window.prompt('Enter the image alt text', '') || '';
                            document.execCommand('insertHTML', false, '<img src="' + url + '" alt="' + alt.replace(/"/g, '&quot;') + '">');
                            syncHiddenInput();
                        }

                        return;
                    }

                    if (videoButton) {
                        const url = window.prompt('Enter the video or embed URL');
                        const videoMarkup = buildVideoMarkup(url || '');

                        if (videoMarkup !== '') {
                            document.execCommand('insertHTML', false, videoMarkup);
                            syncHiddenInput();
                        }

                        return;
                    }

                    if (codeButton) {
                        switchMode();

                        return;
                    }

                    if (fullscreenButton) {
                        root.classList.toggle('is-fullscreen');
                    }
                });

                editorSurface.addEventListener('input', syncHiddenInput);
                sourceArea.addEventListener('input', syncHiddenInput);

                root.closest('form')?.addEventListener('submit', () => {
                    syncHiddenInput();
                });

                syncHiddenInput();
            });
        })();
    </script>
@endonce
