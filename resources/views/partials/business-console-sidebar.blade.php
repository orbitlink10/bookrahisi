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
            'href' => route('for-business.tools'),
            'active' => request()->routeIs('for-business.tools'),
        ],
        [
            'code' => 'BK',
            'label' => 'Bookings',
            'href' => route('for-business.bookings'),
            'active' => request()->routeIs('for-business.bookings'),
        ],
        [
            'code' => 'PR',
            'label' => 'Profile',
            'href' => route('for-business.profile-details'),
            'active' => request()->routeIs('for-business.profile-details'),
        ],
        [
            'code' => 'PB',
            'label' => 'Public Page',
            'href' => ($profileReady ?? false)
                ? route('business.show', ['slug' => $businessSlug])
                : route('for-business.profile-details'),
            'active' => false,
        ],
    ];
@endphp

<aside class="console-sidebar">
    <div class="sidebar-brand">
        <div class="brand-avatar">{{ $businessInitials !== '' ? $businessInitials : 'BR' }}</div>
        <div class="brand-copy">
            <div class="brand-title">{{ $accountSetup['business_name'] }}</div>
            <div class="brand-subtitle">{{ $accountSetup['business_category'] }} Console</div>
        </div>
    </div>

    <nav class="sidebar-nav" aria-label="Business console navigation">
        @foreach ($sidebarItems as $item)
            <a class="sidebar-link {{ $item['active'] ? 'is-active' : '' }}" href="{{ $item['href'] }}">
                <span class="sidebar-link-icon">{{ $item['code'] }}</span>
                <span>{{ $item['label'] }}</span>
            </a>
        @endforeach
    </nav>
</aside>
