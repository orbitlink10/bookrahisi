.mobile-nav-shell {
    display: none;
}

@media (max-width: 760px) {
    .mobile-nav-shell {
        position: fixed;
        right: 12px;
        bottom: calc(12px + env(safe-area-inset-bottom));
        left: 12px;
        z-index: 60;
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        padding: 10px;
        border: 1px solid rgba(219, 226, 236, 0.98);
        border-radius: 28px;
        background: rgba(255, 255, 255, 0.94);
        box-shadow: 0 20px 44px rgba(15, 23, 42, 0.14);
        backdrop-filter: blur(22px);
    }

    .mobile-nav-shell summary {
        list-style: none;
        cursor: pointer;
    }

    .mobile-nav-shell summary::-webkit-details-marker {
        display: none;
    }

    .mobile-nav-button {
        flex: 1 1 calc(25% - 6px);
        display: grid;
        gap: 6px;
        align-content: center;
        justify-items: center;
        min-width: 0;
        min-height: 64px;
        padding: 10px 8px;
        border: 1px solid transparent;
        border-radius: 18px;
        background: transparent;
        color: #556170;
        text-align: center;
    }

    .mobile-nav-more {
        order: 99;
    }

    .mobile-nav-button-icon,
    .mobile-nav-drawer-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        border: 1px solid rgba(219, 226, 236, 0.98);
        border-radius: 12px;
        background: #f4f6fb;
        color: var(--mobile-accent);
        font-size: 0.72rem;
        font-weight: 900;
        letter-spacing: 0.02em;
        flex-shrink: 0;
    }

    .mobile-nav-button-label {
        font-size: 0.74rem;
        font-weight: 800;
        line-height: 1.2;
        white-space: nowrap;
    }

    .mobile-nav-button.is-active,
    .mobile-nav-shell[open] .mobile-nav-more {
        border-color: rgba(219, 226, 236, 0.98);
        background: #fff;
        color: var(--ink);
        box-shadow: 0 14px 28px rgba(15, 23, 42, 0.08);
    }

    .mobile-nav-button.is-active .mobile-nav-button-icon,
    .mobile-nav-shell[open] .mobile-nav-more .mobile-nav-button-icon {
        border-color: rgba(255, 48, 79, 0.14);
        background: var(--mobile-accent-soft);
    }

    .mobile-nav-drawer {
        order: -1;
        display: none;
        width: 100%;
        padding: 4px 2px 8px;
    }

    .mobile-nav-shell[open] .mobile-nav-drawer {
        display: grid;
        gap: 12px;
    }

    .mobile-nav-drawer-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
        padding: 4px 4px 0;
    }

    .mobile-nav-drawer-title {
        font-family: 'Outfit', sans-serif;
        font-size: 1.2rem;
        font-weight: 800;
        letter-spacing: -0.04em;
        color: var(--ink);
    }

    .mobile-nav-drawer-copy,
    .mobile-nav-drawer-meta,
    .mobile-nav-drawer-hint {
        color: var(--muted);
        line-height: 1.55;
    }

    .mobile-nav-drawer-copy,
    .mobile-nav-drawer-hint {
        font-size: 0.8rem;
    }

    .mobile-nav-drawer-hint {
        padding-top: 2px;
        text-align: right;
    }

    .mobile-nav-drawer-list {
        display: grid;
        gap: 8px;
    }

    .mobile-nav-drawer-link,
    .mobile-nav-drawer-submit {
        display: flex;
        align-items: center;
        gap: 12px;
        width: 100%;
        padding: 14px;
        border: 1px solid rgba(219, 226, 236, 0.98);
        border-radius: 18px;
        background: #fff;
        color: var(--ink);
        text-align: left;
    }

    .mobile-nav-drawer-form {
        margin: 0;
    }

    .mobile-nav-drawer-submit {
        font: inherit;
        cursor: pointer;
    }

    .mobile-nav-drawer-link.is-active {
        border-color: rgba(255, 48, 79, 0.14);
        background: var(--mobile-accent-soft);
    }

    .mobile-nav-drawer-submit.is-danger {
        border-color: rgba(194, 65, 52, 0.12);
        background: var(--mobile-danger-soft);
        color: var(--mobile-danger-ink);
    }

    .mobile-nav-drawer-text {
        display: grid;
        gap: 3px;
        min-width: 0;
    }

    .mobile-nav-drawer-label {
        font-size: 0.92rem;
        font-weight: 800;
        line-height: 1.2;
    }

    .mobile-nav-drawer-meta {
        font-size: 0.76rem;
    }
}
