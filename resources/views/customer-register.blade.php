<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Book Rahisi Customer | Create Account</title>
        <meta
            name="description"
            content="Create a Book Rahisi customer account to search businesses, book appointments, track payments, and manage reviews."
        >
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700,800|manrope:400,500,600,700,800" rel="stylesheet" />
        <style>
            :root {
                --navy: #17345d;
                --line: #d8e3ef;
                --page: #eef5fb;
                --ink: #17304d;
                --muted: #607792;
                --accent: #1aa0e2;
                --danger: #c24b3a;
                --danger-soft: #fff0ee;
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

            input,
            button {
                font: inherit;
            }

            .auth-layout {
                display: grid;
                grid-template-columns: minmax(0, 0.68fr) minmax(360px, 0.32fr);
                min-height: 100vh;
            }

            .auth-main {
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 36px 24px;
            }

            .auth-card {
                width: min(100%, 720px);
                padding: 34px;
                border: 1px solid var(--line);
                border-radius: 28px;
                background: rgba(255, 255, 255, 0.94);
                box-shadow: 0 24px 44px rgba(28, 66, 104, 0.12);
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
                margin: 20px 0 0;
                font-family: 'Outfit', sans-serif;
                font-size: clamp(2.3rem, 4vw, 3.7rem);
                letter-spacing: -0.06em;
                line-height: 0.98;
            }

            .subtitle {
                margin: 16px 0 0;
                color: var(--muted);
                font-size: 1rem;
                line-height: 1.75;
            }

            .field-grid {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 18px;
                margin-top: 24px;
            }

            .field-group {
                display: grid;
                gap: 10px;
            }

            .field-group.is-full {
                grid-column: 1 / -1;
            }

            .field-label {
                font-size: 0.92rem;
                font-weight: 800;
            }

            .field-input {
                width: 100%;
                min-height: 60px;
                padding: 0 18px;
                border: 1px solid var(--line);
                border-radius: 18px;
                outline: none;
                background: #fff;
                color: var(--ink);
                font-size: 0.98rem;
            }

            .field-input:focus {
                border-color: var(--accent);
                box-shadow: 0 0 0 4px rgba(26, 160, 226, 0.08);
            }

            .field-error-state {
                border-color: var(--danger);
                background: var(--danger-soft);
            }

            .field-error,
            .error-summary {
                color: var(--danger);
                font-size: 0.9rem;
                font-weight: 700;
            }

            .error-summary {
                margin-top: 22px;
                padding: 14px 16px;
                border: 1px solid rgba(194, 75, 58, 0.18);
                border-radius: 18px;
                background: var(--danger-soft);
            }

            .actions {
                display: flex;
                flex-wrap: wrap;
                gap: 12px;
                margin-top: 28px;
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

            .support-copy {
                margin-top: 18px;
                color: var(--muted);
                line-height: 1.65;
            }

            .support-copy a {
                color: var(--accent);
                font-weight: 800;
            }

            .auth-side {
                background-image:
                    linear-gradient(180deg, rgba(23, 52, 93, 0.2) 0%, rgba(17, 39, 68, 0.52) 100%),
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
                    padding: 18px 16px 24px;
                }

                .auth-card {
                    padding: 24px 20px;
                }

                .field-grid {
                    grid-template-columns: 1fr;
                }

                .actions {
                    flex-direction: column;
                }

                .button-dark,
                .button-light {
                    width: 100%;
                }
            }
        </style>
    </head>
    <body>
        <main class="auth-layout">
            <section class="auth-main">
                <div class="auth-card">
                    <span class="eyebrow">Customer account setup</span>
                    <h1>Create your Book Rahisi account</h1>
                    <p class="subtitle">
                        Register once, then search approved salons, spas, and fitness businesses, manage appointments, track payment status, and leave reviews from one place.
                    </p>

                    <form action="{{ route('customer.register.submit') }}" method="post" novalidate>
                        @csrf

                        @if ($errors->any())
                            <div class="error-summary">Complete the highlighted account details before continuing.</div>
                        @endif

                        <div class="field-grid">
                            <div class="field-group is-full">
                                <label class="field-label" for="name">Name</label>
                                <input class="field-input @error('name') field-error-state @enderror" id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Enter your full name">
                                @error('name')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="field-group">
                                <label class="field-label" for="email">Email</label>
                                <input class="field-input @error('email') field-error-state @enderror" id="email" type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com">
                                @error('email')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="field-group">
                                <label class="field-label" for="phone_number">Phone Number</label>
                                <input class="field-input @error('phone_number') field-error-state @enderror" id="phone_number" type="text" name="phone_number" value="{{ old('phone_number') }}" placeholder="+254 7xx xxx xxx">
                                @error('phone_number')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="field-group">
                                <label class="field-label" for="password">Password</label>
                                <input class="field-input @error('password') field-error-state @enderror" id="password" type="password" name="password" placeholder="Create a secure password">
                                @error('password')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="field-group">
                                <label class="field-label" for="password_confirmation">Confirm Password</label>
                                <input class="field-input" id="password_confirmation" type="password" name="password_confirmation" placeholder="Repeat your password">
                            </div>
                        </div>

                        <div class="actions">
                            <button class="button-dark" type="submit">Create customer account</button>
                            <a class="button-light" href="{{ route('customer.sign-in') }}">Already have an account?</a>
                        </div>
                    </form>

                    <div class="support-copy">
                        Business owner?
                        <a href="{{ route('for-business.sign-in') }}">Use the business sign-in flow</a>.
                    </div>
                </div>
            </section>

            <aside class="auth-side" aria-hidden="true"></aside>
        </main>
    </body>
</html>
