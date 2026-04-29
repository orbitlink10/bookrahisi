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
            'href' => route('customer.dashboard'),
            'active' => request()->routeIs('customer.dashboard'),
        ],
        [
            'code' => 'BK',
            'label' => 'My Bookings',
            'href' => route('customer.bookings'),
            'active' => request()->routeIs('customer.bookings'),
        ],
        [
            'code' => 'BR',
            'label' => 'Browse',
            'href' => route('customer.dashboard').'#browse',
            'active' => false,
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

    <nav class="sidebar-nav" aria-label="Customer console navigation">
        @foreach ($sidebarItems as $item)
            <a class="sidebar-link {{ $item['active'] ? 'is-active' : '' }}" href="{{ $item['href'] }}">
                <span class="sidebar-link-icon">{{ $item['code'] }}</span>
                <span>{{ $item['label'] }}</span>
            </a>
        @endforeach
    </nav>
</aside>
