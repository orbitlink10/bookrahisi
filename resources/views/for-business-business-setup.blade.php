<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Book Rahisi For Professionals | Business Setup</title>
        <meta
            name="description"
            content="Continue your Book Rahisi business setup."
        >
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700,800|manrope:400,500,600,700,800" rel="stylesheet" />
        <style>
            :root {
                --ink: #111317;
                --muted: #69707d;
                --line: #dde1e8;
                --soft: #f5f7fb;
                --dark: #0f1012;
                --accent: #6956ff;
                --success: #107c41;
                --success-soft: #eef9f2;
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

            .setup-layout {
                display: grid;
                grid-template-columns: minmax(0, 0.64fr) minmax(380px, 0.36fr);
                min-height: 100vh;
            }

            .setup-main {
                display: flex;
                justify-content: center;
                padding: 56px 24px;
            }

            .setup-card {
                width: min(100%, 760px);
            }

            .step-label {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                padding: 10px 14px;
                border-radius: 999px;
                background: var(--soft);
                color: var(--accent);
                font-size: 0.88rem;
                font-weight: 800;
            }

            h1 {
                margin: 20px 0 0;
                font-family: 'Outfit', sans-serif;
                font-size: clamp(2.4rem, 4vw, 3.5rem);
                line-height: 1;
                letter-spacing: -0.06em;
            }

            .subtitle {
                margin: 18px 0 28px;
                color: var(--muted);
                font-size: 1.04rem;
                line-height: 1.75;
            }

            .status-banner {
                display: grid;
                gap: 8px;
                margin-bottom: 28px;
                padding: 18px 20px;
                border-radius: 18px;
                background: var(--success-soft);
                color: var(--success);
            }

            .status-banner strong {
                font-size: 1rem;
            }

            .content-grid {
                display: grid;
                grid-template-columns: minmax(0, 1.1fr) minmax(280px, 0.9fr);
                gap: 22px;
            }

            .panel {
                padding: 26px;
                border: 1px solid var(--line);
                border-radius: 24px;
                background: #fff;
            }

            .panel h2 {
                margin: 0 0 18px;
                font-family: 'Outfit', sans-serif;
                font-size: 1.45rem;
                letter-spacing: -0.04em;
            }

            .summary-list,
            .checklist {
                display: grid;
                gap: 16px;
            }

            .summary-row {
                display: grid;
                gap: 6px;
                padding-bottom: 16px;
                border-bottom: 1px solid #edf0f4;
            }

            .summary-row:last-child {
                padding-bottom: 0;
                border-bottom: 0;
            }

            .summary-label {
                color: var(--muted);
                font-size: 0.84rem;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.08em;
            }

            .summary-value {
                font-size: 1rem;
                font-weight: 800;
            }

            .check-item {
                display: grid;
                grid-template-columns: 28px minmax(0, 1fr);
                gap: 14px;
                align-items: start;
            }

            .check-icon {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 28px;
                height: 28px;
                border-radius: 50%;
                background: var(--soft);
                color: var(--accent);
                font-weight: 800;
            }

            .check-text {
                color: var(--muted);
                line-height: 1.65;
            }

            .actions {
                display: flex;
                flex-wrap: wrap;
                gap: 14px;
                margin-top: 30px;
            }

            .button-primary,
            .button-secondary {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                min-width: 220px;
                padding: 18px 24px;
                border-radius: 999px;
                font-size: 0.98rem;
                font-weight: 800;
            }

            .button-primary {
                background: var(--dark);
                color: #fff;
            }

            .button-secondary {
                border: 1px solid var(--line);
                background: #fff;
                color: var(--ink);
            }

            .setup-side {
                background-image:
                    linear-gradient(180deg, rgba(255, 255, 255, 0.08) 0%, rgba(17, 19, 23, 0.28) 100%),
                    url('{{ $sideImage }}');
                background-position: center;
                background-size: cover;
                background-repeat: no-repeat;
            }

            @media (max-width: 1040px) {
                .content-grid {
                    grid-template-columns: 1fr;
                }
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
                    padding: 30px 18px 40px;
                }

                .panel {
                    padding: 22px;
                    border-radius: 20px;
                }

                .actions {
                    flex-direction: column;
                }

                .button-primary,
                .button-secondary {
                    width: 100%;
                    min-width: 0;
                }
            }
        </style>
    </head>
    <body>
        <main class="setup-layout">
            <section class="setup-main">
                <div class="setup-card">
                    <span class="step-label">Step 3 of 3</span>
                    <h1>Business setup started</h1>
                    <p class="subtitle">
                        Your core account details are saved. Continue building your public profile, service menu, staff roster, and booking rules from here.
                    </p>

                    <div class="status-banner">
                        <strong>{{ $accountSetup['business_name'] }} is ready for setup.</strong>
                        <span>Use the next steps below to finish your Book Rahisi business profile.</span>
                    </div>

                    <div class="content-grid">
                        <section class="panel">
                            <h2>Account summary</h2>
                            <div class="summary-list">
                                <div class="summary-row">
                                    <span class="summary-label">Owner</span>
                                    <span class="summary-value">{{ $accountSetup['first_name'] }} {{ $accountSetup['last_name'] }}</span>
                                </div>
                                <div class="summary-row">
                                    <span class="summary-label">Business name</span>
                                    <span class="summary-value">{{ $accountSetup['business_name'] }}</span>
                                </div>
                                <div class="summary-row">
                                    <span class="summary-label">Email address</span>
                                    <span class="summary-value">{{ $email }}</span>
                                </div>
                                <div class="summary-row">
                                    <span class="summary-label">Phone number</span>
                                    <span class="summary-value">{{ $accountSetup['phone'] }}</span>
                                </div>
                                <div class="summary-row">
                                    <span class="summary-label">Category</span>
                                    <span class="summary-value">{{ $accountSetup['business_category'] }}</span>
                                </div>
                            </div>
                        </section>

                        <section class="panel">
                            <h2>Next setup tasks</h2>
                            <div class="checklist">
                                @foreach ($nextSteps as $step)
                                    <div class="check-item">
                                        <span class="check-icon">{{ $loop->iteration }}</span>
                                        <span class="check-text">{{ $step }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    </div>

                    <div class="actions">
                        <a class="button-primary" href="{{ route('for-business.tools') }}">Go to business tools</a>
                        <a class="button-secondary" href="{{ route('for-business.account-setup') }}">Edit account details</a>
                    </div>
                </div>
            </section>

            <aside class="setup-side" aria-hidden="true"></aside>
        </main>
    </body>
</html>
