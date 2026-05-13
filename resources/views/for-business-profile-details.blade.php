<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Book Rahisi For Professionals | Business Profile Details</title>
        <meta
            name="description"
            content="Set up the public-facing details of your Book Rahisi business profile."
        >
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700,800|manrope:400,500,600,700,800" rel="stylesheet" />
        <style>
            :root {
                --navy: #17345d;
                --navy-deep: #112744;
                --navy-soft: rgba(255, 255, 255, 0.08);
                --line: #d6e2f0;
                --page: #eef5fb;
                --panel: #ffffff;
                --ink: #17304d;
                --muted: #607792;
                --accent: #1aa0e2;
                --accent-deep: #14898b;
                --danger: #c24b3a;
                --danger-soft: #fff0ee;
                --shadow: 0 24px 44px rgba(28, 66, 104, 0.12);
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                min-height: 100vh;
                background: linear-gradient(180deg, #f6fbff 0%, var(--page) 100%);
                color: var(--ink);
                font-family: 'Manrope', sans-serif;
            }

            a {
                color: inherit;
                text-decoration: none;
            }

            button,
            input,
            textarea {
                font: inherit;
            }

            .console-app {
                display: grid;
                grid-template-columns: 320px minmax(0, 1fr);
                min-height: 100vh;
            }

            .console-sidebar {
                position: sticky;
                top: 0;
                display: grid;
                align-content: start;
                gap: 28px;
                min-height: 100vh;
                padding: 24px 20px;
                background: linear-gradient(180deg, var(--navy) 0%, var(--navy-deep) 100%);
                color: #fff;
            }

            .sidebar-brand {
                display: flex;
                align-items: center;
                gap: 14px;
            }

            .brand-avatar {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 58px;
                height: 58px;
                border-radius: 18px;
                background: linear-gradient(180deg, #d9ecff 0%, #a8d1ff 100%);
                color: var(--navy);
                font-family: 'Outfit', sans-serif;
                font-size: 1.35rem;
                font-weight: 800;
                letter-spacing: -0.05em;
            }

            .brand-copy {
                display: grid;
                gap: 4px;
            }

            .brand-title {
                font-family: 'Outfit', sans-serif;
                font-size: 2rem;
                font-weight: 800;
                letter-spacing: -0.06em;
            }

            .brand-subtitle {
                color: rgba(255, 255, 255, 0.74);
                font-size: 0.96rem;
                font-weight: 700;
            }

            .sidebar-nav {
                display: grid;
                gap: 10px;
            }

            .sidebar-link {
                display: flex;
                align-items: center;
                gap: 16px;
                padding: 14px 16px;
                border: 1px solid transparent;
                border-radius: 18px;
                color: rgba(255, 255, 255, 0.82);
                font-size: 0.98rem;
                font-weight: 800;
                transition: background-color 160ms ease, border-color 160ms ease, color 160ms ease;
            }

            .sidebar-link:hover,
            .sidebar-link.is-active {
                border-color: rgba(255, 255, 255, 0.18);
                background: rgba(255, 255, 255, 0.12);
                color: #fff;
            }

            .sidebar-link-icon {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 38px;
                height: 38px;
                border-radius: 12px;
                border: 1px solid rgba(255, 255, 255, 0.16);
                background: var(--navy-soft);
                font-size: 0.86rem;
                font-weight: 800;
            }

            .workspace {
                padding: 26px 28px 36px;
            }

            .workspace-shell {
                width: min(100%, 1420px);
                margin: 0 auto;
            }

            .topbar {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 18px;
                margin-bottom: 22px;
            }

            .eyebrow {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                padding: 10px 16px;
                border-radius: 999px;
                background: #def2ff;
                color: var(--accent);
                font-size: 0.88rem;
                font-weight: 800;
            }

            h1 {
                margin: 0;
                font-family: 'Outfit', sans-serif;
                font-size: clamp(2.3rem, 4vw, 3.7rem);
                letter-spacing: -0.06em;
                line-height: 1;
            }

            .subtitle {
                margin: 14px 0 0;
                color: var(--muted);
                font-size: 1rem;
                line-height: 1.75;
                max-width: 820px;
            }

            .toolbar {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
            }

            .button-dark,
            .button-light {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 14px 20px;
                border-radius: 16px;
                font-size: 0.96rem;
                font-weight: 800;
            }

            .button-dark {
                border: 0;
                background: var(--navy);
                color: #fff;
                cursor: pointer;
                box-shadow: 0 14px 30px rgba(23, 52, 93, 0.16);
            }

            .button-light {
                border: 1px solid var(--line);
                background: rgba(255, 255, 255, 0.9);
                color: var(--ink);
            }

            .hero-card {
                display: grid;
                grid-template-columns: minmax(0, 1.2fr) auto;
                gap: 24px;
                align-items: center;
                margin-bottom: 22px;
                padding: 28px 30px;
                border-radius: 26px;
                background: linear-gradient(135deg, var(--accent) 0%, var(--accent-deep) 100%);
                color: #fff;
                box-shadow: var(--shadow);
            }

            .hero-card h2 {
                margin: 14px 0 0;
                font-family: 'Outfit', sans-serif;
                font-size: clamp(2.4rem, 4vw, 3.4rem);
                letter-spacing: -0.06em;
                line-height: 0.98;
                max-width: 10ch;
            }

            .hero-copy {
                margin: 14px 0 0;
                max-width: 780px;
                color: rgba(255, 255, 255, 0.94);
                font-size: 1rem;
                line-height: 1.7;
            }

            .hero-actions {
                display: flex;
                flex-wrap: wrap;
                gap: 12px;
                margin-top: 20px;
            }

            .hero-actions .button-dark,
            .hero-actions .button-light {
                border-radius: 16px;
                background: rgba(255, 255, 255, 0.95);
                color: var(--ink);
                box-shadow: none;
            }

            .hero-side {
                display: grid;
                justify-items: end;
                gap: 16px;
                min-width: 220px;
                text-align: right;
            }

            .hero-tag {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 12px 16px;
                border-radius: 16px;
                background: rgba(255, 255, 255, 0.88);
                color: var(--accent);
                font-size: 0.92rem;
                font-weight: 800;
            }

            .hero-side-copy {
                color: rgba(255, 255, 255, 0.92);
                font-size: 0.96rem;
                line-height: 1.7;
                max-width: 220px;
            }

            .content-grid {
                display: grid;
                grid-template-columns: minmax(0, 1.15fr) minmax(340px, 0.85fr);
                gap: 18px;
            }

            .panel {
                border: 1px solid var(--line);
                border-radius: 24px;
                background: rgba(255, 255, 255, 0.94);
                box-shadow: var(--shadow);
            }

            .form-panel,
            .preview-panel {
                padding: 24px;
            }

            .panel-title {
                margin: 0;
                font-family: 'Outfit', sans-serif;
                font-size: 1.7rem;
                letter-spacing: -0.05em;
            }

            .panel-copy {
                margin: 10px 0 0;
                color: var(--muted);
                line-height: 1.7;
            }

            .error-summary {
                margin: 18px 0 0;
                padding: 14px 16px;
                border: 1px solid rgba(194, 75, 58, 0.18);
                border-radius: 18px;
                background: var(--danger-soft);
                color: var(--danger);
                font-size: 0.94rem;
                font-weight: 700;
            }

            .form-grid {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 18px;
                margin-top: 22px;
            }

            .field-group {
                display: grid;
                gap: 10px;
            }

            .field-group-full {
                grid-column: 1 / -1;
            }

            .field-label {
                font-size: 0.92rem;
                font-weight: 800;
            }

            .field-input,
            .field-textarea {
                width: 100%;
                padding: 18px 18px;
                border: 1px solid var(--line);
                border-radius: 18px;
                outline: none;
                background: #fff;
                color: var(--ink);
                font-size: 0.98rem;
                transition: border-color 0.2s ease, box-shadow 0.2s ease;
            }

            .field-input {
                min-height: 62px;
            }

            .field-input[type="file"] {
                padding-top: 16px;
                padding-bottom: 16px;
            }

            .field-textarea {
                min-height: 170px;
                resize: vertical;
            }

            .field-input:focus,
            .field-textarea:focus {
                border-color: var(--accent);
                box-shadow: 0 0 0 4px rgba(26, 160, 226, 0.08);
            }

            .field-error-state {
                border-color: var(--danger);
                background: var(--danger-soft);
            }

            .field-error {
                color: var(--danger);
                font-size: 0.88rem;
                font-weight: 700;
            }

            .field-hint {
                color: var(--muted);
                font-size: 0.9rem;
                line-height: 1.6;
            }

            .location-picker-shell {
                display: flex;
                align-items: center;
                gap: 10px;
                min-width: 0;
            }

            .location-picker-shell .field-input {
                flex: 1 1 auto;
                min-width: 0;
            }

            .location-picker-clear {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 38px;
                height: 38px;
                border: 0;
                border-radius: 999px;
                background: rgba(23, 52, 93, 0.08);
                color: rgba(23, 52, 93, 0.72);
                cursor: pointer;
                flex: 0 0 auto;
            }

            .location-picker-clear[hidden] {
                display: none;
            }

            .location-picker-clear:hover {
                background: rgba(23, 52, 93, 0.14);
            }

            .location-picker-dropdown {
                position: relative;
                z-index: 18;
                max-height: 320px;
                overflow-y: auto;
                margin-top: 12px;
                padding: 10px 0;
                border: 1px solid rgba(23, 52, 93, 0.08);
                border-radius: 24px;
                background: rgba(255, 255, 255, 0.98);
                box-shadow: 0 22px 42px rgba(17, 19, 23, 0.1);
            }

            .location-picker-dropdown[hidden] {
                display: none;
            }

            .location-picker-option {
                display: grid;
                grid-template-columns: auto minmax(0, 1fr);
                gap: 14px;
                align-items: flex-start;
                width: 100%;
                padding: 14px 18px;
                border: 0;
                background: transparent;
                color: var(--ink);
                text-align: left;
                cursor: pointer;
            }

            .location-picker-option:hover,
            .location-picker-option.is-active {
                background: rgba(23, 52, 93, 0.05);
            }

            .location-picker-option-icon {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 40px;
                height: 40px;
                border-radius: 14px;
                background: rgba(23, 52, 93, 0.06);
                color: rgba(23, 52, 93, 0.68);
            }

            .location-picker-option-copy {
                display: grid;
                gap: 3px;
            }

            .location-picker-option-primary {
                font-size: 0.98rem;
                font-weight: 800;
                line-height: 1.35;
            }

            .location-picker-option-secondary,
            .location-picker-empty {
                color: var(--muted);
                font-size: 0.92rem;
                line-height: 1.55;
            }

            .location-picker-empty {
                padding: 14px 18px;
            }

            .gallery-preview-grid {
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 12px;
                margin-top: 12px;
            }

            .gallery-preview-item {
                aspect-ratio: 1;
                border-radius: 18px;
                background-position: center;
                background-size: cover;
                background-repeat: no-repeat;
                border: 1px solid var(--line);
            }

            .actions {
                display: flex;
                flex-wrap: wrap;
                gap: 12px;
                margin-top: 24px;
            }

            .preview-card {
                overflow: hidden;
                margin-top: 22px;
                border: 1px solid var(--line);
                border-radius: 22px;
                background: #fff;
            }

            .preview-image {
                aspect-ratio: 1.25;
                background-image:
                    linear-gradient(180deg, rgba(17, 19, 23, 0.04) 0%, rgba(17, 19, 23, 0.2) 100%),
                    url('{{ $sideImage }}');
                background-position: center;
                background-size: cover;
                background-repeat: no-repeat;
            }

            .preview-body {
                display: grid;
                gap: 14px;
                padding: 22px;
            }

            .pill {
                display: inline-flex;
                align-items: center;
                width: fit-content;
                padding: 8px 12px;
                border-radius: 999px;
                background: #e8f4ff;
                color: #0f69ad;
                font-size: 0.84rem;
                font-weight: 800;
            }

            .preview-name {
                margin: 0;
                font-family: 'Outfit', sans-serif;
                font-size: 2rem;
                letter-spacing: -0.05em;
            }

            .preview-line {
                color: var(--muted);
                line-height: 1.7;
            }

            .preview-list {
                display: grid;
                gap: 14px;
                margin-top: 8px;
            }

            .preview-item {
                padding-top: 14px;
                border-top: 1px solid var(--line);
            }

            .preview-label {
                display: block;
                margin-bottom: 6px;
                color: var(--muted);
                font-size: 0.78rem;
                font-weight: 800;
                text-transform: uppercase;
                letter-spacing: 0.08em;
            }

            .preview-value {
                font-size: 0.98rem;
                font-weight: 700;
                line-height: 1.6;
            }

            .preview-route {
                margin-top: 18px;
                padding: 16px 18px;
                border-radius: 18px;
                background: #f7fbfe;
                color: var(--muted);
                font-size: 0.9rem;
                line-height: 1.6;
                border: 1px solid var(--line);
            }

            .preview-route strong {
                display: block;
                margin-bottom: 6px;
                color: var(--ink);
            }

            @media (max-width: 1120px) {
                .console-app {
                    grid-template-columns: 1fr;
                }

                .console-sidebar {
                    position: static;
                    min-height: 0;
                }

                .hero-card,
                .content-grid {
                    grid-template-columns: 1fr;
                }

                .hero-side {
                    justify-items: start;
                    text-align: left;
                }
            }

            @media (max-width: 760px) {
                .workspace {
                    padding: 18px 16px 28px;
                }

                .topbar,
                .toolbar,
                .hero-actions,
                .actions {
                    flex-direction: column;
                    align-items: stretch;
                }

                .form-grid {
                    grid-template-columns: 1fr;
                }

                .gallery-preview-grid {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }

                .button-dark,
                .button-light,
                .hero-actions .button-dark,
                .hero-actions .button-light {
                    width: 100%;
                }
            }
            @include('partials.auth-console-overrides')
        </style>
    </head>
    <body>
        @php
            $profileReady = is_array($profileDetails) && $profileDetails !== [];
            $googleMapsApiKey = config('services.google.maps_api_key');
        @endphp

        <div class="console-app">
            @include('partials.business-console-sidebar', ['profileReady' => $profileReady])

            <main class="workspace">
                <div class="workspace-shell">
                    <div class="topbar">
                        <div>
                            <span class="eyebrow">Public profile setup</span>
                            <h1>Build the page customers will book from</h1>
                            <p class="subtitle">
                                Add your location, hours, tagline, about copy, and an optional YouTube link. This powers the customer-facing business page for {{ $accountSetup['business_name'] }}.
                            </p>
                        </div>

                        <div class="toolbar">
                            <a class="button-light" href="{{ route('for-business.tools') }}">Back to dashboard</a>
                            @if ($profileReady)
                                <a class="button-dark" href="{{ route('business.show', ['slug' => $businessSlug]) }}">View public page</a>
                            @endif
                        </div>
                    </div>

                    <section class="hero-card">
                        <div>
                            <span class="eyebrow" style="background: rgba(255, 255, 255, 0.16); color: #fff;">Profile editor</span>
                            <h2>Build the page customers will book from</h2>
                            <p class="hero-copy">
                                This step defines the top section, address block, business hours, about area, and optional video section on your public listing. Keep it current so customers can trust what they see before booking.
                            </p>
                            <div class="hero-actions">
                                <a class="button-dark" href="{{ route('for-business.tools') }}">Back to dashboard</a>
                                @if ($profileReady)
                                    <a class="button-light" href="{{ route('business.show', ['slug' => $businessSlug]) }}">Preview customer page</a>
                                @endif
                            </div>
                        </div>

                        <div class="hero-side">
                            <span class="hero-tag">{{ $profileReady ? 'Live preview ready' : 'Draft mode' }}</span>
                            <div class="hero-side-copy">
                                Save this step to keep your public business page aligned with your real location, opening hours, and positioning.
                            </div>
                        </div>
                    </section>

                    <div class="content-grid">
                        <section class="panel form-panel">
                            <h2 class="panel-title">Business profile details</h2>
                            <p class="panel-copy">
                                Enter the public information customers rely on before they place a booking.
                            </p>

                            <form action="{{ route('for-business.profile-details.submit') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                @if ($errors->any())
                                    <div class="error-summary">
                                        Complete the highlighted fields before previewing your customer page.
                                    </div>
                                @endif

                                <div class="form-grid">
                                    <div class="field-group field-group-full">
                                        <label class="field-label" for="tagline">Business tagline</label>
                                        <input
                                            class="field-input @error('tagline') field-error-state @enderror"
                                            id="tagline"
                                            name="tagline"
                                            type="text"
                                            placeholder="Luxury massage therapy in a calm, modern space"
                                            value="{{ old('tagline', $profileDetails['tagline'] ?? '') }}"
                                        >
                                        @error('tagline')
                                            <span class="field-error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="field-group field-group-full">
                                        <label class="field-label" for="address-line">Street address</label>
                                        <div class="location-picker-shell">
                                            <input
                                                class="field-input @error('address_line') field-error-state @enderror"
                                                id="address-line"
                                                name="address_line"
                                                type="text"
                                                autocomplete="off"
                                                placeholder="Ngong Road, Prestige Plaza"
                                                value="{{ old('address_line', $profileDetails['address_line'] ?? '') }}"
                                                aria-autocomplete="list"
                                                aria-controls="address-suggestions"
                                                aria-expanded="false"
                                            >
                                            <button
                                                class="location-picker-clear"
                                                id="address-line-clear"
                                                type="button"
                                                aria-label="Clear selected address"
                                                @if (! old('address_line', $profileDetails['address_line'] ?? '')) hidden @endif
                                            >
                                                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                                                    <path d="M6 6l12 12"></path>
                                                    <path d="M18 6L6 18"></path>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="location-picker-dropdown" id="address-suggestions" hidden></div>
                                        <span class="field-hint" id="location-picker-status">
                                            Start typing and select an address from Google Maps suggestions to fill the street address, city, and neighborhood faster.
                                            @if (! $googleMapsApiKey)
                                                Google Maps suggestions are currently unavailable until `GOOGLE_MAPS_API_KEY` is configured, so manual entry still works.
                                            @endif
                                        </span>
                                        @error('address_line')
                                            <span class="field-error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="field-group">
                                        <label class="field-label" for="city">City</label>
                                        <input
                                            class="field-input @error('city') field-error-state @enderror"
                                            id="city"
                                            name="city"
                                            type="text"
                                            placeholder="Nairobi"
                                            value="{{ old('city', $profileDetails['city'] ?? '') }}"
                                        >
                                        @error('city')
                                            <span class="field-error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="field-group">
                                        <label class="field-label" for="neighborhood">Neighborhood</label>
                                        <input
                                            class="field-input @error('neighborhood') field-error-state @enderror"
                                            id="neighborhood"
                                            name="neighborhood"
                                            type="text"
                                            placeholder="Kilimani"
                                            value="{{ old('neighborhood', $profileDetails['neighborhood'] ?? '') }}"
                                        >
                                        @error('neighborhood')
                                            <span class="field-error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="field-group">
                                        <label class="field-label" for="opening-time">Opening time</label>
                                        <input
                                            class="field-input @error('opening_time') field-error-state @enderror"
                                            id="opening-time"
                                            name="opening_time"
                                            type="time"
                                            value="{{ old('opening_time', $profileDetails['opening_time'] ?? '09:00') }}"
                                        >
                                        @error('opening_time')
                                            <span class="field-error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="field-group">
                                        <label class="field-label" for="closing-time">Closing time</label>
                                        <input
                                            class="field-input @error('closing_time') field-error-state @enderror"
                                            id="closing-time"
                                            name="closing_time"
                                            type="time"
                                            value="{{ old('closing_time', $profileDetails['closing_time'] ?? '19:00') }}"
                                        >
                                        @error('closing_time')
                                            <span class="field-error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="field-group field-group-full">
                                        <label class="field-label" for="about">About your business</label>
                                        <textarea
                                            class="field-textarea @error('about') field-error-state @enderror"
                                            id="about"
                                            name="about"
                                            placeholder="Describe your atmosphere, expertise, service approach, and what customers can expect."
                                        >{{ old('about', $profileDetails['about'] ?? '') }}</textarea>
                                        @error('about')
                                            <span class="field-error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="field-group field-group-full">
                                        <label class="field-label" for="youtube-url">YouTube link</label>
                                        <input
                                            class="field-input @error('youtube_url') field-error-state @enderror"
                                            id="youtube-url"
                                            name="youtube_url"
                                            type="url"
                                            placeholder="https://www.youtube.com/watch?v=dQw4w9WgXcQ"
                                            value="{{ old('youtube_url', $profileDetails['youtube_url'] ?? '') }}"
                                        >
                                        <span class="field-hint">Optional. Paste a YouTube video link to feature it on the public business page.</span>
                                        @error('youtube_url')
                                            <span class="field-error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="field-group field-group-full">
                                        <label class="field-label" for="gallery-images">Profile images</label>
                                        <input
                                            class="field-input @error('gallery_images') field-error-state @enderror @error('gallery_images.*') field-error-state @enderror"
                                            id="gallery-images"
                                            name="gallery_images[]"
                                            type="file"
                                            accept="image/*"
                                            multiple
                                        >
                                        <span class="field-hint">Upload up to 6 images for your public business page. Adding new files replaces the current photo gallery.</span>
                                        @if ($galleryPreviewImages !== [])
                                            <div class="gallery-preview-grid" aria-label="Current profile images">
                                                @foreach ($galleryPreviewImages as $galleryPreviewImage)
                                                    <div class="gallery-preview-item" style="background-image: url('{{ $galleryPreviewImage }}');"></div>
                                                @endforeach
                                            </div>
                                        @endif
                                        @error('gallery_images')
                                            <span class="field-error">{{ $message }}</span>
                                        @enderror
                                        @error('gallery_images.*')
                                            <span class="field-error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="actions">
                                    <button class="button-dark" type="submit">Save and preview customer page</button>
                                    <a class="button-light" href="{{ route('for-business.tools') }}">Return to dashboard</a>
                                </div>
                            </form>
                        </section>

                        <aside class="panel preview-panel">
                            <h2 class="panel-title">Preview summary</h2>
                            <p class="panel-copy">
                                As soon as you save this step, Book Rahisi will generate a public page with photos, services, team, video, and about sections.
                            </p>

                            <div class="preview-card">
                                <div class="preview-image" style="background-image:
                                    linear-gradient(180deg, rgba(17, 19, 23, 0.04) 0%, rgba(17, 19, 23, 0.2) 100%),
                                    url('{{ $previewImageUrl }}');"></div>
                                <div class="preview-body">
                                    <span class="pill">Featured listing</span>
                                    <h3 class="preview-name">{{ $accountSetup['business_name'] }}</h3>
                                    <p class="preview-line">
                                        {{ $accountSetup['business_category'] }}<br>
                                        {{ $email }}
                                    </p>

                                    <div class="preview-list">
                                        <div class="preview-item">
                                            <span class="preview-label">Tagline</span>
                                            <span class="preview-value">{{ $profileDetails['tagline'] ?? 'Add a short promise that tells customers why they should book.' }}</span>
                                        </div>
                                        <div class="preview-item">
                                            <span class="preview-label">Location</span>
                                            <span class="preview-value">
                                                {{ ($profileDetails['neighborhood'] ?? 'Neighborhood').', '.($profileDetails['city'] ?? 'City') }}
                                            </span>
                                        </div>
                                        <div class="preview-item">
                                            <span class="preview-label">Hours</span>
                                            <span class="preview-value">
                                                {{ $profileDetails['opening_time'] ?? '09:00' }} - {{ $profileDetails['closing_time'] ?? '19:00' }}
                                            </span>
                                        </div>
                                        <div class="preview-item">
                                            <span class="preview-label">YouTube</span>
                                            <span class="preview-value">{{ $profileDetails['youtube_url'] ?? 'Add a YouTube link if you want customers to preview your work or space.' }}</span>
                                        </div>
                                        <div class="preview-item">
                                            <span class="preview-label">Images</span>
                                            <span class="preview-value">
                                                {{ $galleryPreviewImages !== [] ? count($galleryPreviewImages).' uploaded image'.(count($galleryPreviewImages) === 1 ? '' : 's').' ready for the public gallery.' : 'Upload images so customers can preview your space, services, or finished work.' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="preview-route">
                                <strong>Public URL preview</strong>
                                {{ url('/business/'.$businessSlug) }}
                            </div>
                        </aside>
                    </div>
                </div>
            </main>
        </div>
        @if ($googleMapsApiKey)
            <script>
                window.initBusinessProfileAddressPicker = function () {
                    const addressInput = document.getElementById('address-line');
                    const cityInput = document.getElementById('city');
                    const neighborhoodInput = document.getElementById('neighborhood');
                    const statusNode = document.getElementById('location-picker-status');
                    const clearButton = document.getElementById('address-line-clear');
                    const dropdown = document.getElementById('address-suggestions');

                    if (! addressInput || ! dropdown || ! window.google || ! window.google.maps || ! window.google.maps.places) {
                        return;
                    }

                    const autocompleteService = new window.google.maps.places.AutocompleteService();
                    const placesService = new window.google.maps.places.PlacesService(document.createElement('div'));
                    let activeIndex = -1;
                    let debounceTimer = null;
                    let predictions = [];

                    const updateClearButton = function () {
                        if (! clearButton) {
                            return;
                        }

                        clearButton.hidden = addressInput.value.trim() === '';
                    };

                    const hideDropdown = function () {
                        dropdown.hidden = true;
                        dropdown.innerHTML = '';
                        addressInput.setAttribute('aria-expanded', 'false');
                        activeIndex = -1;
                    };

                    const componentMap = function (addressComponents) {
                        return (addressComponents || []).reduce(function (carry, component) {
                            (component.types || []).forEach(function (type) {
                                if (! carry[type]) {
                                    carry[type] = component.long_name;
                                }
                            });

                            return carry;
                        }, {});
                    };

                    const composeAddressLine = function (components, place) {
                        const mainStreet = [components.street_number, components.route].filter(Boolean).join(' ').trim();
                        const secondaryLine = components.subpremise || components.premise || components.establishment || place.name || '';
                        const parts = [];

                        if (mainStreet !== '') {
                            parts.push(mainStreet);
                        }

                        if (secondaryLine !== '' && ! parts.includes(secondaryLine)) {
                            parts.push(secondaryLine);
                        }

                        if (parts.length > 0) {
                            return parts.join(', ');
                        }

                        if (typeof place.formatted_address === 'string' && place.formatted_address.trim() !== '') {
                            return place.formatted_address
                                .split(',')
                                .slice(0, 2)
                                .map(function (part) {
                                    return part.trim();
                                })
                                .filter(Boolean)
                                .join(', ');
                        }

                        return addressInput.value;
                    };

                    const locationOptionIcon = function () {
                        return `
                            <span class="location-picker-option-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 21s6-5.33 6-11a6 6 0 1 0-12 0c0 5.67 6 11 6 11Z"></path>
                                    <circle cx="12" cy="10" r="2.5"></circle>
                                </svg>
                            </span>
                        `;
                    };

                    const escapeHtml = function (value) {
                        return String(value)
                            .replaceAll('&', '&amp;')
                            .replaceAll('<', '&lt;')
                            .replaceAll('>', '&gt;')
                            .replaceAll('"', '&quot;')
                            .replaceAll("'", '&#039;');
                    };

                    const renderEmptyState = function (message) {
                        dropdown.innerHTML = '<div class="location-picker-empty">' + message + '</div>';
                        dropdown.hidden = false;
                        addressInput.setAttribute('aria-expanded', 'true');
                        activeIndex = -1;
                    };

                    const fillPlace = function (place) {
                        if (! place || ! Array.isArray(place.address_components) || place.address_components.length === 0) {
                            if (statusNode) {
                                statusNode.textContent = 'Select one of the Google Maps suggestions to apply the address details.';
                            }

                            return;
                        }

                        const components = componentMap(place.address_components);

                        addressInput.value = composeAddressLine(components, place);

                        if (cityInput) {
                            cityInput.value = components.locality
                                || components.administrative_area_level_2
                                || components.administrative_area_level_1
                                || cityInput.value;
                        }

                        if (neighborhoodInput) {
                            neighborhoodInput.value = components.sublocality_level_1
                                || components.sublocality
                                || components.neighborhood
                                || components.premise
                                || components.establishment
                                || neighborhoodInput.value;
                        }

                        updateClearButton();
                        hideDropdown();

                        if (statusNode) {
                            statusNode.textContent = 'Picked from Google Maps. You can still adjust the street address, city, or neighborhood manually before saving.';
                        }
                    };

                    const selectPrediction = function (prediction) {
                        placesService.getDetails({
                            placeId: prediction.place_id,
                            fields: ['address_components', 'formatted_address', 'name'],
                        }, function (place, status) {
                            if (status !== window.google.maps.places.PlacesServiceStatus.OK || ! place) {
                                if (statusNode) {
                                    statusNode.textContent = 'Google Maps found a suggestion, but the address details could not be loaded. You can keep typing or fill the fields manually.';
                                }

                                return;
                            }

                            fillPlace(place);
                        });
                    };

                    const renderPredictions = function () {
                        if (predictions.length === 0) {
                            renderEmptyState('No Google Maps locations matched that search yet.');
                            return;
                        }

                        dropdown.innerHTML = predictions.map(function (prediction, index) {
                            const mainText = prediction.structured_formatting && prediction.structured_formatting.main_text
                                ? prediction.structured_formatting.main_text
                                : prediction.description;
                            const secondaryText = prediction.structured_formatting && prediction.structured_formatting.secondary_text
                                ? prediction.structured_formatting.secondary_text
                                : prediction.description;

                            return `
                                <button class="location-picker-option${index === activeIndex ? ' is-active' : ''}" type="button" data-index="${index}">
                                    ${locationOptionIcon()}
                                    <span class="location-picker-option-copy">
                                        <span class="location-picker-option-primary">${escapeHtml(mainText)}</span>
                                        <span class="location-picker-option-secondary">${escapeHtml(secondaryText)}</span>
                                    </span>
                                </button>
                            `;
                        }).join('');

                        dropdown.hidden = false;
                        addressInput.setAttribute('aria-expanded', 'true');

                        Array.from(dropdown.querySelectorAll('.location-picker-option')).forEach(function (button) {
                            button.addEventListener('mousedown', function (event) {
                                event.preventDefault();
                            });

                            button.addEventListener('click', function () {
                                const index = Number(button.getAttribute('data-index'));

                                if (! Number.isNaN(index) && predictions[index]) {
                                    selectPrediction(predictions[index]);
                                }
                            });
                        });
                    };

                    const fetchPredictions = function (query) {
                        if (query.length < 3) {
                            predictions = [];
                            hideDropdown();

                            if (statusNode) {
                                statusNode.textContent = 'Keep typing to search for a street, building, or area from Google Maps.';
                            }

                            return;
                        }

                        autocompleteService.getPlacePredictions({
                            input: query,
                            componentRestrictions: { country: 'ke' },
                        }, function (results, status) {
                            if (status === window.google.maps.places.PlacesServiceStatus.ZERO_RESULTS) {
                                predictions = [];
                                renderEmptyState('No Google Maps locations matched that search yet.');
                                return;
                            }

                            if (status !== window.google.maps.places.PlacesServiceStatus.OK || ! results) {
                                predictions = [];
                                renderEmptyState('Keep typing to search for a street, building, or area from Google Maps.');
                                return;
                            }

                            predictions = results.slice(0, 5);
                            activeIndex = 0;
                            renderPredictions();
                        });
                    };

                    if (statusNode) {
                        statusNode.textContent = 'Start typing and select an address from Google Maps suggestions to fill the street address, city, and neighborhood faster.';
                    }

                    addressInput.addEventListener('input', function () {
                        updateClearButton();
                        window.clearTimeout(debounceTimer);
                        debounceTimer = window.setTimeout(function () {
                            fetchPredictions(addressInput.value.trim());
                        }, 160);
                    });

                    addressInput.addEventListener('focus', function () {
                        if (addressInput.value.trim().length >= 3) {
                            fetchPredictions(addressInput.value.trim());
                        }
                    });

                    addressInput.addEventListener('keydown', function (event) {
                        if (dropdown.hidden || predictions.length === 0) {
                            return;
                        }

                        if (event.key === 'ArrowDown') {
                            event.preventDefault();
                            activeIndex = (activeIndex + 1) % predictions.length;
                            renderPredictions();
                            return;
                        }

                        if (event.key === 'ArrowUp') {
                            event.preventDefault();
                            activeIndex = (activeIndex - 1 + predictions.length) % predictions.length;
                            renderPredictions();
                            return;
                        }

                        if (event.key === 'Enter' && activeIndex >= 0 && predictions[activeIndex]) {
                            event.preventDefault();
                            selectPrediction(predictions[activeIndex]);
                            return;
                        }

                        if (event.key === 'Escape') {
                            hideDropdown();
                        }
                    });

                    document.addEventListener('click', function (event) {
                        if (! dropdown.contains(event.target) && event.target !== addressInput && event.target !== clearButton) {
                            hideDropdown();
                        }
                    });

                    if (clearButton) {
                        clearButton.addEventListener('click', function () {
                            addressInput.value = '';
                            predictions = [];
                            updateClearButton();
                            hideDropdown();

                            if (statusNode) {
                                statusNode.textContent = 'Start typing and select an address from Google Maps suggestions to fill the street address, city, and neighborhood faster.';
                            }

                            addressInput.focus();
                        });
                    }

                    updateClearButton();
                };
            </script>
            <script
                async
                defer
                src="https://maps.googleapis.com/maps/api/js?key={{ rawurlencode($googleMapsApiKey) }}&libraries=places&callback=initBusinessProfileAddressPicker"
            ></script>
        @endif
    </body>
</html>
