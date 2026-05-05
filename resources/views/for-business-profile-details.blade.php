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

                .button-dark,
                .button-light,
                .hero-actions .button-dark,
                .hero-actions .button-light {
                    width: 100%;
                }
            }
        </style>
    </head>
    <body>
        @php
            $profileReady = is_array($profileDetails) && $profileDetails !== [];
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

                            <form action="{{ route('for-business.profile-details.submit') }}" method="post">
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
                                        <input
                                            class="field-input @error('address_line') field-error-state @enderror"
                                            id="address-line"
                                            name="address_line"
                                            type="text"
                                            placeholder="Ngong Road, Prestige Plaza"
                                            value="{{ old('address_line', $profileDetails['address_line'] ?? '') }}"
                                        >
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
                                <div class="preview-image"></div>
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
    </body>
</html>
