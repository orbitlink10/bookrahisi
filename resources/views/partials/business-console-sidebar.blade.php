@php
    $businessInitials = collect(explode(' ', $accountSetup['business_name']))
        ->filter()
        ->take(2)
        ->map(static fn (string $part): string => strtoupper(substr($part, 0, 1)))
        ->implode('');

    $sidebarItems = [
        [
            'code' => 'DB',
            'label' => 'Dashboard',
            'meta' => 'Workspace overview',
            'href' => route('for-business.tools'),
            'active' => request()->routeIs('for-business.tools'),
        ],
        [
            'code' => 'AP',
            'label' => 'Appointments',
            'meta' => 'Calendar and customer requests',
            'href' => route('for-business.pos', ['tab' => 'appointments']),
            'active' => request()->routeIs('for-business.bookings') || (request()->routeIs('for-business.pos') && request('tab') === 'appointments'),
        ],
        [
            'code' => 'CU',
            'label' => 'Customers',
            'meta' => 'Client records and history',
            'href' => route('for-business.pos', ['tab' => 'customers']),
            'active' => request()->routeIs('for-business.pos') && request('tab') === 'customers',
        ],
        [
            'code' => 'PS',
            'label' => 'Billing / POS',
            'meta' => 'Checkout and payment flow',
            'href' => route('for-business.pos', ['tab' => 'checkout']),
            'active' => request()->routeIs('for-business.pos') && in_array(request('tab', 'overview'), ['overview', 'checkout'], true),
        ],
        [
            'code' => 'IN',
            'label' => 'Inventory',
            'meta' => 'Stock and products',
            'href' => route('for-business.pos', ['tab' => 'inventory']),
            'active' => request()->routeIs('for-business.pos') && request('tab') === 'inventory',
        ],
        [
            'code' => 'EM',
            'label' => 'Employees',
            'meta' => 'Staff and commissions',
            'href' => route('for-business.pos', ['tab' => 'staff']),
            'active' => request()->routeIs('for-business.pos') && request('tab') === 'staff',
        ],
        [
            'code' => 'SV',
            'label' => 'Services',
            'meta' => 'Menu and pricing',
            'href' => route('for-business.pos', ['tab' => 'services']),
            'active' => request()->routeIs('for-business.pos') && request('tab') === 'services',
        ],
        [
            'code' => 'MK',
            'label' => 'Marketing',
            'meta' => 'Public listing details',
            'href' => route('for-business.profile-details'),
            'active' => request()->routeIs('for-business.profile-details'),
        ],
        [
            'code' => 'RP',
            'label' => 'Reports',
            'meta' => 'Sales and performance',
            'href' => route('for-business.pos', ['tab' => 'reports']),
            'active' => request()->routeIs('for-business.pos') && request('tab') === 'reports',
        ],
        [
            'code' => 'EX',
            'label' => 'Expenses',
            'meta' => 'Costs and outgoings',
            'href' => route('for-business.pos', ['tab' => 'reports']).'#expenses',
            'active' => false,
        ],
        [
            'code' => 'ST',
            'label' => 'Settings',
            'meta' => 'Business controls',
            'href' => route('for-business.settings'),
            'active' => request()->routeIs('for-business.settings'),
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
