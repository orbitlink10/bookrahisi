<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Book Rahisi For Professionals | Get Started</title>
        <meta
            name="description"
            content="Create a business owner account or continue into your existing Book Rahisi workspace."
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
                --soft: #f6f7fb;
                --dark: #0f1012;
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

            .auth-layout {
                display: grid;
                grid-template-columns: minmax(0, 0.68fr) minmax(380px, 0.32fr);
                min-height: 100vh;
            }

            .auth-main {
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

            .auth-card {
                width: min(100%, 760px);
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

            .auth-card h1 {
                margin: 0;
                text-align: center;
                font-family: 'Outfit', sans-serif;
                font-size: clamp(2.35rem, 4vw, 3.4rem);
                line-height: 1;
                letter-spacing: -0.06em;
            }

            .auth-subtitle {
                margin: 16px auto 36px;
                max-width: 700px;
                text-align: center;
                color: var(--muted);
                font-size: 1.05rem;
                line-height: 1.75;
            }

            .signup-panel,
            .returning-panel {
                border: 1px solid var(--line);
                border-radius: 28px;
                background: var(--surface);
                box-shadow: 0 20px 42px rgba(17, 19, 23, 0.05);
            }

            .signup-panel {
                padding: 28px;
            }

            .returning-panel {
                margin-top: 22px;
                padding: 24px 28px 28px;
            }

            .panel-title {
                margin: 0;
                font-family: 'Outfit', sans-serif;
                font-size: 1.9rem;
                line-height: 1.05;
                letter-spacing: -0.05em;
            }

            .panel-copy {
                margin: 12px 0 0;
                color: var(--muted);
                line-height: 1.75;
            }

            .setup-grid {
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
            .field-select {
                width: 100%;
                min-height: 64px;
                padding: 0 20px;
                border: 1px solid var(--line);
                border-radius: 16px;
                outline: none;
                background: #fff;
                color: var(--ink);
                font-size: 1rem;
                transition: border-color 0.2s ease, box-shadow 0.2s ease;
            }

            .field-select {
                appearance: none;
            }

            .field-input:focus,
            .field-select:focus {
                border-color: var(--focus);
                box-shadow: 0 0 0 4px rgba(105, 86, 255, 0.08);
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
                margin-bottom: 20px;
                padding: 14px 16px;
                border: 1px solid rgba(217, 48, 37, 0.18);
                border-radius: 16px;
                background: var(--danger-soft);
                color: var(--danger);
                font-size: 0.94rem;
                font-weight: 700;
            }

            .helper-text {
                margin: 18px 0 0;
                color: var(--muted);
                font-size: 0.94rem;
                line-height: 1.75;
            }

            .primary-button,
            .continue-button {
                border: 0;
                background: var(--dark);
                color: #fff;
                font-weight: 800;
                cursor: pointer;
            }

            .primary-button {
                width: 100%;
                margin-top: 26px;
                min-height: 70px;
                border-radius: 999px;
                font-size: 1rem;
            }

            .returning-form {
                display: grid;
                grid-template-columns: minmax(0, 1fr) 180px;
                gap: 14px;
                margin-top: 20px;
            }

            .continue-button {
                min-height: 64px;
                border-radius: 16px;
                font-size: 0.98rem;
            }

            .divider {
                display: grid;
                grid-template-columns: 1fr auto 1fr;
                align-items: center;
                gap: 22px;
                margin: 34px 0 28px;
                color: var(--muted);
                font-size: 0.96rem;
                font-weight: 700;
            }

            .divider::before,
            .divider::after {
                content: '';
                height: 1px;
                background: var(--line);
            }

            .social-list {
                display: grid;
                gap: 14px;
            }

            .social-button {
                display: grid;
                grid-template-columns: 60px 1fr;
                align-items: center;
                width: 100%;
                min-height: 72px;
                padding: 0 22px;
                border: 1px solid var(--line);
                border-radius: 999px;
                background: var(--surface);
                color: var(--ink);
                font-size: 0.98rem;
                font-weight: 800;
                text-align: left;
            }

            .social-icon {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 34px;
                height: 34px;
                border-radius: 999px;
                font-family: 'Outfit', sans-serif;
                font-size: 1.3rem;
                font-weight: 800;
            }

            .social-icon-facebook {
                background: #1877f2;
                color: #fff;
            }

            .social-icon-google {
                color: #4285f4;
                border: 1px solid rgba(66, 133, 244, 0.18);
            }

            .social-icon-apple {
                color: #000;
            }

            .customer-panel {
                margin-top: 34px;
                padding-top: 34px;
                border-top: 1px solid var(--line);
                text-align: center;
            }

            .customer-panel strong {
                display: block;
                margin-bottom: 10px;
                font-family: 'Outfit', sans-serif;
                font-size: 1.8rem;
                line-height: 1.12;
                letter-spacing: -0.05em;
            }

            .customer-panel a {
                color: var(--focus);
                font-size: 1rem;
                font-weight: 700;
            }

            .auth-side {
                background-image:
                    linear-gradient(180deg, rgba(255, 249, 238, 0.1) 0%, rgba(255, 249, 238, 0.12) 100%),
                    url('{{ $sideImage }}');
                background-position: center;
                background-size: cover;
                background-repeat: no-repeat;
            }

            @media (max-width: 980px) {
                .auth-layout {
                    grid-template-columns: 1fr;
                }

                .auth-side {
                    display: none;
                }
            }

            @media (max-width: 760px) {
                .auth-main {
                    padding: 28px 18px 34px;
                }

                .back-link {
                    top: 22px;
                    left: 10px;
                }

                .auth-card {
                    padding-top: 28px;
                }

                .setup-grid,
                .returning-form {
                    grid-template-columns: 1fr;
                }

                .social-button {
                    grid-template-columns: 44px 1fr;
                    padding-inline: 16px;
                }

                .customer-panel strong {
                    font-size: 1.6rem;
                }
            }
        </style>
    </head>
    <body>
        <main class="auth-layout">
            <section class="auth-main">
                <a class="back-link" href="{{ route('for-business') }}" aria-label="Back to Book Rahisi for Business">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M19 12H5"></path>
                        <path d="m12 19-7-7 7-7"></path>
                    </svg>
                </a>

                <div class="auth-card">
                    <span class="step-label">Business owner onboarding</span>
                    <h1>Book Rahisi for professionals</h1>
                    <p class="auth-subtitle">
                        Start with your owner details below. Once this step is complete, you can continue into business setup, publish your profile, and open bookings.
                    </p>

                    <section class="signup-panel" aria-labelledby="owner-signup-title">
                        <h2 class="panel-title" id="owner-signup-title">Create your business account</h2>
                        <p class="panel-copy">This is the form business owners complete after clicking Get Started.</p>

                        <form action="{{ route('for-business.sign-in.submit') }}" method="post" novalidate>
                            @csrf
                            <input type="hidden" name="intent" value="register">

                            @if ($errors->any() && old('intent', 'register') === 'register')
                                <div class="error-summary">
                                    Complete the highlighted fields before continuing.
                                </div>
                            @endif

                            <div class="setup-grid">
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
                                    <label class="field-label" for="owner-email">Email address</label>
                                    <input
                                        class="field-input {{ $errors->has('email') && old('intent', 'register') === 'register' ? 'field-input-error' : '' }}"
                                        id="owner-email"
                                        name="email"
                                        type="email"
                                        placeholder="owner@business.com"
                                        value="{{ old('email', session('business_signup_email')) }}"
                                    >
                                    @if ($errors->has('email') && old('intent', 'register') === 'register')
                                        <span class="field-error">{{ $errors->first('email') }}</span>
                                    @endif
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

                                <div class="field-group field-group-full">
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

                                <div class="field-group">
                                    <label class="field-label" for="owner-password">Password</label>
                                    <input
                                        class="field-input @error('password') field-input-error @enderror"
                                        id="owner-password"
                                        name="password"
                                        type="password"
                                        placeholder="Create a secure password"
                                    >
                                    @error('password')
                                        @if (old('intent', 'register') === 'register')
                                            <span class="field-error">{{ $message }}</span>
                                        @endif
                                    @enderror
                                </div>

                                <div class="field-group">
                                    <label class="field-label" for="owner-password-confirmation">Confirm Password</label>
                                    <input
                                        class="field-input"
                                        id="owner-password-confirmation"
                                        name="password_confirmation"
                                        type="password"
                                        placeholder="Repeat your password"
                                    >
                                </div>
                            </div>

                            <p class="helper-text">
                                After this step, you can add services, staff, business hours, and the public booking details customers will see.
                            </p>

                            <button class="primary-button" type="submit">Create business account</button>
                        </form>
                    </section>

                    <section class="returning-panel" aria-labelledby="existing-owner-title">
                        <h2 class="panel-title" id="existing-owner-title">Already on Book Rahisi?</h2>
                        <p class="panel-copy">If your business workspace already exists, continue with your owner email and go straight back into the dashboard.</p>

                        <form class="returning-form" action="{{ route('for-business.sign-in.submit') }}" method="post" novalidate>
                            @csrf
                            <input type="hidden" name="intent" value="continue">
                            <div class="field-group">
                                <label class="field-label" for="existing-email">Email address</label>
                                <input
                                    class="field-input {{ $errors->has('email') && old('intent') === 'continue' ? 'field-input-error' : '' }}"
                                    id="existing-email"
                                    type="email"
                                    name="email"
                                    placeholder="Enter your email address"
                                    value="{{ old('intent') === 'continue' ? old('email') : '' }}"
                                >
                            </div>
                            <div class="field-group">
                                <label class="field-label" for="existing-password">Password</label>
                                <input
                                    class="field-input"
                                    id="existing-password"
                                    type="password"
                                    name="password"
                                    placeholder="Enter your password or leave blank for legacy access"
                                >
                            </div>
                            <button class="continue-button" type="submit">Continue</button>
                        </form>

                        @if ($errors->has('email') && old('intent') === 'continue')
                            <div class="field-error" style="margin-top: 12px;">{{ $errors->first('email') }}</div>
                        @endif
                    </section>

                    <div class="divider">OR</div>

                    <div class="social-list" aria-label="Alternative sign in methods">
                        <button class="social-button" type="button">
                            <span class="social-icon social-icon-facebook">f</span>
                            <span>Continue with Facebook</span>
                        </button>
                        <button class="social-button" type="button">
                            <span class="social-icon social-icon-google">G</span>
                            <span>Continue with Google</span>
                        </button>
                        <button class="social-button" type="button">
                            <span class="social-icon social-icon-apple">A</span>
                            <span>Continue with Apple</span>
                        </button>
                    </div>

                    <div class="customer-panel">
                        <strong>Are you a customer looking to book an appointment?</strong>
                        <a href="{{ route('customer.sign-in') }}">Go to customer sign in</a>
                    </div>
                </div>
            </section>

            <aside class="auth-side" aria-hidden="true"></aside>
        </main>
    </body>
</html>
