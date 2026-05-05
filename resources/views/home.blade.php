@php
    $heroTitle = $hero['title'] ?? 'Book local self-care services';
    $heroSubtitle = $hero['subtitle'] ?? 'Discover top-rated salons, barbers, medspas, wellness studios and beauty experts trusted across Kenya.';
    $featuredDeals = array_slice($dailyDeals, 0, 4);
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Book Rahisi | Beauty, Wellness &amp; Fitness Booking</title>
        <meta
            name="description"
            content="Book Rahisi helps customers find salons, spas, barbershops, and fitness classes across Kenya with fast online booking."
        >
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=manrope:400,500,600,700,800" rel="stylesheet" />
        <style>
            :root {
                --page: #f4f1ea;
                --surface: rgba(255, 255, 255, 0.8);
                --surface-strong: #ffffff;
                --surface-muted: #faf8f4;
                --ink: #121212;
                --muted: #585d68;
                --line: rgba(18, 18, 18, 0.1);
                --line-strong: rgba(18, 18, 18, 0.16);
                --shadow: 0 30px 70px rgba(17, 18, 28, 0.08);
                --hero-ring: rgba(222, 177, 246, 0.85);
                --hero-lilac: #cfcafc;
                --hero-pink: #f7c5ee;
                --hero-blue: #d7ddff;
                --hero-cream: #fff8ef;
                --black: #121212;
            }

            * {
                box-sizing: border-box;
            }

            html {
                scroll-behavior: smooth;
            }

            body {
                margin: 0;
                font-family: 'Manrope', sans-serif;
                color: var(--ink);
                background:
                    radial-gradient(circle at top, rgba(255, 255, 255, 0.92), transparent 34%),
                    linear-gradient(180deg, #f8f5ee 0%, #f3efe7 100%);
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

            .sr-only {
                position: absolute;
                width: 1px;
                height: 1px;
                padding: 0;
                margin: -1px;
                overflow: hidden;
                clip: rect(0, 0, 0, 0);
                white-space: nowrap;
                border: 0;
            }

            .page-shell {
                width: min(100% - 20px, 1840px);
                margin: 0 auto;
            }

            .hero-stage .page-shell {
                width: min(100% - 2px, 1920px);
            }

            .hero-stage {
                padding: 0 0 28px;
            }

            .hero-panel {
                position: relative;
                overflow: hidden;
                min-height: 800px;
                border: 1px solid rgba(18, 18, 18, 0.08);
                border-radius: 0 0 28px 28px;
                background:
                    radial-gradient(circle at 18% 76%, rgba(247, 197, 238, 0.9), transparent 21%),
                    radial-gradient(circle at 48% 22%, rgba(209, 205, 255, 0.94), transparent 30%),
                    radial-gradient(circle at 84% 36%, rgba(218, 222, 255, 0.82), transparent 28%),
                    linear-gradient(135deg, rgba(255, 250, 244, 0.98) 6%, rgba(213, 210, 255, 0.92) 56%, rgba(247, 247, 255, 0.96) 100%);
                box-shadow: 0 22px 48px rgba(17, 18, 28, 0.06);
                isolation: isolate;
            }

            .hero-panel::before,
            .hero-panel::after {
                content: '';
                position: absolute;
                border-radius: 999px;
                filter: blur(18px);
                opacity: 0.58;
                pointer-events: none;
            }

            .hero-panel::before {
                top: 122px;
                left: 17%;
                width: 220px;
                height: 220px;
                background: rgba(255, 255, 255, 0.56);
            }

            .hero-panel::after {
                right: 10%;
                bottom: 72px;
                width: 260px;
                height: 260px;
                background: rgba(255, 255, 255, 0.28);
            }

            .hero-header {
                position: relative;
                z-index: 1;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 20px;
                min-height: 72px;
                padding: 12px 20px 0;
                animation: rise-in 560ms ease both;
            }

            .brand {
                font-family: 'Manrope', sans-serif;
                font-size: 1.95rem;
                font-weight: 800;
                letter-spacing: -0.08em;
                text-transform: lowercase;
            }

            .hero-nav {
                display: flex;
                align-items: center;
                gap: 16px;
            }

            .hero-link {
                font-size: 1rem;
                line-height: 1.375rem;
                font-weight: 700;
            }

            .hero-pill {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 12px;
                min-height: 48px;
                padding: 0 24px;
                border: 1px solid rgba(18, 18, 18, 0.12);
                border-radius: 999px;
                background: rgba(255, 255, 255, 0.82);
                backdrop-filter: blur(18px);
                font-size: 1rem;
                line-height: 1.375rem;
                font-weight: 700;
                transition:
                    transform 180ms ease,
                    background 180ms ease,
                    border-color 180ms ease;
            }

            .hero-pill:hover {
                transform: translateY(-1px);
                background: rgba(255, 255, 255, 0.9);
                border-color: rgba(18, 18, 18, 0.18);
            }

            .menu-icon {
                width: 24px;
                height: 17px;
                display: inline-flex;
                flex-direction: column;
                justify-content: space-between;
            }

            .menu-icon span {
                display: block;
                height: 2px;
                border-radius: 999px;
                background: currentColor;
            }

            .hero-inner {
                position: relative;
                z-index: 1;
                display: grid;
                place-items: center;
                padding: 110px 32px 92px;
                text-align: center;
            }

            .hero-copy {
                width: min(100%, 1136px);
                animation: rise-in 680ms ease both;
            }

            .hero-title {
                margin: 0;
                font-family: 'Manrope', sans-serif;
                max-width: 960px;
                margin-inline: auto;
                font-size: 2.5rem;
                font-weight: 800;
                line-height: 2.75rem;
                letter-spacing: -0.05em;
            }

            .hero-subtitle {
                width: 100%;
                max-width: 1136px;
                margin: 22px auto 0;
                color: rgba(18, 18, 18, 0.84);
                font-size: 1rem;
                line-height: 1.375rem;
                letter-spacing: 0;
            }

            .search-shell {
                display: grid;
                grid-template-columns: minmax(0, 1.08fr) minmax(0, 1.08fr) minmax(0, 0.92fr) auto;
                gap: 0;
                width: 100%;
                margin: 64px auto 0;
                padding: 6px;
                border-radius: 999px;
                background: rgba(255, 255, 255, 0.96);
                border: 1px solid rgba(255, 255, 255, 0.9);
                box-shadow:
                    0 0 0 6px rgba(229, 191, 248, 0.85),
                    0 18px 46px rgba(86, 89, 134, 0.12);
                animation: rise-in 820ms ease both;
            }

            .search-field {
                display: flex;
                align-items: center;
                gap: 15px;
                min-height: 78px;
                padding: 0 24px;
                border-right: 1px solid rgba(18, 18, 18, 0.1);
            }

            .search-field:last-of-type {
                border-right: 0;
            }

            .search-icon {
                flex: 0 0 23px;
                width: 23px;
                height: 23px;
                color: rgba(18, 18, 18, 0.78);
            }

            .search-input,
            .search-select {
                width: 100%;
                border: 0;
                outline: none;
                background: transparent;
                color: var(--ink);
                font-size: 1rem;
                line-height: 1.375rem;
                font-weight: 500;
                appearance: none;
            }

            .search-input::placeholder {
                color: rgba(18, 18, 18, 0.76);
            }

            .search-submit {
                min-width: 138px;
                margin-left: 6px;
                min-height: 66px;
                border: 0;
                border-radius: 999px;
                background: var(--black);
                color: #fff;
                font-size: 1rem;
                line-height: 1.375rem;
                font-weight: 700;
                cursor: pointer;
                transition:
                    transform 180ms ease,
                    box-shadow 180ms ease,
                    background 180ms ease;
            }

            .search-submit:hover {
                transform: translateY(-1px);
                background: #1f1f1f;
                box-shadow: 0 16px 30px rgba(18, 18, 18, 0.18);
            }

            .hero-note {
                margin: 62px 0 0;
                font-size: 1rem;
                line-height: 1.375rem;
                letter-spacing: 0;
                font-weight: 700;
                animation: rise-in 960ms ease both;
            }

            .hero-note strong {
                font-weight: 800;
            }

            .hero-app {
                margin-top: 52px;
                animation: rise-in 1080ms ease both;
            }

            .hero-app-link {
                display: inline-flex;
                align-items: center;
                gap: 14px;
                min-height: 48px;
                padding: 0 24px;
                border-radius: 999px;
                border: 1px solid rgba(18, 18, 18, 0.12);
                background: rgba(255, 255, 255, 0.9);
                box-shadow: 0 10px 24px rgba(74, 68, 124, 0.06);
                font-size: 1rem;
                line-height: 1.375rem;
                font-weight: 700;
                transition:
                    transform 180ms ease,
                    box-shadow 180ms ease;
            }

            .hero-app-link:hover {
                transform: translateY(-1px);
                box-shadow: 0 18px 36px rgba(74, 68, 124, 0.12);
            }

            .qr-icon {
                width: 22px;
                height: 22px;
            }

            .section {
                padding: 0 0 28px;
            }

            .section-card {
                border: 1px solid rgba(18, 18, 18, 0.08);
                border-radius: 32px;
                background: rgba(255, 255, 255, 0.76);
                backdrop-filter: blur(14px);
                box-shadow: 0 16px 42px rgba(17, 18, 28, 0.05);
            }

            .browse-panel {
                display: grid;
                grid-template-columns: minmax(0, 0.95fr) minmax(0, 1.35fr);
                align-items: center;
                gap: 32px;
                padding: 34px;
                margin-bottom: 26px;
            }

            .section-kicker {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                margin-bottom: 12px;
                color: #6f6287;
                font-size: 0.84rem;
                font-weight: 800;
                letter-spacing: 0.12em;
                text-transform: uppercase;
            }

            .section-kicker::before {
                content: '';
                width: 24px;
                height: 1px;
                background: currentColor;
            }

            .section-title {
                margin: 0;
                font-family: 'Manrope', sans-serif;
                font-size: clamp(2rem, 3vw, 3rem);
                line-height: 0.98;
                letter-spacing: -0.06em;
            }

            .section-copy {
                margin: 16px 0 0;
                max-width: 560px;
                color: var(--muted);
                line-height: 1.7;
            }

            .pill-cluster {
                display: flex;
                flex-wrap: wrap;
                gap: 12px;
                justify-content: flex-start;
            }

            .service-pill {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                min-height: 50px;
                padding: 0 20px;
                border-radius: 999px;
                background: linear-gradient(180deg, #ffffff 0%, #f6f2ff 100%);
                border: 1px solid rgba(18, 18, 18, 0.08);
                font-weight: 800;
                box-shadow: 0 10px 24px rgba(17, 18, 28, 0.04);
            }

            .section-head {
                display: flex;
                align-items: end;
                justify-content: space-between;
                gap: 24px;
                margin-bottom: 22px;
            }

            .section-link {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                font-size: 0.95rem;
                font-weight: 800;
            }

            .section-link svg {
                width: 16px;
                height: 16px;
            }

            .business-grid {
                display: grid;
                grid-template-columns: repeat(5, minmax(0, 1fr));
                gap: 18px;
            }

            .business-card {
                display: block;
                overflow: hidden;
                transition:
                    transform 200ms ease,
                    box-shadow 200ms ease;
            }

            .business-card:hover,
            .offer-card:hover,
            .business-cta-card:hover {
                transform: translateY(-2px);
            }

            .business-card:focus-visible {
                outline: 3px solid rgba(111, 98, 135, 0.32);
                outline-offset: 4px;
            }

            .business-media {
                aspect-ratio: 1 / 1.1;
                background-position: center;
                background-size: cover;
                background-repeat: no-repeat;
            }

            .business-body {
                padding: 18px;
            }

            .business-tags {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 12px;
                margin-bottom: 14px;
            }

            .tag {
                display: inline-flex;
                align-items: center;
                min-height: 32px;
                padding: 0 12px;
                border-radius: 999px;
                background: #f6f2ff;
                color: #5f5880;
                font-size: 0.74rem;
                font-weight: 800;
                letter-spacing: 0.04em;
                text-transform: uppercase;
            }

            .distance {
                color: var(--muted);
                font-size: 0.82rem;
                font-weight: 700;
            }

            .business-name {
                margin: 0;
                font-size: 1.04rem;
                font-weight: 800;
                letter-spacing: -0.03em;
            }

            .business-location {
                margin: 8px 0 0;
                color: var(--muted);
                font-size: 0.92rem;
                line-height: 1.55;
            }

            .business-rating {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                margin-top: 16px;
                padding: 10px 12px;
                border-radius: 999px;
                background: #f7f6f2;
                color: #262936;
                font-size: 0.88rem;
                font-weight: 700;
            }

            .business-empty {
                padding: 28px 30px;
                color: var(--muted);
                line-height: 1.7;
            }

            .rating-star {
                width: 16px;
                height: 16px;
                color: #111;
            }

            .offer-grid {
                display: grid;
                grid-template-columns: repeat(12, minmax(0, 1fr));
                gap: 18px;
            }

            .offer-card {
                position: relative;
                overflow: hidden;
                min-height: 280px;
                padding: 24px;
                border-radius: 32px;
                color: #fff;
                background-position: center;
                background-size: cover;
                background-repeat: no-repeat;
                box-shadow: 0 22px 48px rgba(17, 18, 28, 0.1);
                transition:
                    transform 200ms ease,
                    box-shadow 200ms ease;
            }

            .offer-card::before {
                content: '';
                position: absolute;
                inset: 0;
                background: linear-gradient(180deg, rgba(18, 18, 18, 0.12) 0%, rgba(18, 18, 18, 0.72) 100%);
            }

            .offer-card:first-child {
                grid-column: span 7;
                min-height: 420px;
            }

            .offer-card:nth-child(2) {
                grid-column: span 5;
            }

            .offer-card:nth-child(3),
            .offer-card:nth-child(4) {
                grid-column: span 6;
            }

            .offer-body {
                position: relative;
                z-index: 1;
                display: flex;
                flex-direction: column;
                justify-content: flex-end;
                height: 100%;
            }

            .offer-badge {
                align-self: flex-start;
                margin-bottom: auto;
                padding: 10px 14px;
                border-radius: 999px;
                background: rgba(255, 255, 255, 0.2);
                border: 1px solid rgba(255, 255, 255, 0.22);
                backdrop-filter: blur(10px);
                font-size: 0.74rem;
                font-weight: 800;
                letter-spacing: 0.08em;
                text-transform: uppercase;
            }

            .offer-title {
                margin: 0;
                max-width: 18ch;
                font-family: 'Manrope', sans-serif;
                font-size: clamp(1.5rem, 2.6vw, 2.4rem);
                line-height: 0.98;
                letter-spacing: -0.05em;
            }

            .offer-meta {
                margin-top: 12px;
                color: rgba(255, 255, 255, 0.86);
                font-size: 0.96rem;
            }

            .city-panel {
                padding: 34px;
            }

            .city-grid {
                display: grid;
                grid-template-columns: repeat(4, minmax(0, 1fr));
                gap: 0 24px;
            }

            .city-link {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 16px;
                min-height: 64px;
                border-bottom: 1px solid rgba(18, 18, 18, 0.08);
                font-size: 0.95rem;
                font-weight: 800;
            }

            .city-link span:last-child {
                color: rgba(18, 18, 18, 0.4);
            }

            .business-cta {
                padding-bottom: 50px;
            }

            .business-cta-card {
                position: relative;
                overflow: hidden;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 24px;
                padding: 34px;
                border: 1px solid rgba(18, 18, 18, 0.08);
                border-radius: 32px;
                background:
                    radial-gradient(circle at 0% 100%, rgba(247, 197, 238, 0.85), transparent 28%),
                    radial-gradient(circle at 100% 0%, rgba(209, 205, 255, 0.92), transparent 34%),
                    linear-gradient(140deg, rgba(255, 255, 255, 0.96) 0%, rgba(245, 242, 255, 0.94) 100%);
                box-shadow: 0 22px 48px rgba(17, 18, 28, 0.08);
                transition: transform 200ms ease;
            }

            .business-cta-title {
                margin: 0;
                font-family: 'Manrope', sans-serif;
                font-size: clamp(2rem, 3vw, 3.1rem);
                line-height: 0.96;
                letter-spacing: -0.06em;
            }

            .business-cta-copy {
                margin: 14px 0 0;
                max-width: 760px;
                color: var(--muted);
                line-height: 1.7;
            }

            .business-cta-link {
                flex: 0 0 auto;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                min-height: 62px;
                padding: 0 28px;
                border-radius: 999px;
                background: var(--black);
                color: #fff;
                font-weight: 800;
                box-shadow: 0 16px 30px rgba(18, 18, 18, 0.16);
            }

            .site-footer {
                padding: 0 0 40px;
            }

            .footer-card {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 18px;
                padding: 24px 28px;
                border: 1px solid rgba(18, 18, 18, 0.08);
                border-radius: 28px;
                background: rgba(255, 255, 255, 0.72);
                color: var(--muted);
            }

            .footer-brand {
                color: var(--ink);
                font-weight: 800;
            }

            .footer-links {
                display: flex;
                align-items: center;
                gap: 18px;
                font-weight: 700;
            }

            @keyframes rise-in {
                from {
                    opacity: 0;
                    transform: translateY(18px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @media (max-width: 1260px) {
                .hero-panel {
                    min-height: 740px;
                }

                .hero-inner {
                    padding-top: 100px;
                }

                .search-shell {
                    grid-template-columns: 1fr 1fr;
                    border-radius: 34px;
                }

                .search-field {
                    min-height: 80px;
                }

                .search-field:nth-child(2) {
                    border-right: 0;
                }

                .search-field:nth-child(-n + 2) {
                    border-bottom: 1px solid rgba(18, 18, 18, 0.1);
                }

                .search-submit {
                    grid-column: 1 / -1;
                    min-height: 78px;
                    margin: 8px 0 0;
                }

                .browse-panel {
                    grid-template-columns: 1fr;
                }

                .business-grid {
                    grid-template-columns: repeat(3, minmax(0, 1fr));
                }

                .city-grid {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }
            }

            @media (max-width: 980px) {
                .page-shell {
                    width: min(100% - 20px, 1840px);
                }

                .hero-stage .page-shell {
                    width: min(100% - 12px, 1920px);
                }

                .hero-panel {
                    min-height: auto;
                    border-radius: 0 0 24px 24px;
                }

                .hero-header {
                    flex-direction: column;
                    align-items: stretch;
                    padding: 18px 20px 0;
                    min-height: auto;
                }

                .hero-nav {
                    flex-wrap: wrap;
                    justify-content: space-between;
                }

                .hero-link {
                    min-height: 54px;
                    display: inline-flex;
                    align-items: center;
                }

                .hero-pill {
                    min-height: 56px;
                    padding: 0 22px;
                }

                .hero-inner {
                    padding: 68px 20px 66px;
                }

                .hero-title {
                    font-size: clamp(3rem, 12vw, 4.6rem);
                    line-height: 0.94;
                }

                .hero-subtitle {
                    width: min(100%, 720px);
                    font-size: 1rem;
                    line-height: 1.5;
                }

                .search-shell {
                    grid-template-columns: 1fr;
                    padding: 10px;
                    border-radius: 32px;
                    margin-top: 44px;
                }

                .search-field {
                    min-height: 68px;
                    padding: 0 20px;
                    border-right: 0;
                    border-bottom: 1px solid rgba(18, 18, 18, 0.1);
                }

                .search-field:nth-child(-n + 2) {
                    border-bottom: 1px solid rgba(18, 18, 18, 0.1);
                }

                .search-submit {
                    min-height: 66px;
                    margin-top: 8px;
                }

                .business-grid {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }

                .offer-card:first-child,
                .offer-card:nth-child(2),
                .offer-card:nth-child(3),
                .offer-card:nth-child(4) {
                    grid-column: span 12;
                    min-height: 320px;
                }

                .business-cta-card,
                .footer-card {
                    flex-direction: column;
                    align-items: flex-start;
                }
            }

            @media (max-width: 640px) {
                .hero-nav {
                    display: grid;
                    grid-template-columns: 1fr 1fr;
                    gap: 12px;
                }

                .hero-link {
                    grid-column: 1 / -1;
                    justify-content: center;
                }

                .hero-pill {
                    width: 100%;
                    padding: 0 18px;
                }

                .hero-note {
                    margin-top: 42px;
                }

                .browse-panel,
                .city-panel,
                .business-cta-card {
                    padding: 26px 20px;
                }

                .business-grid,
                .city-grid {
                    grid-template-columns: 1fr;
                }

                .footer-links {
                    flex-wrap: wrap;
                    gap: 12px;
                }
            }

            @media (min-width: 1024px) {
                .hero-header {
                    padding-inline: 32px;
                }

                .brand {
                    font-size: 2rem;
                }

                .hero-inner {
                    padding-top: 116px;
                    padding-bottom: 88px;
                }

                .hero-title {
                    font-size: 64px;
                    line-height: 68px;
                    letter-spacing: -0.04em;
                }

                .hero-subtitle {
                    font-size: 22px;
                    line-height: 28px;
                    max-width: 1136px;
                }

                .search-shell {
                    margin-top: 66px;
                }

                .hero-note {
                    margin-top: 56px;
                    font-size: 22px;
                    line-height: 28px;
                }
            }
        </style>
    </head>
    <body>
        <section class="hero-stage">
            <div class="page-shell">
                <div class="hero-panel">
                    <header class="hero-header">
                        <a class="brand" href="{{ route('home') }}">bookrahisi</a>

                        <nav class="hero-nav" aria-label="Primary navigation">
                            <a class="hero-link" href="{{ $customerUser ? route('customer.dashboard') : route('customer.sign-in') }}">
                                {{ $customerUser ? 'Dashboard' : 'Log in' }}
                            </a>
                            <a class="hero-pill" href="{{ route('for-business') }}">List your business</a>
                            <a class="hero-pill" href="#discover">
                                <span>Menu</span>
                                <span class="menu-icon" aria-hidden="true">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </span>
                            </a>
                        </nav>
                    </header>

                    <div class="hero-inner">
                        <div class="hero-copy">
                            <h1 class="hero-title">{{ $heroTitle }}</h1>
                            <p class="hero-subtitle">{{ $heroSubtitle }}</p>

                            <form class="search-shell" action="{{ route('home') }}" method="get" aria-label="Search services">
                                <div class="search-field">
                                    <label class="sr-only" for="service">Service or treatment</label>
                                    <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <circle cx="11" cy="11" r="7"></circle>
                                        <path d="m20 20-3.5-3.5"></path>
                                    </svg>
                                    <input
                                        id="service"
                                        class="search-input"
                                        type="text"
                                        name="service"
                                        value="{{ request('service') }}"
                                        placeholder="All treatments"
                                    >
                                </div>

                                <div class="search-field">
                                    <label class="sr-only" for="location">Location</label>
                                    <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M12 21s6-5.33 6-11a6 6 0 1 0-12 0c0 5.67 6 11 6 11Z"></path>
                                        <circle cx="12" cy="10" r="2.5"></circle>
                                    </svg>
                                    <input
                                        id="location"
                                        class="search-input"
                                        type="text"
                                        name="location"
                                        value="{{ request('location') }}"
                                        placeholder="Current location"
                                    >
                                </div>

                                <div class="search-field">
                                    <label class="sr-only" for="when">Time</label>
                                    <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <rect x="3" y="4" width="18" height="17" rx="2"></rect>
                                        <path d="M8 2v4"></path>
                                        <path d="M16 2v4"></path>
                                        <path d="M3 10h18"></path>
                                    </svg>
                                    <select id="when" class="search-select" name="when" aria-label="Select time">
                                        <option value="" @selected(request('when') === null || request('when') === '')>Any time</option>
                                        <option value="open-now" @selected(request('when') === 'open-now')>Open now</option>
                                        <option value="today" @selected(request('when') === 'today')>Today</option>
                                        <option value="weekend" @selected(request('when') === 'weekend')>This weekend</option>
                                    </select>
                                </div>

                                <button class="search-submit" type="submit">Search</button>
                            </form>

                            <p class="hero-note"><strong>412,355</strong> appointments booked today</p>

                            <div class="hero-app">
                                <a class="hero-app-link" href="#discover">
                                    <span>Get the app</span>
                                    <svg class="qr-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <rect x="3" y="3" width="7" height="7" rx="1.4"></rect>
                                        <rect x="14" y="3" width="7" height="7" rx="1.4"></rect>
                                        <rect x="3" y="14" width="7" height="7" rx="1.4"></rect>
                                        <path d="M14 14h3"></path>
                                        <path d="M21 14v3"></path>
                                        <path d="M18 17h3"></path>
                                        <path d="M14 21h3"></path>
                                        <path d="M18 18v3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <main>
            <section class="section page-shell" id="discover">
                <div class="section-card browse-panel">
                    <div>
                        <span class="section-kicker">Discover</span>
                        <h2 class="section-title">Start with a treatment people already love.</h2>
                        <p class="section-copy">
                            Book Rahisi keeps the landing page focused like the reference, then gives visitors a quick way to jump into the categories that convert best.
                        </p>
                    </div>

                    <div class="pill-cluster" aria-label="Popular services">
                        @foreach ($servicePills as $pill)
                            <a class="service-pill" href="#popular">{{ $pill }}</a>
                        @endforeach
                    </div>
                </div>
            </section>

            <section class="section page-shell" id="popular">
                <div class="section-head">
                    <div>
                        <span class="section-kicker">Nearby</span>
                        <h2 class="section-title">Popular businesses near you</h2>
                    </div>
                    <a class="section-link" href="#cities">
                        <span>Browse cities</span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M5 12h14"></path>
                            <path d="m12 5 7 7-7 7"></path>
                        </svg>
                    </a>
                </div>

                @if ($trendingBusinesses === [])
                    <div class="section-card business-empty">
                        No approved businesses are live on the marketplace yet. New listings will appear here as soon as business owners finish setup and the public profile is approved.
                    </div>
                @else
                    <div class="business-grid">
                        @foreach ($trendingBusinesses as $business)
                            <a class="section-card business-card" href="{{ route('business.show', ['slug' => $business['slug']]) }}" aria-label="View {{ $business['name'] }}">
                                <div class="business-media" style="background-image: url('{{ $business['image'] }}');"></div>
                                <div class="business-body">
                                    <div class="business-tags">
                                        <span class="tag">{{ $business['category'] }}</span>
                                        <span class="distance">{{ $business['detail'] }}</span>
                                    </div>
                                    <h3 class="business-name">{{ $business['name'] }}</h3>
                                    <p class="business-location">{{ $business['location'] }}</p>
                                    <div class="business-rating">
                                        <svg class="rating-star" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                            <path d="m12 3.7 2.54 5.15 5.69.83-4.11 4.01.97 5.67L12 16.71l-5.09 2.65.97-5.67-4.11-4.01 5.69-.83L12 3.7Z"></path>
                                        </svg>
                                        <span>{{ $business['rating'] }}</span>
                                        <span>{{ $business['reviews'] }}</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </section>

            <section class="section page-shell" id="daily-deals">
                <div class="section-head">
                    <div>
                        <span class="section-kicker">Offers</span>
                        <h2 class="section-title">Fresh deals worth opening right now</h2>
                    </div>
                    <a class="section-link" href="{{ route('for-business') }}">
                        <span>For business</span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M5 12h14"></path>
                            <path d="m12 5 7 7-7 7"></path>
                        </svg>
                    </a>
                </div>

                <div class="offer-grid">
                    @foreach ($featuredDeals as $deal)
                        <article class="offer-card" style="background-image: url('{{ $deal['image'] }}');">
                            <div class="offer-body">
                                <span class="offer-badge">{{ $deal['badge'] }}</span>
                                <h3 class="offer-title">{{ $deal['title'] }}</h3>
                                <div class="offer-meta">{{ $deal['location'] }} &middot; {{ $deal['distance'] }}</div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>

            <section class="section page-shell" id="cities">
                <div class="section-card city-panel">
                    <div class="section-head">
                        <div>
                            <span class="section-kicker">Locations</span>
                            <h2 class="section-title">Explore bookings across Kenya</h2>
                        </div>
                    </div>

                    <div class="city-grid">
                        @foreach ($cityColumns as $column)
                            <div>
                                @foreach ($column as $city)
                                    <a class="city-link" href="#popular">
                                        <span>{{ $city }}</span>
                                        <span>&gt;</span>
                                    </a>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <section class="business-cta page-shell" id="for-business">
                <article class="business-cta-card">
                    <div>
                        <h2 class="business-cta-title">List your salon, spa, or studio with the same polished first impression.</h2>
                        <p class="business-cta-copy">
                            Give customers live availability, clear pricing, staff schedules, and faster rebooking with a marketplace profile that feels premium from the first click.
                        </p>
                    </div>
                    <a class="business-cta-link" href="{{ route('for-business') }}">List your business</a>
                </article>
            </section>
        </main>

        <footer class="site-footer">
            <div class="page-shell">
                <div class="footer-card">
                    <div><span class="footer-brand">Book Rahisi</span> connects customers with salons, spas, barbershops, and wellness studios across Kenya.</div>
                    <div class="footer-links">
                        <a href="{{ route('for-business') }}">For Business</a>
                        <a href="#daily-deals">Deals</a>
                        <a href="#cities">Cities</a>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
