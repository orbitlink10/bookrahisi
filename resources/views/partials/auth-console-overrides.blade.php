:root {
    --navy: #17151f;
    --navy-deep: #17151f;
    --navy-soft: rgba(124, 63, 211, 0.08);
    --page: #fbf9fe;
    --panel: rgba(255, 255, 255, 0.94);
    --panel-strong: #ffffff;
    --ink: #17151f;
    --muted: #74717e;
    --line: #e8e5ee;
    --accent: #7c3fd3;
    --accent-deep: #6630bd;
    --accent-soft: #f1e9ff;
    --pink: #e74c8a;
    --success-soft: #edfbf3;
    --success-ink: #147d46;
    --warning-soft: #fff7e7;
    --warning-ink: #9b650d;
    --danger-soft: #ffeaf3;
    --danger-ink: #d83a75;
    --neutral-soft: #f5f3f8;
    --neutral-ink: #575465;
    --shadow: 0 18px 44px rgba(40, 34, 56, 0.08);
    --mobile-accent: var(--accent);
    --mobile-accent-soft: var(--accent-soft);
    --mobile-danger-soft: var(--danger-soft);
    --mobile-danger-ink: var(--danger-ink);
}

html {
    scroll-behavior: smooth;
}

body {
    background:
        radial-gradient(circle at 72% 0%, rgba(124, 63, 211, 0.06), transparent 28%),
        linear-gradient(180deg, #ffffff 0%, var(--page) 100%);
    color: var(--ink);
}

section[id] {
    scroll-margin-top: 112px;
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
    box-shadow: 0 0 0 4px rgba(124, 63, 211, 0.16);
}

.console-app {
    grid-template-columns: 290px minmax(0, 1fr);
    background: transparent;
}

.console-sidebar {
    position: sticky;
    top: 0;
    gap: 28px;
    padding: 26px 20px;
    border-right: 1px solid var(--line);
    background: rgba(255, 255, 255, 0.86);
    color: var(--ink);
    backdrop-filter: blur(18px);
}

.sidebar-brand {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 0;
    border-radius: 0;
    background: transparent;
    color: var(--ink);
    box-shadow: none;
}

.brand-avatar {
    width: 44px;
    height: 44px;
    border: 0;
    border-radius: 12px;
    background: linear-gradient(135deg, var(--accent) 0%, var(--pink) 100%);
    color: #fff;
    box-shadow: none;
}

.brand-copy {
    gap: 2px;
}

.brand-title {
    color: var(--ink);
    font-size: 1.6rem;
    letter-spacing: 0;
    line-height: 1;
}

.brand-subtitle {
    color: var(--pink);
    font-size: 0.95rem;
    font-weight: 800;
}

.sidebar-section-label,
.sidebar-link-meta,
.sidebar-support,
.content-group-label {
    display: none;
}

.sidebar-nav {
    gap: 10px;
}

.sidebar-link {
    gap: 14px;
    min-height: 52px;
    padding: 12px 16px;
    border: 0;
    border-radius: 8px;
    background: transparent;
    color: #575465;
    font-size: 1rem;
}

.sidebar-link:hover,
.sidebar-link.is-active {
    border-color: transparent;
    background: linear-gradient(135deg, var(--accent) 0%, var(--accent-deep) 100%);
    color: #fff;
    box-shadow: 0 14px 28px rgba(124, 63, 211, 0.24);
}

.sidebar-link-icon {
    width: 24px;
    height: 24px;
    border: 0;
    border-radius: 0;
    background: transparent;
    color: currentColor;
    font-size: 0.78rem;
    font-weight: 900;
    letter-spacing: 0;
}

.sidebar-link.is-active .sidebar-link-icon {
    background: transparent;
    border-color: transparent;
    color: currentColor;
}

.sidebar-link-copy,
.content-link-copy {
    display: grid;
    gap: 0;
    min-width: 0;
}

.sidebar-link-label,
.content-link-label {
    font-size: 1rem;
    font-weight: 800;
    line-height: 1.15;
}

.workspace {
    padding: 24px 24px 34px;
}

.workspace-shell {
    width: min(100%, 1500px);
}

.topbar {
    position: sticky;
    top: 18px;
    z-index: 20;
    align-items: flex-start;
    margin-bottom: 22px;
    padding: 22px 24px;
    border: 1px solid var(--line);
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.9);
    box-shadow: var(--shadow);
    backdrop-filter: blur(18px);
}

.eyebrow {
    gap: 8px;
    padding: 9px 14px;
    border-radius: 999px;
    background: var(--accent-soft);
    color: var(--accent-deep);
    font-weight: 900;
}

h1 {
    margin-top: 12px;
    color: var(--ink);
    letter-spacing: 0;
    line-height: 1;
}

.subtitle {
    margin-top: 10px;
    color: var(--muted);
    line-height: 1.65;
}

.toolbar,
.hero-actions,
.section-tabs,
.card-actions,
.support-actions,
.business-actions,
.booking-actions {
    gap: 10px;
}

.button-dark,
.button-light,
.button-inline,
.button-accent,
.button-outline,
.button-small {
    border-radius: 8px;
    font-weight: 900;
}

.button-dark,
.button-inline,
.button-accent {
    border-color: transparent;
    background: linear-gradient(135deg, var(--accent) 0%, var(--accent-deep) 100%);
    color: #fff;
    box-shadow: 0 14px 28px rgba(124, 63, 211, 0.22);
}

.button-light,
.button-outline,
.button-small {
    border: 1px solid var(--line);
    background: rgba(255, 255, 255, 0.96);
    color: var(--ink);
    box-shadow: 0 10px 22px rgba(40, 34, 56, 0.04);
}

.button-dark:hover,
.button-inline:hover,
.button-accent:hover {
    background: linear-gradient(135deg, var(--accent-deep) 0%, #5728a6 100%);
}

.success-banner,
.error-banner,
.warning-banner,
.hero-alert {
    border-radius: 8px;
}

.hero-card {
    position: relative;
    overflow: hidden;
    align-items: end;
    padding: 28px;
    border: 1px solid var(--line);
    border-radius: 8px;
    background:
        radial-gradient(circle at top right, rgba(255, 255, 255, 0.22), transparent 30%),
        linear-gradient(135deg, var(--accent) 0%, var(--accent-deep) 100%);
    box-shadow: var(--shadow);
}

.hero-card::before {
    content: '';
    position: absolute;
    inset: auto -70px -90px auto;
    width: 210px;
    height: 210px;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.08);
}

.hero-card > * {
    position: relative;
    z-index: 1;
}

.hero-copy,
.hero-caption,
.hero-side-copy {
    color: rgba(255, 255, 255, 0.9);
}

.hero-tag {
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.92);
    color: var(--accent-deep);
    font-weight: 900;
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
.report-card,
.setup-card,
.form-card,
.profile-card {
    border: 1px solid var(--line);
    background: rgba(255, 255, 255, 0.94);
    box-shadow: var(--shadow);
}

.stat-card,
.panel,
.settings-card,
.support-card,
.business-card,
.booking-row,
.account-card,
.summary-row,
.fact-row,
.entity-row,
.report-card,
.setup-card,
.form-card,
.profile-card {
    border-radius: 8px;
}

.panel-title,
.section-title,
.card-title,
.support-title {
    color: var(--ink);
    letter-spacing: 0;
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
.entity-extra,
.field-help {
    color: var(--muted);
}

.stat-pill,
.status-pill,
.support-pill,
.status-chip,
.booking-status {
    border: 1px solid transparent;
    border-radius: 999px;
    font-weight: 900;
}

.stat-pill,
.status-chip,
.booking-status,
.status-pill.is-neutral,
.support-pill.is-neutral {
    background: var(--neutral-soft);
    color: var(--neutral-ink);
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
.status-chip.is-danger,
.support-pill.is-danger {
    background: var(--danger-soft);
    color: var(--danger-ink);
}

.section-tabs {
    margin-bottom: 20px;
}

.tab-link,
.subnav-link {
    min-height: 44px;
    padding: 0 14px;
    border: 1px solid var(--line);
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.9);
    color: #575465;
    font-weight: 900;
}

.tab-link.is-active,
.subnav-link.is-active {
    border-color: transparent;
    background: linear-gradient(135deg, var(--accent) 0%, var(--accent-deep) 100%);
    color: #fff;
}

.field-input,
.field-select,
.field-textarea,
input[type='text'],
input[type='email'],
input[type='tel'],
input[type='number'],
input[type='date'],
input[type='time'],
select,
textarea {
    border: 1px solid var(--line);
    border-radius: 8px;
    background: rgba(248, 247, 251, 0.9);
    color: var(--ink);
}

.field-input::placeholder,
.field-textarea::placeholder,
textarea::placeholder,
input::placeholder {
    color: #9a96a5;
}

.field-input:focus,
.field-select:focus,
.field-textarea:focus,
input:focus,
select:focus,
textarea:focus {
    border-color: rgba(124, 63, 211, 0.42);
    box-shadow: 0 0 0 4px rgba(124, 63, 211, 0.12);
    background: #fff;
}

.empty-state {
    border-radius: 8px;
    border-color: var(--line);
    background: rgba(255, 255, 255, 0.7);
}

.review-block {
    border-top-color: var(--line);
}

.rating-options label {
    border-radius: 8px;
    border-color: var(--line);
    background: rgba(255, 255, 255, 0.9);
}

.booking-link,
.entity-link,
.text-link {
    color: var(--accent-deep);
}

.booking-link:hover,
.entity-link:hover,
.text-link:hover,
.sidebar-support-link:hover {
    color: var(--accent-deep);
}

.hero-card,
.stat-card,
.panel,
.settings-card,
.support-card,
.business-card,
.booking-row,
.account-card,
.summary-row {
    animation: console-rise 300ms ease both;
}

.stats-grid > *:nth-child(2),
.panel-stack > *:nth-child(2),
.support-grid > *:nth-child(2),
.settings-grid > *:nth-child(2) {
    animation-delay: 35ms;
}

.stats-grid > *:nth-child(3),
.panel-stack > *:nth-child(3),
.settings-grid > *:nth-child(3) {
    animation-delay: 70ms;
}

@keyframes console-rise {
    from {
        opacity: 0;
        transform: translateY(10px);
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
        border-bottom: 1px solid var(--line);
    }

    .topbar {
        position: static;
    }
}

@media (max-width: 760px) {
    .workspace {
        padding: 16px 14px calc(120px + env(safe-area-inset-bottom));
    }

    .console-sidebar {
        padding: 16px 14px 18px;
    }

    .console-sidebar .sidebar-section-label,
    .console-sidebar .sidebar-nav,
    .console-sidebar .sidebar-support {
        display: none;
    }

    .topbar,
    .hero-card,
    .panel,
    .settings-card,
    .support-card,
    .stat-card {
        border-radius: 8px;
    }

    .topbar {
        padding: 18px;
    }

    .hero-card {
        padding: 22px;
    }
}

@include('partials.mobile-console-nav-styles')
