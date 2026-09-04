<style>
    /* ── Sidebar palette based on #F0F2F5 ── */
    :root{
        --sb-bg:     #F0F2F5;   /* sidebar background */
        --sb-bg2:    #E8EAED;   /* slightly darker — default link bg */
        --sb-bg3:    #DDE0E5;   /* hover — darker gray */
        --sb-border: #D8DBE0;   /* borders / tree line */
        --sb-text:   #3C4048;   /* default text */
        --sb-muted:  #8A909A;   /* muted / section labels */
        --sb-active-bg: #EDE9FE; /* active — soft yellowish */
        --sb-active-text: #4C1D95; /* active text — warm dark gold */
        --sb-active-border: #7C3AED; /* active border accent */
    }

    .sidebar {
        background: var(--sb-bg);
        border-right: 1px solid var(--sb-border);
        display: flex;
        flex-direction: column;
        height: 100vh;
        width: 260px;
        font-family: 'Inter', sans-serif;
    }

    /* Logo Section */
    .sidebar-header {
        padding: 20px 16px;
        background: var(--sb-bg);
        border-bottom: 1px solid var(--sb-border);
    }
    .sidebar-logo-text {
        font-size: 1.1rem;
        font-weight: 800;
        color: #18181b;
        text-decoration: none;
        display: block;
    }
    .sidebar-logo-sub {
        display: block;
        font-size: 0.65rem;
        color: var(--sb-muted);
        font-weight: 600;
        letter-spacing: .03em;
        margin-top: 2px;
    }

    /* Section Labels */
    .sidebar-section-label {
        padding: 16px 16px 5px 16px;
        font-size: 0.6rem;
        font-weight: 700;
        text-transform: uppercase;
        color: var(--sb-muted);
        letter-spacing: 0.1em;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Parent Links */
    .sidebar-link {
        display: flex;
        background: var(--sb-bg2);
        align-items: center;
        padding: 10px 12px;
        margin: 4px 10px;
        color: var(--sb-text);
        text-decoration: none;
        border-radius: 9999px;
        font-size: 0.875rem;
        font-weight: 600;
        transition: background 0.18s, color 0.18s, box-shadow 0.18s;
        cursor: pointer;
        border: 1px solid transparent;
    }

    /* Hover — darker gray */
    .sidebar-link:hover:not(.active) {
        background: var(--sb-bg3);
        color: #18181b;
        border-color: transparent;
    }
    .sidebar-link:hover:not(.active) .sidebar-icon {
        color: #18181b;
    }

    /* Active — soft yellowish tint */
    .sidebar-link.active {
        background: var(--sb-active-bg) !important;
        color: var(--sb-active-text) !important;
        border-color: var(--sb-active-border) !important;
        box-shadow: 0 1px 6px rgba(212,184,0,.15);
    }
    .sidebar-link.active .sidebar-icon {
        color: var(--sb-active-text) !important;
    }

    /* Icon */
    .sidebar-icon {
        margin-right: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--sb-muted);
        flex-shrink: 0;
        transition: color 0.18s;
    }

    /* Chevron */
    .section-chevron {
        margin-left: auto;
        color: var(--sb-muted);
        transition: transform 0.2s, color 0.18s;
        transform: rotate(-90deg);
        flex-shrink: 0;
    }
    .nav-group.expanded .section-chevron {
        transform: rotate(0deg);
        color: var(--sb-active-text);
    }

    /* Sub-menu */
    .sub-menu {
        margin-left: 31px;
        border-left: 1.5px solid var(--sb-border);
        margin-bottom: 6px;
        padding-top: 2px;
        display: none;
    }
    .nav-group.expanded .sub-menu {
        display: block;
    }

    /* Sub-links — NO background change, only text color */
    .sub-link {
        display: block;
        padding: 7px 14px;
        margin: 2px 10px;
        color: var(--sb-muted);
        text-decoration: none;
        font-size: 0.82rem;
        font-weight: 500;
        transition: color 0.18s;
        border-radius: 9999px;
        background: transparent;
    }

    .sub-link:hover {
        color: #18181b;
        background: transparent;
    }

    /* Active sub-link — only text color changes, no background */
    .sub-link.active-sub {
        color: var(--sb-active-text);
        font-weight: 700;
        background: transparent;
    }
</style>

<style>
    /* Compact navigation rail and contextual module flyouts. */
    .sidebar { width:76px !important;height:100vh;background:#fff !important;border-right:1px solid var(--border) !important;overflow:visible !important;font-family:'Inter','Aptos',sans-serif !important; }
    .sidebar.collapsed { width:76px !important;transform:translateX(-76px); }
    .sidebar-header { min-height:72px !important;padding:14px 10px !important;background:#fff !important;border-bottom:1px solid var(--border) !important;display:grid !important;place-items:center; }
    .sidebar-logo-text { width:44px;height:44px;display:grid !important;place-items:center;overflow:hidden;color:transparent !important;border-radius:13px;background:linear-gradient(145deg,var(--brand-800),var(--brand-600));box-shadow:0 8px 18px rgba(76,29,149,.2); }
    .sidebar-logo-text::before { content:'TC';color:#fff;font-size:13px;font-weight:800;letter-spacing:-.03em; }
    .sidebar-logo-sub { display:none !important; }
    .sidebar-nav { padding:10px 8px !important;overflow-y:auto !important;overflow-x:visible !important; }
    .sidebar-link { position:relative;width:52px;min-height:48px;margin:3px 4px !important;padding:0 !important;display:flex !important;align-items:center;justify-content:center;color:var(--muted) !important;background:transparent !important;border:1px solid transparent !important;border-radius:12px !important;cursor:pointer;text-decoration:none;transition:.18s ease;font:inherit; }
    .sidebar-link:hover { color:var(--brand-700) !important;background:var(--brand-50) !important; }
    .sidebar-link.active { color:var(--brand-800) !important;background:var(--brand-100) !important;border-color:var(--brand-200) !important;box-shadow:none !important; }
    .sidebar-link.active::before { content:'';position:absolute;left:-9px;width:4px;height:24px;border-radius:0 8px 8px 0;background:var(--brand-700); }
    .sidebar-icon { margin:0 !important;color:inherit !important;display:grid;place-items:center; }
    .sidebar-icon svg { width:21px;height:21px; }
    .sidebar .link-text,.sidebar .section-chevron { display:none !important; }
    .nav-group { position:relative; }
    .sub-menu { position:fixed;left:76px;top:76px;z-index:90;width:280px;max-height:calc(100vh - 96px);overflow-y:auto;margin:0 !important;padding:12px !important;display:none;background:#fff;border:1px solid var(--border) !important;border-radius:0 16px 16px 0;box-shadow:16px 16px 38px rgba(59,7,100,.13); }
    .nav-group:hover .sub-menu,.nav-group:focus-within .sub-menu { display:block; }
    .sub-link { display:block;margin:2px 0;padding:10px 12px;color:var(--muted);background:transparent;border-radius:9px;font-size:13px;font-weight:600;text-decoration:none; }
    .sub-link:hover,.sub-link.active-sub { color:var(--brand-800);background:var(--brand-50); }
    .sub-link.active-sub { font-weight:750;box-shadow:inset 3px 0 var(--brand-600); }
    .sidebar > div:last-of-type { padding:10px !important;background:#fff !important;border-color:var(--border) !important; }
    .sidebar > div:last-of-type > div { justify-content:center;padding:6px !important;background:var(--brand-50) !important;border-color:var(--brand-200) !important; }
    .sidebar > div:last-of-type > div > div:first-child { background:var(--brand-800) !important; }
    .sidebar > div:last-of-type > div { flex-direction:column; }
    .sidebar > div:last-of-type > div > div:nth-child(2) { display:none; }
    .sidebar > div:last-of-type form { display:block; }
    .sidebar > div:last-of-type form button { background:transparent !important;border-color:transparent !important;color:var(--brand-700) !important; }
    @media(max-width:768px){
        .sidebar,.sidebar.collapsed { width:min(88vw,320px) !important;transform:translateX(-105%);overflow-y:auto !important;overflow-x:hidden !important;box-shadow:18px 0 50px rgba(30,15,45,.18); }
        .sidebar.mobile-open { transform:translateX(0); }
        .sidebar-header { justify-content:start;padding-inline:16px !important; }
        .sidebar-logo-text { width:48px; }
        .sidebar-nav { padding:10px !important;overflow:visible !important; }
        .sidebar-link { width:100%;justify-content:flex-start;gap:12px;padding:0 14px !important;margin:3px 0 !important; }
        .sidebar .link-text,.sidebar .section-chevron { display:block !important; }
        .sidebar .section-chevron { margin-left:auto; }
        .sidebar-link.active::before { left:-11px; }
        .sub-menu { position:static;width:auto;max-height:none;margin:0 0 8px 24px !important;padding:4px 8px !important;border:0 !important;border-left:1px solid var(--brand-200) !important;border-radius:0;box-shadow:none; }
        .nav-group:hover .sub-menu { display:none; }
        .nav-group.expanded .sub-menu { display:block; }
        .sidebar > div:last-of-type > div { justify-content:flex-start;gap:10px;flex-direction:row; }
        .sidebar > div:last-of-type > div > div:nth-child(2),.sidebar > div:last-of-type form { display:block; }
    }
</style>

<style>
    /* Desktop has two real states: a full navigation panel and a compact icon rail. */
    @media(min-width:769px){
        .sidebar{width:260px !important;overflow:visible !important;transition:width .24s cubic-bezier(.4,0,.2,1),transform .24s cubic-bezier(.4,0,.2,1) !important}
        .sidebar-header{height:72px !important;min-height:72px !important;padding:12px 16px !important;display:flex !important;justify-content:flex-start;gap:10px !important}
        .sidebar-logo-text{width:auto;height:auto;display:flex !important;align-items:center;gap:10px;overflow:visible;color:var(--brand-800) !important;background:none;box-shadow:none;white-space:nowrap}
        .sidebar-logo-text::before{content:'VS';width:42px;height:42px;display:grid;place-items:center;flex:0 0 42px;color:#fff;background:linear-gradient(145deg,var(--brand-800),var(--brand-600));border-radius:12px;font-size:12px;font-weight:800;box-shadow:0 7px 16px rgba(76,29,149,.18)}
        .sidebar-nav{padding:10px 12px !important;overflow-y:auto !important;overflow-x:hidden !important}
        .sidebar-link{width:100%;min-height:46px;margin:3px 0 !important;padding:0 13px !important;justify-content:flex-start;gap:11px;border-radius:11px !important}
        .sidebar .link-text{display:block !important;min-width:0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
        .sidebar .section-chevron{display:block !important;margin-left:auto}
        .sidebar .sub-menu{position:static;left:auto;top:auto;width:auto;max-height:none;margin:2px 0 8px 28px !important;padding:3px 0 3px 10px !important;overflow:visible;background:transparent;border:0 !important;border-left:1px solid var(--brand-200) !important;border-radius:0;box-shadow:none}
        .sidebar .nav-group:hover .sub-menu,.sidebar .nav-group:focus-within .sub-menu{display:none}
        .sidebar .nav-group.expanded .sub-menu{display:block}
        .sidebar > div:last-of-type > div{justify-content:flex-start !important;gap:9px;flex-direction:row !important}
        .sidebar > div:last-of-type > div > div:nth-child(2),.sidebar > div:last-of-type form{display:block !important}

        .sidebar.collapsed{width:76px !important;transform:none !important;border-right:1px solid var(--border) !important}
        .sidebar.collapsed .sidebar-header{padding:14px 10px !important;justify-content:center}
        .sidebar.collapsed .sidebar-logo-text{width:44px;height:44px;display:grid !important;place-items:center;color:transparent !important;background:linear-gradient(145deg,var(--brand-800),var(--brand-600));border-radius:13px;box-shadow:0 8px 18px rgba(76,29,149,.2)}
        .sidebar.collapsed .sidebar-logo-text::before{content:'VS';width:auto;height:auto;display:block;color:#fff;background:none;box-shadow:none}
        .sidebar.collapsed .sidebar-nav{padding:10px 8px !important;overflow-y:auto !important;overflow-x:visible !important}
        .sidebar.collapsed .sidebar-link{width:52px;min-height:48px;margin:3px 4px !important;padding:0 !important;justify-content:center}
        .sidebar.collapsed .link-text,.sidebar.collapsed .section-chevron{display:none !important}
        .sidebar.collapsed .nav-group{position:relative}
        .sidebar.collapsed .nav-group::after{content:'';position:absolute;left:56px;top:0;width:20px;height:100%;pointer-events:none}
        .sidebar.collapsed .nav-group.flyout-open::after{pointer-events:auto}
        .sidebar.collapsed .sub-menu{position:fixed;left:72px;top:var(--flyout-top,12px);z-index:240;width:284px;max-height:calc(100vh - 24px);margin:0 !important;padding:10px 12px 12px !important;overflow-y:auto;background:#fff;border:1px solid var(--border) !important;border-left:3px solid var(--brand-600) !important;border-radius:14px;box-shadow:14px 18px 42px rgba(59,7,100,.18)}
        .sidebar.collapsed .sub-menu::before{content:attr(data-title);display:block;padding:7px 10px 10px;color:var(--brand-900);font-size:12px;font-weight:800;letter-spacing:.07em;text-transform:uppercase;border-bottom:1px solid var(--border);margin-bottom:5px}
        .sidebar.collapsed .nav-group:hover .sub-menu,.sidebar.collapsed .nav-group:focus-within .sub-menu{display:none}
        .sidebar.collapsed .nav-group.expanded .sub-menu{display:none}
        .sidebar.collapsed .nav-group.flyout-open .sub-menu{display:block}
        .sidebar.collapsed > div:last-of-type > div{justify-content:center !important;padding:6px !important;flex-direction:column !important}
        .sidebar.collapsed > div:last-of-type > div > div:nth-child(2){display:none !important}
    }
</style>

<aside id="appSidebar" class="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('admin.index') }}" class="sidebar-logo-text">Veloura Salon</a>
        <span class="sidebar-logo-sub">POS &amp; Management</span>
    </div>

    <nav class="sidebar-nav" style="flex: 1; overflow-y: auto; padding-top: 10px;">


        @if(auth()->user()->hasPermission('dashboard', 'view'))
        <a href="{{ route('admin.index') }}" class="sidebar-link {{ request()->routeIs('admin.index') ? 'active' : '' }}">
            <span class="sidebar-icon"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg></span>
            <span class="link-text">Dashboard</span>
        </a>
        @endif


        @if(auth()->user()->hasPermission('customers', 'view') || auth()->user()->hasPermission('suppliers', 'view'))
        <div class="nav-group">
            <button type="button" class="sidebar-link {{ request()->routeIs('customers.*', 'suppliers.*') ? 'active' : '' }}">
                <span class="sidebar-icon"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg></span>
                <span class="link-text">Contacts</span>
                <svg class="section-chevron" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></button>
            <div class="sub-menu">
                @if(auth()->user()->hasPermission('customers', 'view'))
                <a href="{{ route('customers.index') }}" class="sub-link {{ request()->routeIs('customers.index') ? 'active-sub' : '' }}">All Clients</a>
                @endif
                @if(auth()->user()->hasPermission('customers', 'create'))
                <a href="{{ route('customers.create') }}" class="sub-link {{ request()->routeIs('customers.create') ? 'active-sub' : '' }}">Add New Client</a>
                @endif
                @if(auth()->user()->hasPermission('suppliers', 'view'))
                <a href="{{ route('suppliers.index') }}" class="sub-link {{ request()->routeIs('suppliers.index') ? 'active-sub' : '' }}">All Suppliers</a>
                @endif
                @if(auth()->user()->hasPermission('suppliers', 'create'))
                <a href="{{ route('suppliers.create') }}" class="sub-link {{ request()->routeIs('suppliers.create') ? 'active-sub' : '' }}">Add Supplier</a>
                @endif
            </div>
        </div>
        @endif

        @if(auth()->user()->hasPermission('inventory', 'view'))
        <div class="nav-group">
            <button type="button" class="sidebar-link {{ request()->routeIs('products.*', 'inventory.*') ? 'active' : '' }}">
                <span class="sidebar-icon"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg></span>
                <span class="link-text">Products</span>
                <svg class="section-chevron" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></button>
            <div class="sub-menu">
                @if(auth()->user()->hasPermission('inventory', 'view'))
                <a href="{{ route('products.index') }}" class="sub-link {{ request()->routeIs('products.index') ? 'active-sub' : '' }}">All Products</a>
                <a href="{{ route('inventory.dashboard') }}" class="sub-link {{ request()->routeIs('inventory.*') ? 'active-sub' : '' }}">Inventory Tracking</a>
                @endif
                @if(auth()->user()->hasPermission('inventory', 'create'))
                <a href="{{ route('products.create') }}" class="sub-link {{ request()->routeIs('products.create') ? 'active-sub' : '' }}">Add Product</a>
                @endif
            </div>
        </div>
        @endif

        @if(auth()->user()->hasPermission('inventory', 'view'))
        <div class="nav-group">
            <button type="button" class="sidebar-link {{ request()->routeIs('services.*', 'packages.*') ? 'active' : '' }}">
                <span class="sidebar-icon"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg></span>
                <span class="link-text">Services</span>
                <svg class="section-chevron" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></button>
            <div class="sub-menu">
                <a href="{{ route('services.index') }}" class="sub-link {{ request()->routeIs('services.index') ? 'active-sub' : '' }}">All Services</a>
                <a href="{{ route('services.create') }}" class="sub-link {{ request()->routeIs('services.create') ? 'active-sub' : '' }}">Add Service</a>
                <a href="{{ route('packages.index') }}" class="sub-link {{ request()->routeIs('packages.index') ? 'active-sub' : '' }}">Service Packages</a>
                <a href="{{ route('packages.create') }}" class="sub-link {{ request()->routeIs('packages.create') ? 'active-sub' : '' }}">Add Packages</a>
            </div>
        </div>
        @endif




        @if(auth()->user()->hasPermission('pos', 'access') || auth()->user()->hasPermission('sales', 'view') || auth()->user()->hasPermission('appointments', 'view') || auth()->user()->hasPermission('purchases', 'view') || auth()->user()->hasPermission('reconciliation', 'access') || auth()->user()->hasPermission('reconciliation', 'view'))
        <div class="nav-group">
            <button type="button" class="sidebar-link {{ request()->routeIs('pos.*', 'invoices.*', 'appointments.*', 'reconciliation.*', 'purchases.*') ? 'active' : '' }}">
                <span class="sidebar-icon"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg></span>
                <span class="link-text">Sell</span>
                <svg class="section-chevron" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></button>
            <div class="sub-menu">
                @if(auth()->user()->hasPermission('pos', 'access'))
                <a href="{{ route('pos.index') }}" class="sub-link {{ request()->routeIs('pos.*') ? 'active-sub' : '' }}">POS Terminal</a>
                @endif
                @if(auth()->user()->hasPermission('history', 'access'))
                <a href="{{ route('invoices.index') }}" class="sub-link {{ request()->routeIs('invoices.*') ? 'active-sub' : '' }}">History</a>
                @endif
                @if(auth()->user()->hasPermission('appointments', 'view'))
                <a href="{{ route('appointments.index') }}" class="sub-link {{ request()->routeIs('appointments.*') ? 'active-sub' : '' }}">Appointments</a>
                @endif

            </div>
        </div>
        @endif
        @if(auth()->user()->hasPermission('sales', 'view'))
        <div class="nav-group">
            <button type="button" class="sidebar-link {{ request()->routeIs('reconciliation.*', 'expenses.*') ? 'active' : '' }}">
                <span class="sidebar-icon"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg></span>
                <span class="link-text">Expenses & Cash</span>
                <svg class="section-chevron" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></button>
            <div class="sub-menu">
                <a href="{{ route('expenses.create') }}" class="sub-link {{ request()->routeIs('expenses.*') ? 'active-sub' : '' }}">Add Expense</a>
                <a href="{{ route('reconciliation.index') }}" class="sub-link {{ request()->routeIs('reconciliation.*') ? 'active-sub' : '' }}">Cash Reconciliation</a>
            </div>
        </div>
        @endif

        @if(auth()->user()->hasPermission('reports', 'view'))
        <div class="nav-group">
            <button type="button" class="sidebar-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                <span class="sidebar-icon"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg></span>
                <span class="link-text">Reports</span>
                <svg class="section-chevron" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></button>
            <div class="sub-menu">
                <a href="{{ route('reports.index') }}" class="sub-link {{ request()->routeIs('reports.index') ? 'active-sub' : '' }}">Business Intelligence</a>
                <a href="{{ route('reports.pos') }}" class="sub-link {{ request()->routeIs('reports.pos') ? 'active-sub' : '' }}">POS Sales Report</a>
                <a href="{{ route('reports.staff') }}" class="sub-link {{ request()->routeIs('reports.staff') ? 'active-sub' : '' }}">Staff Details Report</a>
                <a href="{{ route('reports.attendance') }}" class="sub-link {{ request()->routeIs('reports.attendance') ? 'active-sub' : '' }}">Staff Attendance Report</a>
                <a href="{{ route('reports.salary') }}" class="sub-link {{ request()->routeIs('reports.salary') ? 'active-sub' : '' }}">Staff Salary Report</a>
                <a href="{{ route('reports.customer-purchases') }}" class="sub-link {{ request()->routeIs('reports.customer-purchases') ? 'active-sub' : '' }}">Customer Purchases</a>
                <a href="{{ route('reports.employee-customers') }}" class="sub-link {{ request()->routeIs('reports.employee-customers') ? 'active-sub' : '' }}">Employee-Customer Link</a>
                @if(auth()->user()->hasPermission('inventory', 'view'))
                <a href="{{ route('inventory.stock-report') }}" class="sub-link {{ request()->routeIs('inventory.stock-report') ? 'active-sub' : '' }}">Stock Report</a>
                <a href="{{ route('inventory.usage-report') }}" class="sub-link {{ request()->routeIs('inventory.usage-report') ? 'active-sub' : '' }}">Usage Report</a>
                @endif
            </div>
        </div>
        @endif

        @if(auth()->user()->hasPermission('admin', 'all') || auth()->user()->hasPermission('business', 'view'))
        <div class="nav-group">
            <button type="button" class="sidebar-link {{ request()->routeIs('staff-roles.index', 'business-settings.*') ? 'active' : '' }}">
                <span class="sidebar-icon"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg></span>
                <span class="link-text">Business</span>
                <svg class="section-chevron" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></button>
            <div class="sub-menu">
                <a href="{{ route('staff-roles.index') }}" class="sub-link {{ request()->routeIs('staff-roles.index') ? 'active-sub' : '' }}">Role Management</a>
                <a href="{{ route('business-settings.index') }}" class="sub-link {{ request()->routeIs('business-settings.*') ? 'active-sub' : '' }}">Business Settings</a>
            </div>
        </div>
        @endif

        @if(auth()->user()->hasPermission('staff', 'view'))
        <div class="nav-group">
            <button type="button" class="sidebar-link {{ request()->routeIs('staff.*', 'staff-hrms.*', 'staff.salary-dashboard') ? 'active' : '' }}">
                <span class="sidebar-icon"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg></span>
                <span class="link-text">Employee Manage</span>
                <svg class="section-chevron" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></button>
            <div class="sub-menu">
                <a href="{{ route('staff.index') }}" class="sub-link {{ request()->routeIs('staff.index', 'staff.show', 'staff.edit') ? 'active-sub' : '' }}">All Employees</a>
                
                @if(auth()->user()->hasPermission('staff', 'create'))
                <a href="{{ route('staff.create') }}" class="sub-link {{ request()->routeIs('staff.create') ? 'active-sub' : '' }}">Add New Employee</a>
                @endif
                
                @if(auth()->user()->hasPermission('staff', 'attendance'))
                <a href="{{ route('staff.attendance-all') }}" class="sub-link {{ request()->routeIs('staff.attendance*') ? 'active-sub' : '' }}">Attendance Log</a>
                @endif

                <a href="{{ route('staff.salary-dashboard') }}" class="sub-link {{ request()->routeIs('staff.salary-dashboard') ? 'active-sub' : '' }}">Salary & Performance</a>
                <a href="{{ route('staff.hrms') }}" class="sub-link {{ request()->routeIs('staff.hrms*') ? 'active-sub' : '' }}">Staff HRMS</a>
            </div>
        </div>
        @endif

        @if(auth()->user()->hasPermission('purchases', 'view'))
        <div class="nav-group">
            <button type="button" class="sidebar-link {{ request()->routeIs('purchases.*') ? 'active' : '' }}" title="Purchasing">
                <span class="sidebar-icon"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 3h2l2.4 11.2a2 2 0 0 0 2 1.6h7.8a2 2 0 0 0 2-1.6L21 7H6"/><circle cx="10" cy="20" r="1"/><circle cx="18" cy="20" r="1"/></svg></span>
                <span class="link-text">Purchasing</span>
                <svg class="section-chevron" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></button>
            <div class="sub-menu">
                <a href="{{ route('purchases.index') }}" class="sub-link {{ request()->routeIs('purchases.index', 'purchases.show', 'purchases.edit', 'purchases.receive') ? 'active-sub' : '' }}">Purchase orders</a>
                <a href="{{ route('purchases.create') }}" class="sub-link {{ request()->routeIs('purchases.create') ? 'active-sub' : '' }}">Create purchase order</a>
            </div>
        </div>
        @endif

        @if(auth()->user()->hasPermission('admin', 'all'))
        <div class="nav-group">
            <button type="button" class="sidebar-link {{ request()->routeIs('promotions.*', 'whatsapp.*') ? 'active' : '' }}" title="Marketing">
                <span class="sidebar-icon"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 11v2a2 2 0 0 0 2 2h2l5 4V5L8 9H6a2 2 0 0 0-2 2Z"/><path d="M16 9a4 4 0 0 1 0 6"/></svg></span>
                <span class="link-text">Marketing</span>
                <svg class="section-chevron" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></button>
            <div class="sub-menu">
                <a href="{{ route('promotions.discount-rules') }}" class="sub-link {{ request()->routeIs('promotions.discount-rules*') ? 'active-sub' : '' }}">Discount rules</a>
                <a href="{{ route('promotions.coupons') }}" class="sub-link {{ request()->routeIs('promotions.coupons*') ? 'active-sub' : '' }}">Coupons</a>
                <a href="{{ route('promotions.gift-cards') }}" class="sub-link {{ request()->routeIs('promotions.gift-cards*') ? 'active-sub' : '' }}">Gift cards</a>
                <a href="{{ route('promotions.membership-alerts') }}" class="sub-link {{ request()->routeIs('promotions.membership-alerts*') ? 'active-sub' : '' }}">Membership alerts</a>
                <a href="{{ route('promotions.package-sessions') }}" class="sub-link {{ request()->routeIs('promotions.package-sessions*') ? 'active-sub' : '' }}">Package sessions</a>
                <a href="{{ route('whatsapp.index') }}" class="sub-link {{ request()->routeIs('whatsapp.*') ? 'active-sub' : '' }}">WhatsApp</a>
            </div>
        </div>
        @endif

    </nav>

    @auth
    <div style="padding:12px 14px;border-top:1px solid #D8DBE0;background:#F0F2F5;flex-shrink:0;">
        <div style="display:flex;align-items:center;gap:10px;padding:10px 12px;background:#E8EAED;border:1px solid #D8DBE0;border-radius:12px;">
            <div style="width:34px;height:34px;border-radius:9px;background:#3C4048;color:#fff;font-weight:800;font-size:.82rem;display:flex;align-items:center;justify-content:center;flex-shrink:0;letter-spacing:.01em;">
                {{ strtoupper(substr(auth()->user()->name,0,1)) }}
            </div>
            <div style="flex:1;min-width:0;">
                <div style="font-size:.8rem;font-weight:700;color:#18181b;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ auth()->user()->name }}</div>
                <div style="font-size:.6rem;color:#8A909A;text-transform:uppercase;font-weight:700;letter-spacing:.06em;">{{ ucfirst(auth()->user()->role ?? 'Admin') }}</div>
            </div>
            <form method="POST" action="{{ route('logout') }}" style="flex-shrink:0;">
                @csrf
                <button type="submit" title="Logout"
                    style="width:32px;height:32px;border-radius:8px;background:#F5F3FF;border:1.5px solid #DDD6FE;color:#4C1D95;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .18s;flex-shrink:0;"
                    onmouseenter="this.style.background='#EDE9FE';this.style.borderColor='#8B5CF6';this.style.transform='scale(1.05)'"
                    onmouseleave="this.style.background='#F5F3FF';this.style.borderColor='#DDD6FE';this.style.transform='scale(1)'">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                </button>
            </form>
        </div>
    </div>
    @endauth
</aside>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navGroups = document.querySelectorAll('.nav-group');

        navGroups.forEach(group => {
            const parentLink = group.querySelector('.sidebar-link');
            const subMenu = group.querySelector('.sub-menu');

            if (parentLink && subMenu) {
                const groupName = parentLink.querySelector('.link-text')?.textContent.trim() || 'Navigation';
                const menuId = 'nav-menu-' + groupName.toLowerCase().replace(/[^a-z0-9]+/g, '-');
                subMenu.id = menuId;
                parentLink.setAttribute('aria-controls', menuId);
                parentLink.setAttribute('aria-label', groupName);
                // Determine if this group should be open initially
                const isActive = parentLink.classList.contains('active') || subMenu.querySelector('.active-sub');
                if (isActive) {
                    group.classList.add('expanded');
                }
                parentLink.setAttribute('aria-expanded', group.classList.contains('expanded') ? 'true' : 'false');

                subMenu.dataset.title = groupName;

                let closeTimer;
                const openFlyout = function() {
                    if (window.innerWidth < 768 || !document.getElementById('appSidebar').classList.contains('collapsed')) return;
                    clearTimeout(closeTimer);
                    document.querySelectorAll('.nav-group.flyout-open').forEach(other => {
                        if (other !== group) other.classList.remove('flyout-open');
                    });
                    subMenu.style.visibility = 'hidden';
                    group.classList.add('flyout-open');
                    requestAnimationFrame(function() {
                        const triggerRect = parentLink.getBoundingClientRect();
                        const menuHeight = Math.min(subMenu.scrollHeight, window.innerHeight - 24);
                        const idealTop = triggerRect.top - 8;
                        const top = Math.max(12, Math.min(idealTop, window.innerHeight - menuHeight - 12));
                        subMenu.style.setProperty('--flyout-top', top + 'px');
                        subMenu.style.visibility = 'visible';
                    });
                };
                const scheduleClose = function() {
                    clearTimeout(closeTimer);
                    closeTimer = setTimeout(() => {
                        group.classList.remove('flyout-open');
                        subMenu.style.removeProperty('visibility');
                    }, 650);
                };
                group.addEventListener('mouseenter', openFlyout);
                group.addEventListener('mouseleave', scheduleClose);
                subMenu.addEventListener('mouseenter', () => clearTimeout(closeTimer));
                subMenu.addEventListener('mouseleave', scheduleClose);
                parentLink.addEventListener('focus', openFlyout);
                group.addEventListener('focusout', function(event) {
                    if (!group.contains(event.relatedTarget)) scheduleClose();
                });

                // Expanded sidebar uses click accordions; compact mode pins a flyout.
                parentLink.addEventListener('click', function(e) {
                    if (window.innerWidth >= 768 && document.getElementById('appSidebar').classList.contains('collapsed')) {
                        e.preventDefault();
                        group.classList.contains('flyout-open') ? scheduleClose() : openFlyout();
                        return;
                    }
                    group.classList.toggle('expanded');
                    parentLink.setAttribute('aria-expanded', group.classList.contains('expanded') ? 'true' : 'false');
                });
            }
        });
    });
</script>
