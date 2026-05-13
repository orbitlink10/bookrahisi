:root {
    --navy: #121826;
    --navy-deep: #090d15;
    --navy-soft: rgba(15, 23, 42, 0.06);
    --page: #f5f7fb;
    --panel: rgba(255, 255, 255, 0.94);
    --panel-strong: #ffffff;
    --ink: #111827;
    --muted: #5f6b7c;
    --line: #dbe2ec;
    --accent: #ff304f;
    --accent-deep: #c41735;
    --accent-soft: #fff1f4;
    --success-soft: #ebf8ef;
    --success-ink: #167443;
    --warning-soft: #fff4dd;
    --warning-ink: #a56607;
    --danger-soft: #fff0ee;
    --danger-ink: #c24134;
    --shadow: 0 24px 60px rgba(15, 23, 42, 0.08);
}

html {
    scroll-behavior: smooth;
}

body {
    background:
        radial-gradient(circle at top left, rgba(255, 48, 79, 0.08), transparent 28%),
        radial-gradient(circle at top right, rgba(17, 24, 39, 0.08), transparent 30%),
        linear-gradient(180deg, #fbfcfe 0%, var(--page) 100%);
    color: var(--ink);
}

section[id] {
    scroll-margin-top: 140px;
}

a,
button {
    transition:
        transform 160ms ease,
        box-shadow 160ms ease,
        border-color 160ms ease,
        background-color 160ms ease,
        color 160ms ease;
}

a:hover,
button:hover {
    transform: translateY(-1px);
}

a:focus-visible,
button:focus-visible,
input:focus-visible,
select:focus-visible,
textarea:focus-visible {
    outline: 0;
    box-shadow: 0 0 0 4px rgba(255, 48, 79, 0.16);
}

.console-app {
    grid-template-columns: 292px minmax(0, 1fr);
    background: transparent;
}

.console-sidebar {
    position: sticky;
    top: 0;
    gap: 18px;
    padding: 20px 18px;
    background: rgba(255, 255, 255, 0.78);
    color: var(--ink);
    border-right: 1px solid rgba(219, 226, 236, 0.92);
    backdrop-filter: blur(22px);
}

.sidebar-brand {
    display: grid;
    grid-template-columns: auto 1fr;
    gap: 14px;
    align-items: center;
    padding: 18px;
    border-radius: 28px;
    background:
        radial-gradient(circle at top right, rgba(255, 255, 255, 0.18), transparent 36%),
        linear-gradient(135deg, var(--navy) 0%, #1f2937 56%, var(--accent-deep) 100%);
    color: #fff;
    box-shadow: 0 22px 44px rgba(9, 13, 21, 0.18);
}

.brand-avatar {
    width: 52px;
    height: 52px;
    border-radius: 18px;
    background: rgba(255, 255, 255, 0.14);
    color: #fff;
    border: 1px solid rgba(255, 255, 255, 0.18);
    box-shadow: none;
}

.brand-copy {
    gap: 3px;
}

.brand-title {
    font-size: 1.4rem;
    line-height: 1;
}

.brand-subtitle {
    color: rgba(255, 255, 255, 0.74);
    font-size: 0.84rem;
    font-weight: 700;
}

.sidebar-section-label,
.content-group-label {
    margin: 4px 8px 0;
    color: #8a94a6;
    font-size: 0.76rem;
    font-weight: 800;
    letter-spacing: 0.16em;
    text-transform: uppercase;
}

.sidebar-nav {
    gap: 8px;
}

.sidebar-link {
    gap: 14px;
    padding: 12px 14px;
    border: 1px solid transparent;
    border-radius: 20px;
    color: #4c5769;
    background: transparent;
}

.sidebar-link:hover,
.sidebar-link.is-active {
    border-color: rgba(219, 226, 236, 0.98);
    background: rgba(255, 255, 255, 0.96);
    color: var(--ink);
    box-shadow: 0 16px 30px rgba(15, 23, 42, 0.08);
}

.sidebar-link-icon {
    width: 42px;
    height: 42px;
    border-radius: 16px;
    border: 1px solid rgba(219, 226, 236, 0.92);
    background: #f4f6fb;
    color: var(--accent);
    font-size: 0.78rem;
    font-weight: 900;
}

.sidebar-link.is-active .sidebar-link-icon {
    background: var(--accent-soft);
    border-color: rgba(255, 48, 79, 0.16);
}

.sidebar-link-copy,
.content-link-copy {
    display: grid;
    gap: 3px;
    min-width: 0;
}

.sidebar-link-label,
.content-link-label {
    font-size: 0.94rem;
    font-weight: 800;
    line-height: 1.15;
}

.sidebar-link-meta,
.content-link-meta {
    color: #8a94a6;
    font-size: 0.76rem;
    line-height: 1.45;
}

.sidebar-support {
    display: grid;
    gap: 10px;
    margin-top: auto;
    padding: 18px;
    border: 1px solid rgba(219, 226, 236, 0.98);
    border-radius: 24px;
    background: rgba(255, 255, 255, 0.9);
    box-shadow: 0 18px 32px rgba(15, 23, 42, 0.06);
}

.sidebar-support-label {
    color: #8a94a6;
    font-size: 0.74rem;
    font-weight: 800;
    letter-spacing: 0.16em;
    text-transform: uppercase;
}

.sidebar-support-title {
    font-family: 'Outfit', sans-serif;
    font-size: 1.3rem;
    font-weight: 800;
    letter-spacing: -0.04em;
    overflow-wrap: anywhere;
}

.sidebar-support-copy {
    color: var(--muted);
    font-size: 0.88rem;
    line-height: 1.65;
}

.sidebar-support-link {
    display: inline-flex;
    align-items: center;
    width: fit-content;
    padding: 10px 14px;
    border-radius: 999px;
    background: var(--accent-soft);
    color: var(--accent-deep);
    font-size: 0.86rem;
    font-weight: 800;
}

.workspace {
    padding: 18px 20px 32px;
}

.workspace-shell {
    width: min(100%, 1480px);
}

.topbar {
    position: sticky;
    top: 18px;
    z-index: 20;
    align-items: flex-start;
    margin-bottom: 22px;
    padding: 24px 26px;
    border: 1px solid rgba(219, 226, 236, 0.94);
    border-radius: 30px;
    background: rgba(255, 255, 255, 0.82);
    box-shadow: 0 18px 40px rgba(15, 23, 42, 0.08);
    backdrop-filter: blur(22px);
}

.eyebrow {
    gap: 8px;
    padding: 10px 14px;
    background: var(--accent-soft);
    color: var(--accent-deep);
}

h1 {
    margin-top: 16px;
    color: var(--ink);
    line-height: 0.95;
}

.subtitle {
    margin-top: 14px;
    color: var(--muted);
    line-height: 1.72;
}

.toolbar,
.hero-actions,
.section-tabs,
.card-actions,
.support-actions,
.business-actions,
.booking-actions {
    gap: 12px;
}

.button-dark,
.button-light,
.button-inline,
.button-accent,
.button-outline,
.button-small {
    border-radius: 16px;
    font-weight: 800;
}

.button-dark,
.button-inline,
.button-accent {
    background: var(--accent);
    color: #fff;
    box-shadow: 0 18px 34px rgba(255, 48, 79, 0.18);
}

.button-light,
.button-outline {
    border: 1px solid rgba(219, 226, 236, 0.98);
    background: rgba(255, 255, 255, 0.96);
    color: var(--ink);
    box-shadow: 0 10px 22px rgba(15, 23, 42, 0.04);
}

.button-small {
    background: #fff;
    color: var(--ink);
    border: 1px solid rgba(219, 226, 236, 0.98);
}

.button-dark:hover,
.button-inline:hover,
.button-accent:hover {
    background: var(--accent-deep);
}

.success-banner,
.error-banner,
.warning-banner,
.hero-alert {
    border-radius: 22px;
}

.hero-card {
    position: relative;
    overflow: hidden;
    align-items: end;
    padding: 32px;
    border-radius: 34px;
    background:
        radial-gradient(circle at top right, rgba(255, 255, 255, 0.18), transparent 30%),
        linear-gradient(135deg, var(--navy) 0%, #1b2433 50%, var(--accent-deep) 100%);
    box-shadow: 0 28px 64px rgba(9, 13, 21, 0.18);
}

.hero-card::before {
    content: '';
    position: absolute;
    inset: auto -80px -80px auto;
    width: 220px;
    height: 220px;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.08);
}

.hero-card > * {
    position: relative;
    z-index: 1;
}

.hero-card h2 {
    max-width: 11ch;
}

.hero-copy,
.hero-caption,
.hero-side-copy {
    color: rgba(255, 255, 255, 0.88);
}

.hero-tag,
.status-pill,
.support-pill,
.stat-pill,
.status-chip,
.booking-status {
    border-radius: 999px;
    font-weight: 800;
}

.hero-tag {
    background: rgba(255, 255, 255, 0.92);
    color: var(--accent-deep);
}

.stat-card,
.panel,
.settings-card,
.support-card,
.account-card,
.business-card,
.booking-row,
.summary-row,
.fact-row,
.entity-row,
.report-card {
    border: 1px solid rgba(219, 226, 236, 0.98);
    background: rgba(255, 255, 255, 0.94);
    box-shadow: 0 18px 42px rgba(15, 23, 42, 0.06);
}

.stat-card,
.panel,
.settings-card,
.support-card {
    border-radius: 28px;
}

.business-card,
.booking-row,
.account-card,
.summary-row,
.fact-row,
.entity-row,
.report-card {
    border-radius: 22px;
}

.panel-title,
.section-title,
.card-title,
.support-title {
    color: var(--ink);
}

.panel-copy,
.section-copy,
.card-copy,
.support-copy,
.meta,
.helper-copy,
.booking-meta,
.booking-note,
.summary-value,
.entity-meta,
.entity-extra {
    color: var(--muted);
}

.stat-pill,
.status-chip,
.booking-status {
    border: 1px solid transparent;
}

.stat-pill,
.status-chip,
.booking-status,
.status-pill.is-neutral,
.support-pill.is-neutral {
    background: #f3f5f9;
    color: #4f5b6c;
}

.stat-pill.is-success,
.status-pill.is-success,
.support-pill.is-success,
.status-chip.is-success {
    background: var(--success-soft);
    color: var(--success-ink);
}

.stat-pill.is-warning,
.status-pill.is-warning,
.support-pill.is-warning,
.status-chip.is-warning {
    background: var(--warning-soft);
    color: var(--warning-ink);
}

.stat-pill.is-danger,
.status-pill.is-danger,
.status-chip.is-danger {
    background: var(--danger-soft);
    color: var(--danger-ink);
}

.section-tabs {
    margin-bottom: 22px;
}

.tab-link {
    min-height: 46px;
    padding: 0 16px;
    border: 1px solid rgba(219, 226, 236, 0.98);
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.9);
    color: #516071;
    font-weight: 800;
}

.tab-link.is-active {
    border-color: transparent;
    background: var(--accent);
    color: #fff;
}

.field-input,
.field-select,
.field-textarea {
    border: 1px solid rgba(219, 226, 236, 0.98);
    border-radius: 16px;
    background: rgba(248, 250, 252, 0.88);
    color: var(--ink);
}

.field-input::placeholder,
.field-textarea::placeholder {
    color: #8a94a6;
}

.field-input:focus,
.field-select:focus,
.field-textarea:focus {
    border-color: rgba(255, 48, 79, 0.35);
    box-shadow: 0 0 0 4px rgba(255, 48, 79, 0.12);
    background: #fff;
}

.empty-state {
    border-radius: 24px;
    border-style: solid;
    background: rgba(255, 255, 255, 0.7);
}

.review-block {
    border-top-color: rgba(219, 226, 236, 0.98);
}

.rating-options label {
    border-radius: 14px;
    border-color: rgba(219, 226, 236, 0.98);
    background: rgba(255, 255, 255, 0.9);
}

.booking-link,
.entity-link {
    color: var(--accent-deep);
}

.booking-link:hover,
.entity-link:hover,
.sidebar-support-link:hover {
    color: var(--accent-deep);
}

.hero-card,
.stat-card,
.panel,
.settings-card,
.support-card {
    animation: console-rise 360ms ease both;
}

.stats-grid > *:nth-child(2),
.panel-stack > *:nth-child(2),
.support-grid > *:nth-child(2) {
    animation-delay: 40ms;
}

.stats-grid > *:nth-child(3),
.panel-stack > *:nth-child(3) {
    animation-delay: 80ms;
}

@keyframes console-rise {
    from {
        opacity: 0;
        transform: translateY(14px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (prefers-reduced-motion: reduce) {
    *,
    *::before,
    *::after {
        animation: none !important;
        transition: none !important;
        scroll-behavior: auto !important;
    }
}

@media (max-width: 1120px) {
    .console-app {
        grid-template-columns: 1fr;
    }

    .console-sidebar {
        position: static;
        min-height: 0;
        border-right: 0;
        border-bottom: 1px solid rgba(219, 226, 236, 0.98);
    }

    .topbar {
        position: static;
    }
}

@media (max-width: 760px) {
    .workspace {
        padding: 16px 14px 28px;
    }

    .console-sidebar {
        padding: 16px 14px 18px;
    }

    .sidebar-brand,
    .sidebar-support,
    .topbar,
    .hero-card,
    .panel,
    .settings-card,
    .support-card,
    .stat-card {
        border-radius: 24px;
    }

    .topbar {
        padding: 20px;
    }

    .hero-card {
        padding: 24px;
    }
}
