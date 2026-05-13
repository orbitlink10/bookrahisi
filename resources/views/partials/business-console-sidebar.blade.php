@php
    $businessInitials = collect(explode(' ', $accountSetup['business_name']))
        ->filter()
        ->take(2)
        ->map(static fn (string $part): string => strtoupper(substr($part, 0, 1)))
        ->implode('');

    $sidebarItems = [
        [
            'code' => 'HM',
            'label' => 'Home',
            'meta' => 'Workspace overview',
            'href' => route('for-business.tools'),
            'active' => request()->routeIs('for-business.tools'),
        ],
        [
            'code' => 'BK',
            'label' => 'Bookings',
            'meta' => 'Customer requests and follow-up',
            'href' => route('for-business.bookings'),
            'active' => request()->routeIs('for-business.bookings'),
        ],
        [
            'code' => 'PS',
            'label' => 'POS',
            'meta' => 'Sales, stock, and operations',
            'href' => route('for-business.pos'),
            'active' => request()->routeIs('for-business.pos'),
        ],
        [
            'code' => 'ST',
            'label' => 'Settings',
            'meta' => 'Business controls',
            'href' => route('for-business.settings'),
            'active' => request()->routeIs('for-business.settings'),
        ],
        [
            'code' => 'PR',
            'label' => 'Profile',
            'meta' => 'Public listing details',
            'href' => route('for-business.profile-details'),
            'active' => request()->routeIs('for-business.profile-details'),
        ],
        [
            'code' => 'PB',
            'label' => 'Public Page',
            'meta' => 'Customer-facing preview',
            'href' => ($profileReady ?? false)
                ? route('business.show', ['slug' => $businessSlug])
                : route('for-business.profile-details'),
            'active' => false,
        ],
    ];

    $mobilePrimaryItems = array_slice($sidebarItems, 0, 3);
    $mobileDrawerItems = array_merge(
        array_slice($sidebarItems, 3),
        [
            [
                'code' => 'MK',
                'label' => 'Marketplace',
                'meta' => 'Open the public website',
                'href' => route('home'),
                'active' => false,
            ],
        ],
    );
@endphp

<aside class="console-sidebar">
    <div class="sidebar-brand">
        <div class="brand-avatar">{{ $businessInitials !== '' ? $businessInitials : 'BR' }}</div>
        <div class="brand-copy">
            <div class="brand-title">{{ $accountSetup['business_name'] }}</div>
            <div class="brand-subtitle">{{ $accountSetup['business_category'] }} Console</div>
        </div>
    </div>

    <div class="sidebar-section-label">Business workspace</div>

    <nav class="sidebar-nav" aria-label="Business console navigation">
        @foreach ($sidebarItems as $item)
            <a class="sidebar-link {{ $item['active'] ? 'is-active' : '' }}" href="{{ $item['href'] }}">
                <span class="sidebar-link-icon">{{ $item['code'] }}</span>
                <span class="sidebar-link-copy">
                    <span class="sidebar-link-label">{{ $item['label'] }}</span>
                    <span class="sidebar-link-meta">{{ $item['meta'] }}</span>
                </span>
            </a>
        @endforeach
    </nav>

    <div class="sidebar-support">
        <div class="sidebar-support-label">{{ ($profileReady ?? false) ? 'Public profile live' : 'Setup still needed' }}</div>
        <div class="sidebar-support-title">{{ $accountSetup['business_category'] }}</div>
        <div class="sidebar-support-copy">
            {{ ($profileReady ?? false)
                ? 'Customers can discover your business, open the booking page, and send requests into this workspace.'
                : 'Complete the profile to unlock public discovery, booking requests, and a stronger first impression.' }}
        </div>
        <a class="sidebar-support-link" href="{{ ($profileReady ?? false) ? route('business.show', ['slug' => $businessSlug]) : route('for-business.profile-details') }}">
            {{ ($profileReady ?? false) ? 'Preview public page' : 'Finish profile' }}
        </a>
    </div>

    @include('partials.mobile-console-nav', [
        'primaryItems' => $mobilePrimaryItems,
        'drawerTitle' => $accountSetup['business_name'],
        'drawerCopy' => $accountSetup['business_category'].' workspace',
        'drawerItems' => $mobileDrawerItems,
    ])
</aside>
