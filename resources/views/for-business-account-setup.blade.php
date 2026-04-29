<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Book Rahisi For Professionals | Account Setup</title>
        <meta
            name="description"
            content="Complete your business account setup on Book Rahisi."
        >
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700,800|manrope:400,500,600,700,800" rel="stylesheet" />
        <style>
            :root {
                --ink: #111317;
                --muted: #707786;
                --line: #dcdfe5;
                --focus: #6956ff;
                --surface: #ffffff;
                --dark: #0f1012;
                --soft: #f6f7fb;
                --danger: #d93025;
                --danger-soft: #fff2f1;
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                min-height: 100vh;
                background: #fff;
                color: var(--ink);
                font-family: 'Manrope', sans-serif;
            }

            a {
                color: inherit;
                text-decoration: none;
            }

            button,
            input,
            select {
                font: inherit;
            }

            .setup-layout {
                display: grid;
                grid-template-columns: minmax(0, 0.66fr) minmax(380px, 0.34fr);
                min-height: 100vh;
            }

            .setup-main {
                position: relative;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 44px 24px;
                background: #fff;
            }

            .back-link {
                position: absolute;
                top: 34px;
                left: 24px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 48px;
                height: 48px;
                color: var(--ink);
            }

            .back-link svg {
                width: 30px;
                height: 30px;
            }

            .setup-card {
                width: min(100%, 720px);
            }

            .step-label {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                margin-bottom: 18px;
                padding: 10px 14px;
                border-radius: 999px;
                background: var(--soft);
                color: var(--focus);
                font-size: 0.88rem;
                font-weight: 800;
            }

            .setup-card h1 {
                margin: 0;
                font-family: 'Outfit', sans-serif;
                font-size: clamp(2.5rem, 4vw, 3.6rem);
                line-height: 1;
                letter-spacing: -0.06em;
            }

            .setup-subtitle {
                margin: 18px 0 36px;
                color: var(--muted);
                font-size: 1.06rem;
                line-height: 1.75;
            }

            .setup-form {
                display: grid;
                gap: 20px;
            }

            .setup-grid {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 18px;
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
            .field-select {
                width: 100%;
                height: 68px;
                padding: 0 20px;
                border: 1px solid var(--line);
                border-radius: 16px;
                outline: none;
                background: #fff;
                color: var(--ink);
                font-size: 1rem;
                transition: border-color 0.2s ease, box-shadow 0.2s ease;
            }

            .field-input:focus,
            .field-select:focus {
                border-color: var(--focus);
                box-shadow: 0 0 0 4px rgba(105, 86, 255, 0.08);
            }

            .field-input-readonly {
                background: var(--soft);
                color: #545b67;
            }

            .field-input-error,
            .field-select-error {
                border-color: var(--danger);
                background: var(--danger-soft);
            }

            .field-error {
                color: var(--danger);
                font-size: 0.88rem;
                font-weight: 700;
            }

            .error-summary {
                padding: 14px 16px;
                border: 1px solid rgba(217, 48, 37, 0.18);
                border-radius: 16px;
                background: var(--danger-soft);
                color: var(--danger);
                font-size: 0.94rem;
                font-weight: 700;
            }

            .helper-text {
                margin: 0;
                color: var(--muted);
                font-size: 0.94rem;
                line-height: 1.7;
            }

            .continue-button {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                min-width: 320px;
                padding: 20px 28px;
                border: 0;
                border-radius: 999px;
                background: var(--dark);
                color: #fff;
                font-size: 1rem;
                font-weight: 800;
                cursor: pointer;
            }

            .continue-button:hover {
                opacity: 0.96;
            }

            .setup-side {
                background-image:
                    linear-gradient(180deg, rgba(255, 255, 255, 0.05) 0%, rgba(17, 19, 23, 0.26) 100%),
                    url('{{ $sideImage }}');
                background-position: center;
                background-size: cover;
                background-repeat: no-repeat;
            }

            @media (max-width: 980px) {
                .setup-layout {
                    grid-template-columns: 1fr;
                }

                .setup-side {
                    display: none;
                }
            }

            @media (max-width: 680px) {
                .setup-main {
                    padding: 28px 18px 34px;
                }

                .back-link {
                    top: 22px;
                    left: 10px;
                }

                .setup-card {
                    padding-top: 28px;
                }

                .setup-grid {
                    grid-template-columns: 1fr;
                }

                .continue-button {
                    width: 100%;
                    min-width: 0;
                }
            }
        </style>
    </head>
    <body>
        <main class="setup-layout">
            <section class="setup-main">
                <a class="back-link" href="{{ route('for-business.sign-in') }}" aria-label="Back to sign in">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M19 12H5"></path>
                        <path d="m12 19-7-7 7-7"></path>
                    </svg>
                </a>

                <div class="setup-card">
                    <span class="step-label">Step 2 of 3</span>
                    <h1>Set up your business account</h1>
                    <p class="setup-subtitle">
                        We have saved your email. Add the core account details below so Book Rahisi can continue into business profile setup.
                    </p>

                    <form class="setup-form" action="{{ route('for-business.account-setup.submit') }}" method="post">
                        @csrf

                        @if ($errors->any())
                            <div class="error-summary">
                                Complete the highlighted fields before continuing.
                            </div>
                        @endif

                        <div class="setup-grid">
                            <div class="field-group field-group-full">
                                <label class="field-label" for="setup-email">Email address</label>
                                <input class="field-input field-input-readonly" id="setup-email" type="email" value="{{ $email }}" readonly>
                            </div>

                            <div class="field-group">
                                <label class="field-label" for="first-name">First name</label>
                                <input
                                    class="field-input @error('first_name') field-input-error @enderror"
                                    id="first-name"
                                    name="first_name"
                                    type="text"
                                    placeholder="First name"
                                    value="{{ old('first_name', $accountSetup['first_name'] ?? '') }}"
                                >
                                @error('first_name')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="field-group">
                                <label class="field-label" for="last-name">Last name</label>
                                <input
                                    class="field-input @error('last_name') field-input-error @enderror"
                                    id="last-name"
                                    name="last_name"
                                    type="text"
                                    placeholder="Last name"
                                    value="{{ old('last_name', $accountSetup['last_name'] ?? '') }}"
                                >
                                @error('last_name')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="field-group field-group-full">
                                <label class="field-label" for="business-name">Business name</label>
                                <input
                                    class="field-input @error('business_name') field-input-error @enderror"
                                    id="business-name"
                                    name="business_name"
                                    type="text"
                                    placeholder="Your salon, spa, studio, or clinic name"
                                    value="{{ old('business_name', $accountSetup['business_name'] ?? '') }}"
                                >
                                @error('business_name')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="field-group">
                                <label class="field-label" for="phone-number">Phone number</label>
                                <input
                                    class="field-input @error('phone') field-input-error @enderror"
                                    id="phone-number"
                                    name="phone"
                                    type="tel"
                                    placeholder="+254 7xx xxx xxx"
                                    value="{{ old('phone', $accountSetup['phone'] ?? '') }}"
                                >
                                @error('phone')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="field-group">
                                <label class="field-label" for="business-category">Business category</label>
                                <select
                                    class="field-select @error('business_category') field-select-error @enderror"
                                    id="business-category"
                                    name="business_category"
                                >
                                    <option value="" disabled {{ old('business_category', $accountSetup['business_category'] ?? '') === '' ? 'selected' : '' }}>
                                        Select a category
                                    </option>
                                    @foreach ($businessCategories as $businessCategory)
                                        <option value="{{ $businessCategory }}" {{ old('business_category', $accountSetup['business_category'] ?? '') === $businessCategory ? 'selected' : '' }}>
                                            {{ $businessCategory }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('business_category')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <p class="helper-text">
                            Next, you can add services, staff, operating hours, and public booking details for your business profile.
                        </p>

                        <button class="continue-button" type="submit">Continue to business setup</button>
                    </form>
                </div>
            </section>

            <aside class="setup-side" aria-hidden="true"></aside>
        </main>
    </body>
</html>
