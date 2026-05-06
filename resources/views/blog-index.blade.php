<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Book Rahisi Blog</title>
        <meta
            name="description"
            content="Read beauty, wellness, self-care, and marketplace insights from Book Rahisi."
        >
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700,800|manrope:400,500,600,700,800" rel="stylesheet" />
        <style>
            :root {
                --ink: #111317;
                --muted: #69707d;
                --line: #e5e8ef;
                --soft: #f7f8fb;
                --accent: #17345d;
                --accent-soft: #dbeeff;
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
                width: min(100%, 1240px);
                margin: 0 auto;
                padding: 28px 20px 56px;
            }

            .topbar,
            .post-meta {
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

            .nav-link {
                padding: 12px 16px;
                border: 1px solid var(--line);
                border-radius: 999px;
                background: rgba(255, 255, 255, 0.88);
                font-weight: 800;
            }

            .hero {
                display: grid;
                gap: 22px;
                margin-top: 24px;
                padding: 32px;
                border: 1px solid var(--line);
                border-radius: 30px;
                background: linear-gradient(135deg, #17345d 0%, #1a7691 100%);
                color: #fff;
            }

            .eyebrow {
                display: inline-flex;
                align-items: center;
                padding: 10px 14px;
                border-radius: 999px;
                background: rgba(255, 255, 255, 0.14);
                font-size: 0.84rem;
                font-weight: 800;
                width: fit-content;
            }

            .hero h1 {
                margin: 0;
                font-family: 'Outfit', sans-serif;
                font-size: clamp(2.5rem, 5vw, 4.5rem);
                line-height: 0.95;
                letter-spacing: -0.08em;
            }

            .hero p {
                margin: 0;
                max-width: 760px;
                color: rgba(255, 255, 255, 0.92);
                font-size: 1.02rem;
                line-height: 1.8;
            }

            .featured-card,
            .post-card {
                border: 1px solid var(--line);
                border-radius: 28px;
                background: rgba(255, 255, 255, 0.94);
                overflow: hidden;
                box-shadow: 0 24px 44px rgba(23, 52, 93, 0.08);
            }

            .featured-card {
                display: grid;
                grid-template-columns: minmax(0, 1.1fr) minmax(320px, 0.9fr);
                margin-top: 24px;
            }

            .featured-body,
            .post-body {
                padding: 26px;
            }

            .cover {
                background: #eef4fb;
            }

            .cover-image {
                display: block;
                width: 100%;
                min-height: 220px;
                height: 100%;
                object-fit: cover;
            }

            .post-kicker {
                color: #1a7691;
                font-size: 0.82rem;
                font-weight: 800;
                text-transform: uppercase;
                letter-spacing: 0.08em;
            }

            .featured-title,
            .post-title {
                margin: 14px 0 0;
                font-family: 'Outfit', sans-serif;
                letter-spacing: -0.05em;
            }

            .featured-title {
                font-size: clamp(2rem, 3vw, 3rem);
                line-height: 0.98;
            }

            .post-title {
                font-size: 1.6rem;
                line-height: 1.05;
            }

            .excerpt {
                margin: 16px 0 0;
                color: var(--muted);
                line-height: 1.8;
                white-space: pre-line;
            }

            .post-meta {
                margin-top: 18px;
                color: var(--muted);
                font-size: 0.92rem;
            }

            .read-link {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                margin-top: 22px;
                padding: 14px 18px;
                border-radius: 16px;
                background: var(--accent);
                color: #fff;
                font-weight: 800;
            }

            .grid {
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 18px;
                margin-top: 24px;
            }

            .empty-state {
                margin-top: 24px;
                padding: 28px;
                border: 1px dashed var(--line);
                border-radius: 28px;
                background: rgba(255, 255, 255, 0.9);
                color: var(--muted);
                line-height: 1.8;
            }

            @media (max-width: 1040px) {
                .featured-card,
                .grid {
                    grid-template-columns: 1fr;
                }
            }

            @media (max-width: 760px) {
                .topbar,
                .nav-links,
                .post-meta {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .hero,
                .featured-body,
                .post-body {
                    padding: 22px;
                }
            }
        </style>
    </head>
    <body>
        <div class="shell">
            <header class="topbar">
                <a class="brand" href="{{ route('home') }}">bookrahisi</a>
                <nav class="nav-links" aria-label="Blog navigation">
                    <a class="nav-link" href="{{ route('home') }}">Marketplace</a>
                    <a class="nav-link" href="{{ route('for-business') }}">For business</a>
                </nav>
            </header>

            <section class="hero">
                <span class="eyebrow">Book Rahisi Blog</span>
                <h1>Ideas, insights, and booking guidance for self-care businesses and customers.</h1>
                <p>Read practical content on beauty, wellness, growth, and customer experience from the Book Rahisi platform team.</p>
            </section>

            @if ($featuredPost)
                <article class="featured-card">
                    <div class="featured-body">
                        <span class="post-kicker">Featured article</span>
                        <h2 class="featured-title">{{ $featuredPost->title }}</h2>
                        <p class="excerpt">{{ $featuredPost->excerpt }}</p>
                        <div class="post-meta">
                            <span>{{ $featuredPost->author_name }}</span>
                            <span>{{ $featuredPost->published_at?->format('j M Y') }}</span>
                        </div>
                        <a class="read-link" href="{{ route('blog.show', ['slug' => $featuredPost->slug]) }}">Read article</a>
                    </div>
                    <div class="cover">
                        @if ($featuredPost->cover_image_url)
                            <img class="cover-image" src="{{ $featuredPost->cover_image_url }}" alt="{{ $featuredPost->image_alt_text ?: $featuredPost->title }}" style="min-height: 320px;">
                        @endif
                    </div>
                </article>
            @endif

            @if (! $blogPostsTableExists)
                <div class="empty-state">The blog is not available yet because the blog database tables have not been installed on this server.</div>
            @elseif ($blogPosts->isEmpty())
                <div class="empty-state">No published blog posts are live yet. New articles will appear here once an admin publishes them from the marketplace console.</div>
            @else
                <section class="grid">
                    @foreach ($blogPosts as $blogPost)
                        <article class="post-card">
                            <div class="cover">
                                @if ($blogPost->cover_image_url)
                                    <img class="cover-image" src="{{ $blogPost->cover_image_url }}" alt="{{ $blogPost->image_alt_text ?: $blogPost->title }}">
                                @endif
                            </div>
                            <div class="post-body">
                                <span class="post-kicker">{{ ucfirst($blogPost->content_type ?: 'post') }}</span>
                                <h2 class="post-title">{{ $blogPost->title }}</h2>
                                <p class="excerpt">{{ $blogPost->excerpt }}</p>
                                <div class="post-meta">
                                    <span>{{ $blogPost->author_name }}</span>
                                    <span>{{ $blogPost->published_at?->format('j M Y') }}</span>
                                </div>
                                <a class="read-link" href="{{ route('blog.show', ['slug' => $blogPost->slug]) }}">Open page</a>
                            </div>
                        </article>
                    @endforeach
                </section>
            @endif
        </div>
    </body>
</html>
