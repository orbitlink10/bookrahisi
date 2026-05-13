@php
    $primaryItems = $primaryItems ?? [];
    $drawerItems = $drawerItems ?? [];
    $drawerForms = $drawerForms ?? [];
    $drawerTitle = $drawerTitle ?? 'More';
    $drawerCopy = $drawerCopy ?? null;
    $drawerHasActive = collect($drawerItems)->contains(static fn (array $item): bool => (bool) ($item['active'] ?? false));
@endphp

<details class="mobile-nav-shell">
    <summary class="mobile-nav-button mobile-nav-more {{ $drawerHasActive ? 'is-active' : '' }}">
        <span class="mobile-nav-button-icon">MO</span>
        <span class="mobile-nav-button-label">More</span>
    </summary>

    @foreach ($primaryItems as $item)
        <a class="mobile-nav-button {{ ! empty($item['active']) ? 'is-active' : '' }}" href="{{ $item['href'] }}">
            <span class="mobile-nav-button-icon">{{ $item['code'] }}</span>
            <span class="mobile-nav-button-label">{{ $item['label'] }}</span>
        </a>
    @endforeach

    <div class="mobile-nav-drawer">
        <div class="mobile-nav-drawer-head">
            <div>
                <div class="mobile-nav-drawer-title">{{ $drawerTitle }}</div>
                @if ($drawerCopy)
                    <div class="mobile-nav-drawer-copy">{{ $drawerCopy }}</div>
                @endif
            </div>
            <div class="mobile-nav-drawer-hint">Tap More again to close</div>
        </div>

        <div class="mobile-nav-drawer-list">
            @foreach ($drawerItems as $item)
                <a class="mobile-nav-drawer-link {{ ! empty($item['active']) ? 'is-active' : '' }}" href="{{ $item['href'] }}">
                    <span class="mobile-nav-drawer-icon">{{ $item['code'] }}</span>
                    <span class="mobile-nav-drawer-text">
                        <span class="mobile-nav-drawer-label">{{ $item['label'] }}</span>
                        @if (! empty($item['meta']))
                            <span class="mobile-nav-drawer-meta">{{ $item['meta'] }}</span>
                        @endif
                    </span>
                </a>
            @endforeach

            @foreach ($drawerForms as $form)
                <form class="mobile-nav-drawer-form" action="{{ $form['action'] }}" method="{{ $form['method'] ?? 'post' }}">
                    @if (strtolower($form['method'] ?? 'post') !== 'get')
                        @csrf
                    @endif

                    <button class="mobile-nav-drawer-submit {{ ! empty($form['tone']) ? 'is-'.$form['tone'] : '' }}" type="submit">
                        <span class="mobile-nav-drawer-icon">{{ $form['code'] ?? 'GO' }}</span>
                        <span class="mobile-nav-drawer-text">
                            <span class="mobile-nav-drawer-label">{{ $form['label'] }}</span>
                            @if (! empty($form['meta']))
                                <span class="mobile-nav-drawer-meta">{{ $form['meta'] }}</span>
                            @endif
                        </span>
                    </button>
                </form>
            @endforeach
        </div>
    </div>
</details>
