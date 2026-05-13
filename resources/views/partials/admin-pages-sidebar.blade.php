@php
    $mobilePrimaryItems = [
        [
            'code' => 'DB',
            'label' => 'Dashboard',
            'href' => route('admin.dashboard'),
            'active' => $activeSection === 'dashboard',
        ],
        [
            'code' => 'PG',
            'label' => 'Pages',
            'href' => route('admin.dashboard', ['section' => 'pages']),
            'active' => $activeSection === 'pages',
        ],
    ];

    $mobileDrawerItems = [
        [
            'code' => 'MK',
            'label' => 'Marketplace',
            'meta' => 'Open public website',
            'href' => route('home'),
            'active' => false,
        ],
        [
            'code' => 'BL',
            'label' => 'Blog',
            'meta' => 'Published content',
            'href' => route('blog.index'),
            'active' => false,
        ],
    ];

    $mobileDrawerForms = [
        [
            'action' => route('admin.sign-out'),
            'label' => 'Sign out',
            'meta' => 'Exit admin access',
            'code' => 'SO',
            'tone' => 'danger',
        ],
    ];
@endphp

<aside class="content-sidebar">
    <div class="sidebar-brand-card">
        <div class="sidebar-brand-title">Book Rahisi</div>
        <div class="sidebar-brand-subtitle">Content Admin</div>
    </div>

    <div class="content-group-label">Control center</div>

    <nav class="content-nav" aria-label="Content management navigation">
        <a class="content-link {{ $activeSection === 'dashboard' ? 'is-active' : '' }}" href="{{ route('admin.dashboard') }}">
            <span class="content-link-icon">DB</span>
            <span class="content-link-copy">
                <span class="content-link-label">Dashboard</span>
                <span class="content-link-meta">Marketplace overview</span>
            </span>
        </a>
        <a class="content-link {{ $activeSection === 'pages' ? 'is-active' : '' }}" href="{{ route('admin.dashboard', ['section' => 'pages']) }}">
            <span class="content-link-icon">PG</span>
            <span class="content-link-copy">
                <span class="content-link-label">Pages</span>
                <span class="content-link-meta">Editorial workflow</span>
            </span>
        </a>
    </nav>

    <div class="content-summary-card">
        <div class="content-summary-label">Published</div>
        <div class="content-summary-value">{{ $publishedBlogPosts ?? 0 }}</div>
        <div class="content-summary-copy">Live blog pages currently visible on the public site.</div>
    </div>

    <div class="content-summary-card">
        <div class="content-summary-label">Drafts</div>
        <div class="content-summary-value">{{ $draftBlogPosts ?? 0 }}</div>
        <div class="content-summary-copy">Saved content that still needs edits, review, or approval.</div>
    </div>

    @include('partials.mobile-console-nav', [
        'primaryItems' => $mobilePrimaryItems,
        'drawerTitle' => 'Content admin',
        'drawerCopy' => 'Manage published pages, drafts, and editorial actions.',
        'drawerItems' => $mobileDrawerItems,
        'drawerForms' => $mobileDrawerForms,
    ])
</aside>
