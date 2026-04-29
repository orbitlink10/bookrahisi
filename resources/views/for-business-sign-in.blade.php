<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Book Rahisi For Professionals | Sign In</title>
        <meta
            name="description"
            content="Create an account or log in to manage your business on Book Rahisi."
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
            input {
                font: inherit;
            }

            .auth-layout {
                display: grid;
                grid-template-columns: minmax(0, 0.66fr) minmax(380px, 0.34fr);
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
                width: min(100%, 632px);
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
                margin: 16px 0 58px;
                text-align: center;
                color: var(--muted);
                font-size: 1.1rem;
                line-height: 1.7;
            }

            .email-input {
                width: 100%;
                height: 74px;
                padding: 0 22px;
                border: 1.5px solid var(--focus);
                border-radius: 16px;
                outline: none;
                font-size: 1rem;
                color: var(--ink);
            }

            .email-input.input-error {
                border-color: #df3d5a;
            }

            .email-input::placeholder {
                color: #b1b5bf;
            }

            .field-error {
                margin-top: 10px;
                color: #df3d5a;
                font-size: 0.92rem;
                font-weight: 700;
            }

            .continue-button {
                width: 100%;
                margin-top: 28px;
                height: 72px;
                border: 0;
                border-radius: 999px;
                background: var(--dark);
                color: #fff;
                font-size: 1.02rem;
                font-weight: 800;
                cursor: pointer;
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

            @media (max-width: 640px) {
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

                .auth-subtitle {
                    margin-bottom: 34px;
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
                    <h1>Book Rahisi for professionals</h1>
                    <p class="auth-subtitle">Create an account or log in to manage your business.</p>

                    <form action="{{ route('for-business.sign-in.submit') }}" method="post" novalidate>
                        @csrf
                        <input
                            class="email-input @error('email') input-error @enderror"
                            type="email"
                            name="email"
                            placeholder="Enter your email address"
                            aria-label="Enter your email address"
                            value="{{ old('email') }}"
                        >
                        @error('email')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                        <button class="continue-button" type="submit">Continue</button>
                    </form>

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
                        <a href="{{ route('home') }}">Go to Book Rahisi for customers</a>
                    </div>
                </div>
            </section>

            <aside class="auth-side" aria-hidden="true"></aside>
        </main>
    </body>
</html>
