@php
    $customerInitials = collect(explode(' ', $customer->name))
        ->filter()
        ->take(2)
        ->map(static fn (string $part): string => strtoupper(substr($part, 0, 1)))
        ->implode('');

    $sidebarItems = [
        [
            'code' => 'HM',
            'label' => 'Dashboard',
            'meta' => 'Overview and discovery',
            'href' => route('customer.dashboard'),
            'active' => request()->routeIs('customer.dashboard'),
        ],
        [
            'code' => 'BK',
            'label' => 'My Bookings',
            'meta' => 'Upcoming and past visits',
            'href' => route('customer.bookings'),
            'active' => request()->routeIs('customer.bookings'),
        ],
        [
            'code' => 'BR',
            'label' => 'Browse',
            'meta' => 'Find approved businesses',
            'href' => route('customer.dashboard').'#browse',
            'active' => false,
        ],
    ];

    $mobilePrimaryItems = $sidebarItems;
    $mobileDrawerItems = [
        [
            'code' => 'MK',
            'label' => 'Marketplace',
            'meta' => 'Browse public businesses',
            'href' => route('home'),
            'active' => false,
        ],
    ];

    $mobileDrawerForms = [
        [
            'action' => route('customer.sign-out'),
            'label' => 'Sign out',
            'meta' => 'Exit this customer account',
            'code' => 'SO',
            'tone' => 'danger',
        ],
    ];
@endphp

<aside class="console-sidebar">
    <div class="sidebar-brand">
        <div class="brand-avatar">{{ $customerInitials !== '' ? $customerInitials : 'BR' }}</div>
        <div class="brand-copy">
            <div class="brand-title">Book Rahisi</div>
            <div class="brand-subtitle">{{ $customer->name }}</div>
        </div>
    </div>

    <div class="sidebar-section-label">Customer workspace</div>

    <nav class="sidebar-nav" aria-label="Customer console navigation">
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
        <div class="sidebar-support-label">Signed-in account</div>
        <div class="sidebar-support-title">{{ $customer->email }}</div>
        <div class="sidebar-support-copy">{{ $customer->phone_number }}</div>
        <a class="sidebar-support-link" href="{{ route('home') }}">Open marketplace</a>
    </div>

    @include('partials.mobile-console-nav', [
        'primaryItems' => $mobilePrimaryItems,
        'drawerTitle' => $customer->name,
        'drawerCopy' => $customer->email.' / '.$customer->phone_number,
        'drawerItems' => $mobileDrawerItems,
        'drawerForms' => $mobileDrawerForms,
    ])
</aside>
