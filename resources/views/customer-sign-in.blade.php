<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Book Rahisi Customer | Sign In</title>
        <meta
            name="description"
            content="Sign in to your Book Rahisi customer account to manage appointments, payments, and reviews."
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
                grid-template-columns: minmax(0, 0.7fr) minmax(360px, 0.3fr);
                min-height: 100vh;
            }

            .auth-main {
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 36px 24px;
            }

            .auth-card {
                width: min(100%, 620px);
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
                font-size: clamp(2.4rem, 4vw, 3.7rem);
                letter-spacing: -0.06em;
                line-height: 0.98;
            }

            .subtitle {
                margin: 16px 0 0;
                color: var(--muted);
                font-size: 1rem;
                line-height: 1.75;
            }

            .field-group {
                display: grid;
                gap: 10px;
                margin-top: 22px;
            }

            .field-label {
                font-size: 0.92rem;
                font-weight: 800;
            }

            .field-input {
                width: 100%;
                min-height: 62px;
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
                    linear-gradient(180deg, rgba(23, 52, 93, 0.22) 0%, rgba(17, 39, 68, 0.56) 100%),
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
                    <span class="eyebrow">Customer sign in</span>
                    <h1>Welcome back to Book Rahisi</h1>
                    <p class="subtitle">
                        Sign in to search approved businesses, manage appointments, track payment status, and publish reviews after completed visits.
                    </p>

                    <form action="{{ route('customer.sign-in.submit') }}" method="post" novalidate>
                        @csrf

                        @if ($errors->any())
                            <div class="error-summary">Check the customer credentials and try again.</div>
                        @endif

                        <div class="field-group">
                            <label class="field-label" for="email">Email</label>
                            <input class="field-input @error('email') field-error-state @enderror" id="email" type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com">
                            @error('email')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field-group">
                            <label class="field-label" for="password">Password</label>
                            <input class="field-input @error('password') field-error-state @enderror" id="password" type="password" name="password" placeholder="Enter your password">
                            @error('password')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="actions">
                            <button class="button-dark" type="submit">Open customer dashboard</button>
                            <a class="button-light" href="{{ route('customer.register') }}">Create new account</a>
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
