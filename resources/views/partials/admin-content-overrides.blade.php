:root {
    --ink: #111827;
    --muted: #5f6b7c;
    --line: #dbe2ec;
    --page: #f5f7fb;
    --panel: rgba(255, 255, 255, 0.94);
    --primary: #ff304f;
    --primary-soft: #fff1f4;
    --danger: #c24134;
    --danger-soft: #fff0ee;
    --warning: #a56607;
    --warning-soft: #fff4dd;
    --success: #167443;
    --success-soft: #ebf8ef;
    --shadow: 0 24px 60px rgba(15, 23, 42, 0.08);
    --mobile-accent: var(--primary);
    --mobile-accent-soft: var(--primary-soft);
    --mobile-danger-soft: var(--danger-soft);
    --mobile-danger-ink: var(--danger);
}

body {
    background:
        radial-gradient(circle at top left, rgba(255, 48, 79, 0.08), transparent 28%),
        radial-gradient(circle at top right, rgba(17, 24, 39, 0.08), transparent 30%),
        linear-gradient(180deg, #fbfcfe 0%, var(--page) 100%);
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

.content-app {
    grid-template-columns: 292px minmax(0, 1fr);
}

.content-sidebar {
    position: sticky;
    top: 0;
    min-height: 100vh;
    padding: 20px 18px;
    gap: 18px;
    background: rgba(255, 255, 255, 0.78);
    border-right: 1px solid rgba(219, 226, 236, 0.94);
    backdrop-filter: blur(22px);
}

.sidebar-brand-card {
    padding: 18px;
    border-radius: 28px;
    background:
        radial-gradient(circle at top right, rgba(255, 255, 255, 0.18), transparent 36%),
        linear-gradient(135deg, #121826 0%, #1f2937 56%, #c41735 100%);
    color: #fff;
    border: 0;
    box-shadow: 0 22px 44px rgba(9, 13, 21, 0.18);
}

.sidebar-brand-subtitle {
    color: rgba(255, 255, 255, 0.74);
}

.content-nav {
    gap: 8px;
}

.content-link {
    gap: 14px;
    padding: 12px 14px;
    border-radius: 20px;
    color: #4c5769;
}

.content-link:hover,
.content-link.is-active {
    background: rgba(255, 255, 255, 0.96);
    color: var(--ink);
    border-color: rgba(219, 226, 236, 0.98);
    box-shadow: 0 16px 30px rgba(15, 23, 42, 0.08);
}

.content-link-icon {
    width: 42px;
    height: 42px;
    border-radius: 16px;
    background: #f4f6fb;
    color: var(--primary);
    border: 1px solid rgba(219, 226, 236, 0.92);
}

.content-link.is-active .content-link-icon {
    background: var(--primary-soft);
    border-color: rgba(255, 48, 79, 0.16);
}

.content-summary-card,
.meta-card,
.stat-card,
.panel,
.editor-card,
.table-shell {
    border: 1px solid rgba(219, 226, 236, 0.98);
    border-radius: 28px;
    background: rgba(255, 255, 255, 0.94);
    box-shadow: 0 18px 42px rgba(15, 23, 42, 0.06);
}

.content-summary-card {
    padding: 18px;
}

.workspace {
    padding: 18px 20px 32px;
}

.workspace-shell {
    width: min(100%, 1500px);
}

.page-head {
    align-items: start;
    padding: 24px 26px;
    border: 1px solid rgba(219, 226, 236, 0.94);
    border-radius: 30px;
    background: rgba(255, 255, 255, 0.82);
    box-shadow: 0 18px 40px rgba(15, 23, 42, 0.08);
    backdrop-filter: blur(22px);
}

.eyebrow {
    background: var(--primary-soft);
    color: #c41735;
}

h1 {
    color: var(--ink);
}

.page-subtitle,
.content-summary-copy,
.list-copy,
.table-copy,
.field-hint,
.meta-copy,
.banner {
    color: var(--muted);
}

.button-primary,
.button-light,
.button-soft,
.button-preview,
.button-warning,
.button-danger {
    border-radius: 16px;
    font-weight: 800;
}

.button-primary,
.button-preview {
    background: var(--primary);
    color: #fff;
    box-shadow: 0 18px 34px rgba(255, 48, 79, 0.18);
}

.button-light,
.button-soft,
.button-warning,
.button-danger {
    border-color: rgba(219, 226, 236, 0.98);
    background: rgba(255, 255, 255, 0.96);
    color: var(--ink);
}

.button-soft {
    color: #c41735;
    background: var(--primary-soft);
    border-color: rgba(255, 48, 79, 0.16);
}

.field-input,
.field-select,
.field-textarea {
    border: 1px solid rgba(219, 226, 236, 0.98);
    border-radius: 16px;
    background: rgba(248, 250, 252, 0.88);
    color: var(--ink);
}

.field-input:focus,
.field-select:focus,
.field-textarea:focus {
    border-color: rgba(255, 48, 79, 0.35);
    box-shadow: 0 0 0 4px rgba(255, 48, 79, 0.12);
    background: #fff;
}

.banner,
.empty-state {
    border-radius: 22px;
}

@media (max-width: 1120px) {
    .content-app {
        grid-template-columns: 1fr;
    }

    .content-sidebar {
        position: static;
        min-height: 0;
        border-right: 0;
        border-bottom: 1px solid rgba(219, 226, 236, 0.98);
    }

    .page-head {
        padding: 22px;
    }
}

@media (max-width: 760px) {
    .workspace {
        padding: 16px 14px calc(120px + env(safe-area-inset-bottom));
    }

    .content-sidebar {
        padding: 16px 14px 18px;
    }

    .content-sidebar .content-group-label,
    .content-sidebar .content-nav,
    .content-sidebar .content-summary-card {
        display: none;
    }

    .sidebar-brand-card,
    .content-summary-card,
    .page-head,
    .panel,
    .editor-card,
    .stat-card,
    .table-shell {
        border-radius: 24px;
    }
}

@include('partials.mobile-console-nav-styles')
