:root {
    --navy: #17345d;
    --navy-deep: #112744;
    --navy-soft: rgba(255, 255, 255, 0.08);
    --line: #d6e2f0;
    --page: #eef5fb;
    --ink: #17304d;
    --muted: #607792;
    --accent: #1aa0e2;
    --accent-deep: #14898b;
    --success-soft: #eaf8ef;
    --success-ink: #147d46;
    --warning-soft: #fff4dc;
    --warning-ink: #b36c00;
    --danger-soft: #fff0ee;
    --danger-ink: #c24b3a;
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
select,
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
    font-size: 1.9rem;
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
    width: min(100%, 1460px);
    margin: 0 auto;
}

.topbar {
    display: flex;
    align-items: flex-start;
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
    margin: 16px 0 0;
    font-family: 'Outfit', sans-serif;
    font-size: clamp(2.2rem, 4vw, 3.5rem);
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
.button-light,
.button-inline {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 14px 20px;
    border-radius: 16px;
    font-size: 0.96rem;
    font-weight: 800;
}

.button-dark,
.button-inline {
    border: 0;
    background: var(--navy);
    color: #fff;
    cursor: pointer;
    box-shadow: 0 14px 30px rgba(23, 52, 93, 0.16);
}

.button-light {
    border: 1px solid var(--line);
    background: rgba(255, 255, 255, 0.94);
    color: var(--ink);
}

.button-inline {
    padding: 12px 16px;
    border-radius: 14px;
    font-size: 0.88rem;
    box-shadow: none;
}

.success-banner,
.error-banner {
    margin-bottom: 18px;
    padding: 14px 16px;
    border-radius: 18px;
    font-size: 0.94rem;
    font-weight: 700;
}

.success-banner {
    border: 1px solid rgba(20, 125, 70, 0.14);
    background: var(--success-soft);
    color: var(--success-ink);
}

.error-banner {
    border: 1px solid rgba(194, 75, 58, 0.18);
    background: var(--danger-soft);
    color: var(--danger-ink);
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
    font-size: clamp(2rem, 4vw, 3.2rem);
    letter-spacing: -0.06em;
    line-height: 1;
}

.hero-copy {
    margin: 14px 0 0;
    color: rgba(255, 255, 255, 0.94);
    line-height: 1.7;
    max-width: 760px;
}

.hero-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-top: 20px;
}

.hero-actions .button-dark,
.hero-actions .button-light {
    background: rgba(255, 255, 255, 0.95);
    color: var(--ink);
    box-shadow: none;
}

.hero-side {
    display: grid;
    justify-items: end;
    gap: 14px;
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

.hero-amount {
    font-family: 'Outfit', sans-serif;
    font-size: clamp(2.4rem, 4vw, 3.8rem);
    font-weight: 800;
    letter-spacing: -0.06em;
    line-height: 0.95;
}

.hero-caption {
    color: rgba(255, 255, 255, 0.92);
    font-size: 0.96rem;
    font-weight: 700;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 16px;
    margin-bottom: 22px;
}

.stat-card,
.panel {
    border: 1px solid var(--line);
    border-radius: 24px;
    background: rgba(255, 255, 255, 0.94);
    box-shadow: var(--shadow);
}

.stat-card {
    padding: 20px 20px 18px;
}

.stat-label {
    color: var(--muted);
    font-size: 0.84rem;
    font-weight: 700;
}

.stat-value {
    margin-top: 14px;
    font-family: 'Outfit', sans-serif;
    font-size: 2rem;
    font-weight: 800;
    letter-spacing: -0.05em;
    line-height: 1;
}

.stat-pill {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-top: 14px;
    padding: 10px 14px;
    border-radius: 16px;
    background: #e8f4ff;
    color: #0f69ad;
    font-size: 0.9rem;
    font-weight: 800;
}

.stat-pill.is-success {
    background: #e7f7ea;
    color: var(--success-ink);
}

.stat-pill.is-warning {
    background: var(--warning-soft);
    color: var(--warning-ink);
}

.panel-stack {
    display: grid;
    gap: 18px;
}

.panel {
    padding: 24px;
}

.panel-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    margin-bottom: 18px;
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

.search-form,
.inline-form {
    display: grid;
    gap: 12px;
}

.search-form-row,
.inline-form-row {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr auto;
    gap: 10px;
}

.field-input,
.field-select,
.field-textarea {
    width: 100%;
    min-height: 50px;
    padding: 0 14px;
    border: 1px solid var(--line);
    border-radius: 14px;
    outline: none;
    background: #fff;
    color: var(--ink);
    font-size: 0.92rem;
}

.field-textarea {
    min-height: 108px;
    padding: 14px;
    resize: vertical;
}

.field-input:focus,
.field-select:focus,
.field-textarea:focus {
    border-color: var(--accent);
    box-shadow: 0 0 0 4px rgba(26, 160, 226, 0.08);
}

.business-grid,
.booking-grid,
.account-grid {
    display: grid;
    gap: 16px;
}

.business-grid {
    grid-template-columns: repeat(3, minmax(0, 1fr));
}

.account-grid {
    grid-template-columns: 1.2fr 0.8fr;
}

.business-card,
.booking-row,
.account-card {
    padding: 20px;
    border: 1px solid var(--line);
    border-radius: 20px;
    background: #fff;
}

.business-card h3,
.booking-row h3,
.account-card h3 {
    margin: 0;
    font-family: 'Outfit', sans-serif;
    font-size: 1.3rem;
    letter-spacing: -0.04em;
}

.meta,
.helper-copy {
    margin-top: 10px;
    color: var(--muted);
    line-height: 1.65;
}

.business-actions,
.booking-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 18px;
}

.status-chip {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 8px 12px;
    border-radius: 14px;
    background: #e8f4ff;
    color: #0f69ad;
    font-size: 0.82rem;
    font-weight: 800;
    text-transform: capitalize;
}

.status-chip.is-success {
    background: var(--success-soft);
    color: var(--success-ink);
}

.status-chip.is-warning {
    background: var(--warning-soft);
    color: var(--warning-ink);
}

.status-chip.is-danger {
    background: var(--danger-soft);
    color: var(--danger-ink);
}

.booking-head {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 16px;
}

.chip-row {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 12px;
}

.review-block {
    margin-top: 18px;
    padding-top: 18px;
    border-top: 1px solid var(--line);
}

.rating-row {
    display: grid;
    grid-template-columns: 120px minmax(0, 1fr);
    gap: 10px;
    align-items: center;
}

.rating-options {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.rating-options label {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 10px;
    border: 1px solid var(--line);
    border-radius: 12px;
    background: #fff;
    font-size: 0.9rem;
}

.empty-state {
    padding: 24px;
    border: 1px dashed var(--line);
    border-radius: 20px;
    background: #fafdff;
    color: var(--muted);
    line-height: 1.7;
}

@media (max-width: 1320px) {
    .business-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
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
    .account-grid {
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
    .panel-head,
    .booking-head,
    .business-actions,
    .booking-actions {
        flex-direction: column;
        align-items: stretch;
    }

    .stats-grid,
    .business-grid,
    .search-form-row,
    .inline-form-row,
    .account-grid,
    .rating-row {
        grid-template-columns: 1fr;
    }

    .button-dark,
    .button-light,
    .button-inline {
        width: 100%;
    }
}
