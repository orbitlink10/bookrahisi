<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $blogPost->meta_title ?: $blogPost->title }} | Book Rahisi Blog</title>
        <meta
            name="description"
            content="{{ $blogPost->excerpt }}"
        >
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700,800|manrope:400,500,600,700,800" rel="stylesheet" />
        <style>
            :root {
                --ink: #111317;
                --muted: #69707d;
                --line: #e5e8ef;
                --accent: #17345d;
                --panel: rgba(255, 255, 255, 0.94);
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                background: linear-gradient(180deg, #fbfdff 0%, #f2f7fb 100%);
                color: var(--ink);
                font-family: 'Manrope', sans-serif;
            }

            a {
                color: inherit;
                text-decoration: none;
            }

            .shell {
                width: min(100%, 1060px);
                margin: 0 auto;
                padding: 28px 20px 64px;
            }

            .topbar,
            .meta-row,
            .related-head {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 16px;
            }

            .brand {
                font-family: 'Outfit', sans-serif;
                font-size: 1.8rem;
                font-weight: 800;
                letter-spacing: -0.06em;
            }

            .nav-links {
                display: flex;
                flex-wrap: wrap;
                gap: 12px;
            }

            .nav-link,
            .back-link {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 12px 16px;
                border: 1px solid var(--line);
                border-radius: 999px;
                background: rgba(255, 255, 255, 0.88);
                font-weight: 800;
            }

            .article {
                margin-top: 24px;
                border: 1px solid var(--line);
                border-radius: 30px;
                background: var(--panel);
                overflow: hidden;
                box-shadow: 0 24px 44px rgba(23, 52, 93, 0.08);
            }

            .cover {
                background: #eef4fb;
            }

            .cover-image {
                display: block;
                width: 100%;
                min-height: 360px;
                max-height: 560px;
                object-fit: cover;
            }

            .article-body {
                padding: 34px;
            }

            .eyebrow {
                display: inline-flex;
                align-items: center;
                padding: 10px 14px;
                border-radius: 999px;
                background: #dbeeff;
                color: #1a7691;
                font-size: 0.84rem;
                font-weight: 800;
            }

            h1 {
                margin: 18px 0 0;
                font-family: 'Outfit', sans-serif;
                font-size: clamp(2.4rem, 5vw, 4.2rem);
                line-height: 0.96;
                letter-spacing: -0.08em;
            }

            .excerpt {
                margin: 18px 0 0;
                color: var(--muted);
                font-size: 1.04rem;
                line-height: 1.85;
                white-space: pre-line;
            }

            .meta-row {
                margin-top: 24px;
                color: var(--muted);
                font-size: 0.94rem;
                font-weight: 700;
            }

            .heading-two {
                margin: 24px 0 0;
                font-family: 'Outfit', sans-serif;
                font-size: clamp(1.6rem, 3vw, 2.2rem);
                letter-spacing: -0.05em;
                line-height: 1.12;
            }

            .body-copy {
                margin-top: 30px;
                color: #20242c;
                font-size: 1rem;
                line-height: 1.95;
            }

            .body-copy p,
            .body-copy h2,
            .body-copy h3,
            .body-copy h4,
            .body-copy ul,
            .body-copy ol,
            .body-copy blockquote,
            .body-copy figure {
                margin: 0 0 18px;
            }

            .body-copy img,
            .body-copy iframe,
            .body-copy video {
                display: block;
                max-width: 100%;
                margin: 24px 0;
                border-radius: 24px;
            }

            .body-copy iframe,
            .body-copy video {
                width: 100%;
                min-height: 320px;
                border: 0;
                background: #eef4fb;
            }

            .related {
                margin-top: 24px;
                padding: 26px;
                border: 1px solid var(--line);
                border-radius: 28px;
                background: var(--panel);
            }

            .related h2 {
                margin: 0;
                font-family: 'Outfit', sans-serif;
                font-size: 2rem;
                letter-spacing: -0.05em;
            }

            .related-grid {
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 16px;
                margin-top: 18px;
            }

            .related-card {
                padding: 20px;
                border: 1px solid var(--line);
                border-radius: 22px;
                background: #fff;
            }

            .related-title {
                margin: 12px 0 0;
                font-family: 'Outfit', sans-serif;
                font-size: 1.3rem;
                letter-spacing: -0.04em;
                line-height: 1.1;
            }

            .related-copy {
                margin: 12px 0 0;
                color: var(--muted);
                line-height: 1.75;
                white-space: pre-line;
            }

            .related-link {
                display: inline-flex;
                margin-top: 16px;
                color: var(--accent);
                font-weight: 800;
            }

            @media (max-width: 900px) {
                .related-grid {
                    grid-template-columns: 1fr;
                }
            }

            @media (max-width: 760px) {
                .topbar,
                .nav-links,
                .meta-row,
                .related-head {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .article-body,
                .related {
                    padding: 22px;
                }
            }
        </style>
    </head>
    <body>
        @php
            $bodyHtml = $blogPost->body === strip_tags($blogPost->body)
                ? nl2br(e($blogPost->body))
                : $blogPost->body;
        @endphp
        <div class="shell">
            <header class="topbar">
                <a class="brand" href="{{ route('home') }}">bookrahisi</a>
                <nav class="nav-links" aria-label="Article navigation">
                    <a class="back-link" href="{{ route('blog.index') }}">Back to blog</a>
                    <a class="nav-link" href="{{ route('for-business') }}">For business</a>
                </nav>
            </header>

            <article class="article">
                @if ($blogPost->cover_image_url)
                    <div class="cover">
                        <img class="cover-image" src="{{ $blogPost->cover_image_url }}" alt="{{ $blogPost->image_alt_text ?: $blogPost->title }}">
                    </div>
                @endif

                <div class="article-body">
                    <span class="eyebrow">Book Rahisi story</span>
                    <h1>{{ $blogPost->title }}</h1>
                    <p class="excerpt">{{ $blogPost->excerpt }}</p>

                    <div class="meta-row">
                        <span>By {{ $blogPost->author_name }}</span>
                        <span>{{ $blogPost->published_at?->format('j M Y \a\t g:i a') }}</span>
                    </div>

                    @if ($blogPost->heading_two)
                        <h2 class="heading-two">{{ $blogPost->heading_two }}</h2>
                    @endif

                    <div class="body-copy">{!! $bodyHtml !!}</div>
                </div>
            </article>

            @if ($relatedPosts->isNotEmpty())
                <section class="related">
                    <div class="related-head">
                        <h2>More from the blog</h2>
                        <a class="related-link" href="{{ route('blog.index') }}">View all posts</a>
                    </div>

                    <div class="related-grid">
                        @foreach ($relatedPosts as $relatedPost)
                            <article class="related-card">
                                <span class="eyebrow">Published</span>
                                <h3 class="related-title">{{ $relatedPost->title }}</h3>
                                <p class="related-copy">{{ $relatedPost->excerpt }}</p>
                                <a class="related-link" href="{{ route('blog.show', ['slug' => $relatedPost->slug]) }}">Read article</a>
                            </article>
                        @endforeach
                    </div>
                </section>
            @endif
        </div>
    </body>
</html>
