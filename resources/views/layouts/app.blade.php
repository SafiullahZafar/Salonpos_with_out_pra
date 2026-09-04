<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#4C1D95">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Veloura POS">
    <title>{{ config('app.name', 'Veloura Salon') }} — @yield('title', 'Dashboard')</title>

    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <link rel="apple-touch-icon" href="{{ asset('icons/icon-192.svg') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background: #ffffff;
            color: #111827;
        }

        /* â”€â”€â”€ Layout shell â”€â”€â”€ */
        .app-shell {
            display: flex;
            min-height: 100vh;
        }

        /* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
           SIDEBAR
        â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
        .sidebar {
            width: 240px;
            min-height: 100vh;
            background: #F0F2F5;
            border-right: 1px solid #D8DBE0;
            box-shadow: 2px 0 12px rgba(0,0,0,.06);
            display: flex;
            flex-direction: column;
            position: fixed;
            left: 0; top: 0; bottom: 0;
            z-index: 50;
            overflow-y: auto;
            overflow-x: hidden;
            transition: width .25s cubic-bezier(.4,0,.2,1), transform .25s cubic-bezier(.4,0,.2,1);
        }

        .sidebar.collapsed { width: 0; border-right: none; overflow: hidden; }

        /* Mobile: sidebar slides in as a full-height drawer */
        @media(max-width:768px){
            .sidebar {
                width: 260px !important;
                transform: translateX(-100%);
                box-shadow: none;
                z-index: 200;
            }
            .sidebar.mobile-open {
                transform: translateX(0);
                box-shadow: 4px 0 24px rgba(0,0,0,.18);
            }
        }

        /* Overlay backdrop for mobile drawer */
        .sidebar-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.45);
            z-index: 199;
            backdrop-filter: blur(2px);
        }
        .sidebar-backdrop.visible { display: block; }

        /* â”€â”€ Header â”€â”€ */
        .sidebar-header {
            background: #F0F2F5;
            border-bottom: 1px solid #D8DBE0;
            padding: 20px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            min-height: 68px;
            flex-shrink: 0;
        }

        .sidebar-logo-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: #18181b;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(0,0,0,.15);
        }

        .sidebar-logo-text-wrap {
            min-width: 0;
            overflow: hidden;
            transition: opacity .2s, width .25s;
            white-space: nowrap;
        }

        .sidebar.collapsed .sidebar-logo-text-wrap { opacity: 0; width: 0; pointer-events: none; }

        .sidebar-logo-text {
            font-size: 1rem;
            font-weight: 800;
            color: #18181b;
            line-height: 1.2;
            text-decoration: none;
            display: block;
            letter-spacing: -.02em;
        }

        .sidebar-logo-sub {
            font-size: 0.58rem;
            color: #a1a1aa;
            font-weight: 500;
            letter-spacing: .02em;
        }

        /* â”€â”€ Nav â”€â”€ */
        .sidebar-nav { flex: 1; padding: 10px 12px 20px; }

        /* â”€â”€ Section labels â”€â”€ */
        .sidebar-section-label {
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            border-radius: 8px;
            padding: 10px 8px 4px;
            transition: background .15s;
            user-select: none;
            margin-top: 8px;
        }

        .sidebar-section-label:hover { background: #fafafa; }

        .label-text {
            font-size: 0.6rem;
            font-weight: 700;
            color: #d4d4d8;
            text-transform: uppercase;
            letter-spacing: .12em;
            transition: color .15s, opacity .2s;
        }

        .sidebar-section-label.open .label-text { color: #a1a1aa; }
        .sidebar.collapsed .label-text { opacity: 0; pointer-events: none; }

        .section-chevron {
            flex-shrink: 0;
            color: #d4d4d8;
            transition: transform .22s ease, opacity .2s;
        }

        .sidebar-section-label.open .section-chevron { transform: rotate(180deg); color: #a1a1aa; }
        .sidebar.collapsed .section-chevron { opacity: 0; }

        .nav-section { overflow: hidden; max-height: 0; transition: max-height .3s cubic-bezier(.4,0,.2,1); }
        .nav-section.open { max-height: 800px; }

        /* â”€â”€ Nav links â”€â”€ */
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 10px;
            border-radius: 10px;
            color: #71717a;
            font-size: 0.83rem;
            font-weight: 500;
            text-decoration: none;
            transition: all .18s cubic-bezier(.4,0,.2,1);
            margin-bottom: 2px;
            position: relative;
            white-space: nowrap;
            overflow: hidden;
        }

        /* Hover â€” darker gray */
        .sidebar-link:hover {
            background: #DDE0E5;
            color: #18181b;
            transform: translateX(2px);
        }

        .sidebar-link:hover .sidebar-icon {
            color: #18181b;
            background: transparent;
        }

        /* Active â€” soft yellowish */
        .sidebar-link.active {
            background: #EDE9FE;
            color: #4C1D95;
            font-weight: 700;
            box-shadow: 0 1px 6px rgba(212,184,0,.15);
            border: 1px solid #7C3AED;
        }

        .sidebar-link.active::before { display: none; }

        .sidebar-link.active .sidebar-icon {
            background: transparent;
            color: #4C1D95;
        }

        /* Icon box */
        .sidebar-icon {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            background: transparent;
            color: #8A909A;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: background .18s, color .18s;
        }

        .link-text { transition: opacity .2s; overflow: hidden; }
        .sidebar.collapsed .link-text { opacity: 0; width: 0; }
        .sidebar.collapsed .sidebar-link { justify-content: center; padding: 9px 0; transform: none !important; }
        .sidebar.collapsed .sidebar-link .sidebar-icon { margin: 0 auto; }

        /* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
           TOP HEADER
        â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
        .top-header {
            height: 56px;
            background: #F0F2F5;
            border-bottom: none;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 22px;
            gap: 12px;
            position: sticky;
            top: 0;
            z-index: 40;
            box-shadow: 0 1px 0 #D8DBE0;
        }

        .top-header-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Page title */
        .top-header-page-title {
            font-size: .875rem;
            font-weight: 700;
            color: #3C4048;
            letter-spacing: -.01em;
        }

        /* Sidebar toggle */
        .sidebar-toggle-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: #E8EAED;
            border: none;
            color: #5C6370;
            cursor: pointer;
            transition: background .15s, color .15s;
            flex-shrink: 0;
        }

        .sidebar-toggle-btn:hover {
            background: #DDE0E5;
            color: #18181b;
        }

        .top-header-divider {
            width: 1px;
            height: 20px;
            background: #D8DBE0;
            flex-shrink: 0;
        }

        .top-header-right {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Generic top-bar chip */
        .top-header-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 13px;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: background .15s, color .15s;
            border: none;
            text-decoration: none;
            color: #5C6370;
            background: #E8EAED;
        }

        .top-header-btn:hover {
            background: #DDE0E5;
            color: #18181b;
        }

        /* POS button â€” yellow accent, no border */
        .top-header-btn.pos-btn {
            background: #EDE9FE;
            color: #4C1D95;
            font-weight: 700;
            border: none;
        }

        .top-header-btn.pos-btn:hover {
            background: #DDD6FE;
            color: #3B0764;
            transform: translateY(-1px);
        }

        /* Date chip */
        .top-header-date {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.78rem;
            font-weight: 600;
            color: #5C6370;
            background: #E8EAED;
            border: none;
        }

        /* User chip */
        .top-header-user {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 4px 12px 4px 4px;
            border-radius: 99px;
            font-size: 0.8rem;
            font-weight: 600;
            color: #3C4048;
            background: #E8EAED;
            border: none;
            transition: background .15s;
        }

        .top-header-user:hover {
            background: #DDE0E5;
        }

        .top-header-avatar {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: #3C4048;
            color: #fff;
            font-weight: 800;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        /* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
           MAIN CONTENT
        â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
        .main-content {
            flex: 1;
            margin-left: 240px;
            min-height: 100vh;
            background: #ffffff;
            display: flex;
            flex-direction: column;
            transition: margin-left .25s cubic-bezier(.4,0,.2,1);
        }

        .main-content.sidebar-collapsed { margin-left: 0; }

        /* Mobile: content always full width */
        @media(max-width:768px){
            .main-content { margin-left: 0 !important; }
        }

        .main-body {
            flex: 1 1 auto;
            padding: 28px;
            min-height: 0;
        }

        @media(max-width:640px){
            .main-body { padding: 16px; }
        }

        .main-footer {
            padding: 16px;
            text-align: center;
            font-size: 0.72rem;
            color: #9ca3af;
            border-top: 1px solid #e5e7eb;
            margin-top: auto;
        }

        /* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
           SHARED COMPONENTS
        â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
        .card {
            background: #ffffff;
            border: 1px solid #EDE9FE;
            border-radius: 16px;
            box-shadow: 0 1px 6px rgba(124,58,237,.06);
        }

        .btn-primary {
            background: linear-gradient(135deg, #7C3AED 0%, #6D28D9 100%);
            color: #ffffff;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            transition: all .25s;
            font-family: 'Inter', sans-serif;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(124,58,237,.35);
        }

        .btn-primary:disabled {
            opacity: .5;
            cursor: not-allowed;
            transform: none;
        }

        .badge-green { background:#EDE9FE; color:#4C1D95; border-radius:99px; padding:2px 10px; font-size:.72rem; font-weight:600; }
        .badge-blue  { background:#EDE9FE; color:#4C1D95; border-radius:99px; padding:2px 10px; font-size:.72rem; font-weight:600; }
        .badge-amber { background:#EDE9FE; color:#4C1D95; border-radius:99px; padding:2px 10px; font-size:.72rem; font-weight:600; }
        .badge-red   { background:#EDE9FE; color:#4C1D95; border-radius:99px; padding:2px 10px; font-size:.72rem; font-weight:600; }

        .gradient-text {
            background: linear-gradient(135deg, #7C3AED 0%, #6D28D9 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* â”€â”€ Tables â”€â”€ */
        table { width: 100%; border-collapse: collapse; }
        table thead tr { background: #F5F3FF; }
        table thead th { color: #4C1D95; font-size: .72rem; text-transform: uppercase; letter-spacing: .06em; padding: 14px 20px; font-weight: 700; text-align: left; }
        table tbody tr { border-bottom: 1px solid #F5F3FF; transition: background .15s; }
        table tbody tr:hover { background: #f9fffe; }
        table tbody td { padding: 14px 20px; font-size: .875rem; }

        /* â”€â”€ Inputs â”€â”€ */
        input[type=text], input[type=email], input[type=password],
        input[type=number], input[type=tel], select, textarea {
            border: 1px solid #DDD6FE;
            border-radius: 10px;
            background: #f9fafb;
            color: #1e293b;
            font-family: 'Inter', sans-serif;
            transition: border-color .2s, box-shadow .2s;
        }

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #6D28D9;
            box-shadow: 0 0 0 3px rgba(109,40,217,.2);
            background: #ffffff;
        }

        /* â”€â”€ Branch Switcher â”€â”€ */
        .branch-switcher-wrap {
            margin-right: 12px;
            position: relative;
            display: flex;
            align-items: center;
        }

        .branch-select {
            appearance: none;
            background: #fff;
            border: 1.5px solid #F0F2F5;
            border-radius: 99px;
            padding: 6px 36px 6px 14px;
            font-size: 0.78rem;
            font-weight: 700;
            color: #475569;
            cursor: pointer;
            transition: all .2s;
            box-shadow: 0 2px 6px rgba(0,0,0,.03);
            font-family: inherit;
        }

        .branch-select:hover {
            border-color: #6D28D9;
            color: #1e293b;
            box-shadow: 0 4px 10px rgba(0,0,0,.06);
        }

        .branch-switcher-icon {
            position: absolute;
            right: 12px;
            pointer-events: none;
            color: #94a3b8;
        }

        /* â”€â”€ Scrollbar â”€â”€ */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: #f5f6fa; }
        ::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 99px; }
        ::-webkit-scrollbar-thumb:hover { background: #cbd5e1; }
        /* Hide POS button on mobile â€” not usable on small screens */
        @media(max-width:768px){
            #pos-header-btn { display: none !important; }
            .top-header-date { display: none; }
            .branch-switcher-wrap { display: none; }
            .top-header-user span { display: none; }
            .top-header-user { padding: 4px; border-radius: 50%; }
        }

        /* â”€â”€â”€ Mobile Restriction: hide navigation chrome â”€â”€â”€ */
        @media(max-width: 768px) {
            /* Hide sidebar entirely */
            #appSidebar,
            .sidebar {
                display: none !important;
            }
            /* Hide sidebar toggle button */
            #sidebarToggle {
                display: none !important;
            }
            /* Hide backdrop */
            #sidebar-backdrop {
                display: none !important;
            }
            /* Hide panel navigation links (View All, View) */
            .panel-link {
                display: none;
            }
        }
    </style>
    <style>
        /* New application shell overrides legacy layout rules while page templates migrate. */
        html,body,.app-shell { background:#FFFFFF !important; }
        body { font-family:'Inter','Aptos',system-ui,sans-serif;background:#FFFFFF !important;color:var(--ink); }
        .main-content,.main-body { background:#FFFFFF !important; }
        .main-content { margin-left:260px !important;min-width:0;transition:margin-left .24s cubic-bezier(.4,0,.2,1); }
        .main-content.sidebar-collapsed { margin-left:76px !important; }
        .top-header { height:72px !important;padding:0 24px !important;background:#FFFFFF !important;border-bottom:1px solid var(--border) !important;box-shadow:none !important;backdrop-filter:none; }
        .top-header-left { min-width:0; }
        .top-header-page-title { color:var(--brand-800) !important;font-size:14px !important;font-weight:750 !important;white-space:nowrap;overflow:hidden;text-overflow:ellipsis; }
        .top-header-page-title::before { content:'Workspace';display:block;color:var(--muted);font-size:10px;font-weight:650;letter-spacing:.07em;text-transform:uppercase;line-height:1.1; }
        .top-header-divider { background:var(--border) !important; }
        .sidebar-toggle-btn { background:var(--brand-50) !important;color:var(--brand-700) !important;border:1px solid var(--brand-200) !important; }
        .sidebar-toggle-btn:hover { background:var(--brand-100) !important;color:var(--brand-900) !important; }
        .top-header-right { flex-shrink:0; }
        .top-header-btn,.top-header-date,.top-header-user { background:#fff !important;color:var(--muted) !important;border:1px solid var(--border) !important; }
        .top-header-btn:hover,.top-header-user:hover { color:var(--brand-800) !important;border-color:var(--brand-200) !important;background:var(--brand-50) !important; }
        .top-header-btn.pos-btn { background:var(--brand-700) !important;color:#fff !important;border-color:var(--brand-700) !important;box-shadow:0 5px 14px rgba(109,40,217,.18); }
        .top-header-btn.pos-btn:hover { background:var(--brand-600) !important;color:#fff !important; }
        .top-header-avatar { background:var(--brand-800) !important; }
        .branch-select { color:var(--brand-800) !important;background:#fff !important;border-color:var(--border) !important;box-shadow:none !important; }
        .branch-select:hover,.branch-select:focus { border-color:var(--brand-400) !important; }
        .main-body { width:100%;max-width:1600px;margin:0 auto;padding:24px !important; }
        .sidebar-backdrop { background:rgba(23,19,31,.48) !important;backdrop-filter:blur(3px); }
        @media(max-width:1023px){ .ui-command-search{display:none;} }
        @media(max-width:768px){
            #appSidebar,.sidebar { display:flex !important; }
            #sidebarToggle { display:inline-flex !important; }
            #sidebar-backdrop.visible { display:block !important; }
            .main-content { margin-left:0 !important; }
            .top-header { height:64px !important;padding:0 16px !important; }
            .main-body { padding:16px !important; }
            .top-header-date,.branch-switcher-wrap,.top-header-user { display:none !important; }
            #pos-header-btn { display:none !important; }
            .panel-link,.qa-pos-link { display:inline-flex !important; }
        }

        /* Refined command header */
        .top-header{
            height:82px !important;
            display:grid !important;
            grid-template-columns:minmax(210px,.75fr) minmax(260px,480px) minmax(max-content,1fr);
            align-items:center;
            gap:22px !important;
            padding:0 26px !important;
            background:#FFFFFF !important;
            border-bottom:1px solid var(--border) !important;
            box-shadow:0 7px 24px rgba(59,7,100,.045) !important;
        }
        .top-header-left{display:flex;align-items:center;gap:13px;min-width:0}
        .sidebar-toggle-btn{width:42px !important;height:42px !important;border-radius:12px !important;background:#fff !important;border:1px solid var(--border) !important;box-shadow:0 4px 12px rgba(59,7,100,.06)}
        .sidebar-toggle-btn:hover{background:var(--brand-50) !important;border-color:var(--brand-200) !important;transform:translateY(-1px)}
        .top-header-divider{display:none}
        .top-header-title-block{min-width:0}
        .top-header-kicker{display:flex;align-items:center;gap:6px;margin-bottom:3px;color:var(--brand-600);font-size:10px;font-weight:800;letter-spacing:.11em;text-transform:uppercase;white-space:nowrap}
        .top-header-kicker::before{content:'';width:6px;height:6px;border-radius:50%;background:var(--brand-600);box-shadow:0 0 0 4px var(--brand-100)}
        .top-header-page-title{display:block;color:var(--brand-900) !important;font-size:17px !important;font-weight:780 !important;line-height:1.2;letter-spacing:-.025em !important}
        .top-header-page-title::before{display:none !important}
        .ui-command-search{width:100%;max-width:480px;justify-self:center}
        .ui-command-search input{height:44px;min-height:44px;padding-left:43px;background:#F8F7FA;border-color:var(--border);border-radius:13px}
        .ui-command-search input:focus{background:#fff;box-shadow:0 0 0 4px rgba(124,58,237,.09)}
        .ui-command-search svg{left:15px;color:var(--brand-500)}
        .ui-command-search kbd{right:11px;color:var(--brand-700);background:#fff;border-color:var(--brand-200)}
        .top-header-right{justify-self:end;display:flex;align-items:center;gap:8px;min-width:0}
        .branch-switcher-wrap{height:42px;display:flex;align-items:center;padding-left:11px;background:#fff;border:1px solid var(--border);border-radius:12px;transition:.2s}
        .branch-switcher-wrap::before{content:'';width:8px;height:8px;border-radius:50%;background:var(--brand-500);box-shadow:0 0 0 3px var(--brand-100);flex:0 0 auto}
        .branch-switcher-wrap:hover,.branch-switcher-wrap:focus-within{border-color:var(--brand-300);background:var(--brand-50)}
        .branch-switcher-wrap form{height:100%}
        .branch-select{height:40px !important;max-width:180px;padding:0 30px 0 9px !important;background:transparent !important;border:0 !important;font-size:12px !important;font-weight:750 !important}
        .branch-select:focus{box-shadow:none !important}
        .branch-switcher-icon{right:10px !important;color:var(--brand-600) !important}
        .top-header-date{height:42px;padding:0 12px !important;gap:8px !important;border-radius:12px !important;background:#fff !important}
        .top-header-date svg{color:var(--brand-600)}
        .date-copy{display:flex;flex-direction:column;line-height:1.12}
        .date-copy strong{color:var(--ink);font-size:11px;font-weight:750}
        .date-copy span{color:var(--muted);font-size:9px;font-weight:650;text-transform:uppercase;letter-spacing:.05em}
        .top-header-btn.pos-btn{height:42px;padding:0 15px !important;border-radius:12px !important;gap:8px !important;white-space:nowrap}
        .top-header-btn.pos-btn .pos-arrow{opacity:.72;transition:transform .18s}
        .top-header-btn.pos-btn:hover .pos-arrow{transform:translateX(2px)}
        .top-header-user{height:42px;padding:3px 10px 3px 4px !important;gap:8px !important;border-radius:12px !important;background:#fff !important}
        .top-header-avatar{width:34px !important;height:34px !important;border-radius:10px !important;background:linear-gradient(145deg,var(--brand-900),var(--brand-600)) !important}
        .top-header-user-copy{display:flex;min-width:0;max-width:115px;flex-direction:column;line-height:1.15}
        .top-header-user-copy strong{overflow:hidden;color:var(--ink);font-size:11px;text-overflow:ellipsis;white-space:nowrap}
        .top-header-user-copy small{margin-top:2px;color:var(--muted);font-size:9px;font-weight:650;text-transform:capitalize}
        @media(max-width:1280px){.top-header{grid-template-columns:minmax(190px,.7fr) minmax(220px,390px) auto;gap:14px !important}.top-header-date{display:none !important}.branch-select{max-width:145px}}
        @media(max-width:1050px){.top-header{grid-template-columns:1fr auto}.ui-command-search{display:none}.top-header-user{display:none !important}}
        @media(max-width:768px){.top-header{height:70px !important;grid-template-columns:1fr auto;padding:0 14px !important;gap:10px !important}.sidebar-toggle-btn{width:40px !important;height:40px !important}.top-header-kicker{display:none}.top-header-page-title{font-size:15px !important}.branch-switcher-wrap,.top-header-date,.top-header-user{display:none !important}#pos-header-btn{display:inline-flex !important;width:42px;padding:0 !important;justify-content:center}#pos-header-btn .pos-label,#pos-header-btn .pos-arrow{display:none}.main-body{padding-top:18px !important}}

    </style>
</head>
<body>
<div id="sidebar-backdrop" class="sidebar-backdrop"></div>
<div class="app-shell">

    @include('layouts.sidebar')

    <div class="main-content" id="mainContent">

        {{-- Top Header --}}
        <header class="top-header">
            <div class="top-header-left">
                {{-- Sidebar collapse toggle --}}
                <button class="sidebar-toggle-btn" id="sidebarToggle" title="Toggle sidebar" aria-label="Toggle sidebar">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <rect x="3" y="3" width="18" height="18" rx="2"/>
                        <path d="M9 3v18"/>
                        <path d="M14 9l-2 3 2 3"/>
                    </svg>
                </button>
                <div class="top-header-divider"></div>
                <div class="top-header-title-block">
                    <span class="top-header-kicker">Veloura workspace</span>
                    <span class="top-header-page-title">@yield('title', 'Dashboard')</span>
                </div>
            </div>

            <div class="ui-command-search" role="search">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m20 20-4-4"/></svg>
                <input id="globalCommandSearch" type="search" autocomplete="off" placeholder="Find a page or action..." aria-label="Find a page or action">
                <kbd>Ctrl K</kbd>
            </div>

            <div class="top-header-right">
                {{-- Branch Switcher / Location Badge --}}
                @if(auth()->check())
                    @if(auth()->user()->role === 'admin' || is_null(auth()->user()->branch_id))
                        {{-- Global Switcher for Admins/Global Users --}}
                        <div class="branch-switcher-wrap">
                            <form action="{{ route('branch.switch') }}" method="POST" id="branchSwitchForm">
                                @csrf
                                <select name="branch_id" class="branch-select" onchange="document.getElementById('branchSwitchForm').submit()">
                                    @foreach(\App\Models\Branch::where('is_active', true)->get() as $branch)
                                        <option value="{{ $branch->id }}" {{ session('current_branch_id', 1) == $branch->id ? 'selected' : '' }}>
                                            {{ $branch->name }} Branch
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                            <div class="branch-switcher-icon">
                                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                            </div>
                        </div>
                    @else
                        {{-- Strict Location Badge for Locked Staff --}}
                        <div class="top-header-date" style="background:#f1f5f9; color:#64748b; border:1px solid #e2e8f0; margin-right:8px;">
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            {{ auth()->user()->branch->name ?? 'Assigned Branch' }}
                        </div>
                    @endif
                @endif

                {{-- Date chip --}}
                <div class="top-header-date">
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    <span class="date-copy"><strong>{{ now()->format('M j, Y') }}</strong><span>{{ now()->format('l') }}</span></span>
                </div>

                {{-- POS button: hidden on mobile (POS not suitable for small screens) --}}
                <a href="{{ route('pos.index') }}" class="top-header-btn pos-btn" id="pos-header-btn">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                    <span class="pos-label">Open POS</span>
                    <svg class="pos-arrow" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14m-5-5 5 5-5 5"/></svg>
                </a>

                @auth
                <div class="top-header-user">
                    <div class="top-header-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                    <span class="top-header-user-copy"><strong>{{ auth()->user()->name }}</strong><small>{{ auth()->user()->role ?? 'Team member' }}</small></span>
                </div>
                @endauth
            </div>
        </header>

        <div class="main-body">
            @if($errors->any())
                <div class="ui-alert" role="alert">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif
            
            @if(session('success'))
                <div class="ui-alert" role="status">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="ui-alert" role="alert">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @php
                $workspaceLabel = null;
                $workspaceTabs = [];

                if (request()->routeIs('appointments.*')) {
                    $workspaceLabel = 'Appointments';
                    $workspaceTabs = [
                        ['label' => 'List', 'href' => route('appointments.index'), 'active' => request()->routeIs('appointments.index')],
                        ['label' => 'Calendar', 'href' => route('appointments.calendar'), 'active' => request()->routeIs('appointments.calendar')],
                        ['label' => 'New appointment', 'href' => route('appointments.create'), 'active' => request()->routeIs('appointments.create')],
                    ];
                } elseif (request()->routeIs('customers.*', 'suppliers.*')) {
                    $workspaceLabel = 'Clients & partners';
                    if (auth()->user()->hasPermission('customers', 'view')) {
                        $workspaceTabs[] = ['label' => 'Clients', 'href' => route('customers.index'), 'active' => request()->routeIs('customers.*')];
                    }
                    if (auth()->user()->hasPermission('suppliers', 'view')) {
                        $workspaceTabs[] = ['label' => 'Suppliers', 'href' => route('suppliers.index'), 'active' => request()->routeIs('suppliers.*')];
                    }
                } elseif (request()->routeIs('products.*', 'inventory.*', 'services.*', 'packages.*', 'purchases.*')) {
                    $workspaceLabel = 'Catalog & stock';
                    if (auth()->user()->hasPermission('inventory', 'view')) {
                        $workspaceTabs = [
                            ['label' => 'Products', 'href' => route('products.index'), 'active' => request()->routeIs('products.*')],
                            ['label' => 'Inventory', 'href' => route('inventory.dashboard'), 'active' => request()->routeIs('inventory.*')],
                            ['label' => 'Services', 'href' => route('services.index'), 'active' => request()->routeIs('services.*')],
                            ['label' => 'Packages', 'href' => route('packages.index'), 'active' => request()->routeIs('packages.*')],
                        ];
                    }
                    if (auth()->user()->hasPermission('purchases', 'view')) {
                        $workspaceTabs[] = ['label' => 'Purchasing', 'href' => route('purchases.index'), 'active' => request()->routeIs('purchases.*')];
                    }
                } elseif (request()->routeIs('invoices.*', 'reconciliation.*', 'expenses.*')) {
                    $workspaceLabel = 'History & finance';
                    $workspaceTabs = [
                        ['label' => 'Sales', 'href' => route('invoices.index', ['tab' => 'sales']), 'active' => request()->routeIs('invoices.*') && request('tab', 'sales') === 'sales'],
                        ['label' => 'Purchases', 'href' => route('invoices.index', ['tab' => 'purchases']), 'active' => request()->routeIs('invoices.index') && request('tab') === 'purchases'],
                        ['label' => 'Reconciliation', 'href' => route('invoices.index', ['tab' => 'reconciliation']), 'active' => request()->routeIs('reconciliation.*') || (request()->routeIs('invoices.index') && request('tab') === 'reconciliation')],
                        ['label' => 'Expenses', 'href' => route('invoices.index', ['tab' => 'expenses']), 'active' => request()->routeIs('expenses.*') || (request()->routeIs('invoices.index') && request('tab') === 'expenses')],
                    ];
                } elseif (request()->routeIs('staff.*', 'staff-roles.*', 'business-settings.*')) {
                    $workspaceLabel = 'People';
                    if (auth()->user()->hasPermission('staff', 'view')) {
                        $workspaceTabs = [
                            ['label' => 'Directory', 'href' => route('staff.index'), 'active' => request()->routeIs('staff.index', 'staff.show', 'staff.create', 'staff.edit')],
                            ['label' => 'Attendance', 'href' => route('staff.attendance-all'), 'active' => request()->routeIs('staff.attendance*')],
                            ['label' => 'HRMS', 'href' => route('staff.hrms'), 'active' => request()->routeIs('staff.hrms*')],
                            ['label' => 'Salary', 'href' => route('staff.salary-dashboard'), 'active' => request()->routeIs('staff.salary*')],
                        ];
                    }
                    if (auth()->user()->hasPermission('business', 'view')) {
                        $workspaceTabs[] = ['label' => 'Roles & settings', 'href' => route('staff-roles.index'), 'active' => request()->routeIs('staff-roles.*', 'business-settings.*')];
                    }
                } elseif (request()->routeIs('reports.*')) {
                    $workspaceLabel = 'Reports';
                    $workspaceTabs = [
                        ['label' => 'Overview', 'href' => route('reports.index'), 'active' => request()->routeIs('reports.index')],
                        ['label' => 'POS', 'href' => route('reports.pos'), 'active' => request()->routeIs('reports.pos')],
                        ['label' => 'Staff', 'href' => route('reports.staff'), 'active' => request()->routeIs('reports.staff')],
                        ['label' => 'Attendance', 'href' => route('reports.attendance'), 'active' => request()->routeIs('reports.attendance')],
                        ['label' => 'Salary', 'href' => route('reports.salary'), 'active' => request()->routeIs('reports.salary')],
                        ['label' => 'Customer purchases', 'href' => route('reports.customer-purchases'), 'active' => request()->routeIs('reports.customer-purchases')],
                        ['label' => 'Employee clients', 'href' => route('reports.employee-customers'), 'active' => request()->routeIs('reports.employee-customers')],
                    ];
                } elseif (request()->routeIs('promotions.*', 'whatsapp.*')) {
                    $workspaceLabel = 'Marketing';
                    $workspaceTabs = [
                        ['label' => 'Discount rules', 'href' => route('promotions.discount-rules'), 'active' => request()->routeIs('promotions.discount-rules*')],
                        ['label' => 'Coupons', 'href' => route('promotions.coupons'), 'active' => request()->routeIs('promotions.coupons*')],
                        ['label' => 'Gift cards', 'href' => route('promotions.gift-cards'), 'active' => request()->routeIs('promotions.gift-cards*')],
                        ['label' => 'Membership alerts', 'href' => route('promotions.membership-alerts'), 'active' => request()->routeIs('promotions.membership-alerts*')],
                        ['label' => 'Package sessions', 'href' => route('promotions.package-sessions'), 'active' => request()->routeIs('promotions.package-sessions*')],
                        ['label' => 'WhatsApp', 'href' => route('whatsapp.index'), 'active' => request()->routeIs('whatsapp.*')],
                    ];
                }
            @endphp

            @if($workspaceLabel && count($workspaceTabs))
                <x-ui.workspace-tabs :label="$workspaceLabel" :tabs="$workspaceTabs" />
            @endif

            @yield('content')
        </div>
    </div>

</div>

<script>
(function () {
    const sidebar    = document.getElementById('appSidebar');
    const mainContent = document.getElementById('mainContent');
    const toggleBtn  = document.getElementById('sidebarToggle');
    const backdrop   = document.getElementById('sidebar-backdrop');
    const isMobile   = () => window.innerWidth <= 768;

    // â”€â”€ Mobile drawer toggle â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€
    function openMobileDrawer() {
        sidebar.classList.add('mobile-open');
        backdrop.classList.add('visible');
        document.body.style.overflow = 'hidden';
    }

    function closeMobileDrawer() {
        sidebar.classList.remove('mobile-open');
        backdrop.classList.remove('visible');
        document.body.style.overflow = '';
    }

    backdrop.addEventListener('click', closeMobileDrawer);

    // â”€â”€ Sidebar collapse (desktop) â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€
    const COLLAPSED_KEY = 'sm_sidebar_collapsed_v2';

    function applySidebarState(collapsed, animate) {
        if (!animate) {
            sidebar.style.transition    = 'none';
            mainContent.style.transition = 'none';
        }
        sidebar.classList.toggle('collapsed', collapsed);
        mainContent.classList.toggle('sidebar-collapsed', collapsed);
        if (!animate) {
            sidebar.offsetHeight;
            sidebar.style.transition    = '';
            mainContent.style.transition = '';
        }
    }

    // Restore desktop state on load (no animation)
    if (!isMobile()) {
        const storedState = localStorage.getItem(COLLAPSED_KEY);
        const isCollapsed = storedState === null ? true : storedState === '1';
        applySidebarState(isCollapsed, false);
    }

    toggleBtn.addEventListener('click', function () {
        if (isMobile()) {
            // Mobile: toggle drawer
            if (sidebar.classList.contains('mobile-open')) {
                closeMobileDrawer();
            } else {
                openMobileDrawer();
            }
        } else {
            // Desktop: collapse/expand sidebar
            const nowCollapsed = !sidebar.classList.contains('collapsed');
            applySidebarState(nowCollapsed, true);
            localStorage.setItem(COLLAPSED_KEY, nowCollapsed ? '1' : '0');
        }
    });

    // Close mobile drawer when a nav link is clicked
    sidebar.querySelectorAll('a.sidebar-link, .sub-link').forEach(function(link) {
        link.addEventListener('click', function() {
            if (isMobile()) closeMobileDrawer();
        });
    });

    // Handle resize: close mobile drawer if resizing to desktop
    window.addEventListener('resize', function() {
        if (!isMobile()) {
            closeMobileDrawer();
            const storedState = localStorage.getItem(COLLAPSED_KEY);
            const isCollapsed = storedState === null ? true : storedState === '1';
            applySidebarState(isCollapsed, false);
        }
    });

    // â”€â”€ Section collapse (accordion) â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€
    const SECTIONS_KEY = 'sm_sections_open';

    function getOpenSections() {
        try {
            const stored = localStorage.getItem(SECTIONS_KEY);
            return stored ? JSON.parse(stored) : { admin: true, operations: true, hr: true, inventory: true, reports: true, whatsapp: true, promotions: true };
        } catch { return { admin: true, operations: true, hr: true, inventory: true, reports: true, whatsapp: true, promotions: true }; }
    }

    function saveOpenSections(map) {
        localStorage.setItem(SECTIONS_KEY, JSON.stringify(map));
    }

    // Lightweight command search: focuses with Ctrl/Cmd+K and opens the best
    // existing permitted destination on Enter. No routes are duplicated here.
    const commandSearch = document.getElementById('globalCommandSearch');
    if (commandSearch) {
        document.addEventListener('keydown', function (event) {
            if ((event.ctrlKey || event.metaKey) && event.key.toLowerCase() === 'k') {
                event.preventDefault();
                commandSearch.focus();
                commandSearch.select();
            }
        });
        commandSearch.addEventListener('keydown', function (event) {
            if (event.key !== 'Enter') return;
            const query = commandSearch.value.trim().toLowerCase();
            if (!query) return;
            const match = Array.from(sidebar.querySelectorAll('a.sidebar-link, a.sub-link')).find(function (link) {
                return link.textContent.trim().toLowerCase().includes(query);
            });
            if (match) window.location.href = match.href;
        });
    }

    const openMap = getOpenSections();
    const allLabels = document.querySelectorAll('.sidebar-section-label');

    // Determine which section is currently active (has an active link)
    let activeSection = null;
    allLabels.forEach(function(label) {
        const section = label.dataset.section;
        const body = document.getElementById('section-' + section);
        if (body && body.querySelector('.sidebar-link.active')) {
            activeSection = section;
        }
    });

    // Apply initial state â€” no transition
    allLabels.forEach(function(label) {
        const section = label.dataset.section;
        const body = document.getElementById('section-' + section);
        if (!body) return;

        body.style.transition = 'none';
        // Open if: stored as open, OR contains the active link
        const shouldOpen = openMap[section] === true || section === activeSection;
        if (shouldOpen) {
            body.classList.add('open');
            label.classList.add('open');
            openMap[section] = true;
        } else {
            body.classList.remove('open');
            label.classList.remove('open');
        }
        body.offsetHeight;
        body.style.transition = '';
    });

    // Click handler â€” accordion: close others, open clicked
    allLabels.forEach(function(label) {
        const section = label.dataset.section;
        const body = document.getElementById('section-' + section);
        if (!body) return;

        label.addEventListener('click', function () {
            const isOpen = body.classList.contains('open');

            if (isOpen) {
                // Close this one
                body.classList.remove('open');
                label.classList.remove('open');
                openMap[section] = false;
            } else {
                // Close all others first
                allLabels.forEach(function(otherLabel) {
                    const otherSection = otherLabel.dataset.section;
                    const otherBody = document.getElementById('section-' + otherSection);
                    if (otherSection !== section && otherBody) {
                        otherBody.classList.remove('open');
                        otherLabel.classList.remove('open');
                        openMap[otherSection] = false;
                    }
                });
                // Open this one
                body.classList.add('open');
                label.classList.add('open');
                openMap[section] = true;
            }

            saveOpenSections(openMap);
        });
    });
})();
</script>

<div id="global-appointment-alert" style="display:none; position:fixed; top:20px; right:24px; background:#fff; border-left:4px solid #6D28D9; border-radius:12px; box-shadow:0 10px 30px rgba(0,0,0,0.15); padding:16px 20px; z-index:9999; max-width:350px; animation: slide-in-right 0.3s ease-out;">
    <div style="display:flex; justify-content:space-between; align-items:flex-start;">
        <div>
            <div style="font-size:0.8rem; font-weight:700; color:#6D28D9; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:4px;">Client Arriving Now</div>
            <div id="ga-client-name" style="font-size:1.1rem; font-weight:700; color:#1e293b; margin-bottom:2px;">Name</div>
            <div id="ga-client-details" style="font-size:0.8rem; color:#64748b; margin-bottom:4px;">Service Â· Staff</div>
            <div id="ga-client-time" style="font-size:0.85rem; font-weight:600; color:#6D28D9; margin-bottom:12px;">Time</div>
        </div>
        <button onclick="dismissGlobalAlert()" style="background:none; border:none; cursor:pointer; color:#94a3b8; padding:2px;"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
    </div>
    <div style="display:flex; gap:8px;">
        <button id="ga-btn-arrived" style="flex:1; padding:8px 0; border:none; border-radius:8px; background:#EDE9FE; color:#4C1D95; font-weight:600; font-size:0.8rem; cursor:pointer; font-family:'Inter',sans-serif; transition:.2s;">Arrived</button>
        <button id="ga-btn-late" style="flex:1; padding:8px 0; border:none; border-radius:8px; background:#EDE9FE; color:#4C1D95; font-weight:600; font-size:0.8rem; cursor:pointer; font-family:'Inter',sans-serif; transition:.2s;">Late</button>
        <button id="ga-btn-discard" style="flex:1; padding:8px 0; border:none; border-radius:8px; background:#EDE9FE; color:#3B0764; font-weight:600; font-size:0.8rem; cursor:pointer; font-family:'Inter',sans-serif; transition:.2s;">No Show</button>
    </div>
</div>

<style>
@keyframes slide-in-right { from { transform: translateX(100%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
@keyframes glow-arriving { 0% { box-shadow: 0 0 0 0 rgba(109,40,217, 0.7); } 70% { box-shadow: 0 0 0 10px rgba(109,40,217, 0); } 100% { box-shadow: 0 0 0 0 rgba(109,40,217, 0); } }
@keyframes glow-discarded { 0% { box-shadow: 0 0 0 0 rgba(109,40,217, 0.5); } 70% { box-shadow: 0 0 0 12px rgba(109,40,217, 0); } 100% { box-shadow: 0 0 0 0 rgba(109,40,217, 0); } }
.row-arriving { animation: glow-arriving 2s infinite; background:#F5F3FF !important; }
.row-discarded { animation: glow-discarded 2s infinite; background:#F5F3FF !important; }
</style>

<script>
let activeAlertAppointmentId = null;

function dismissGlobalAlert() {
    document.getElementById('global-appointment-alert').style.display = 'none';
}

function updateGlobalStatus(status) {
    if (!activeAlertAppointmentId) return;
    
    fetch(`{{ url('appointments') }}/${activeAlertAppointmentId}/update-status`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        },
        body: JSON.stringify({ status: status })
    }).then(r => r.json()).then(data => {
        if (data.success) {
            dismissGlobalAlert();
            
            // Redirect to edit page for Arrived or Late, otherwise just refresh
            if (status === 'arrived' || status === 'late') {
                window.location.href = `{{ url('appointments') }}/${activeAlertAppointmentId}/edit`;
            } else {
                if (window.location.pathname.includes('/appointments') || window.location.pathname === '/' || window.location.pathname.includes('/admin')) {
                    window.location.reload();
                }
            }
        }
    });
}

document.getElementById('ga-btn-arrived').addEventListener('click', () => updateGlobalStatus('arrived'));
document.getElementById('ga-btn-late').addEventListener('click', () => updateGlobalStatus('late'));
document.getElementById('ga-btn-discard').addEventListener('click', () => updateGlobalStatus('discarded'));

function pollArrivingAppointments() {
    fetch('{{ url("/appointments/due-now") }}', {
        headers: { 'Accept': 'application/json' }
    })
    .then(r => {
        if (!r.ok) throw new Error('Network error');
        return r.json();
    })
    .then(appointments => {
        // Remove old glows
        document.querySelectorAll('.row-arriving').forEach(el => el.classList.remove('row-arriving'));

        if (appointments && appointments.length > 0) {
            // Use the first arriving appointment for the popup notification
            const appt = appointments[0];
            
            activeAlertAppointmentId = appt.id;
            document.getElementById('ga-client-name').innerText = appt.customer_name;
            document.getElementById('ga-client-details').innerText = `${appt.service} Â· ${appt.staff}`;
            document.getElementById('ga-client-time').innerText = appt.start_time;
            document.getElementById('global-appointment-alert').style.display = 'block';

            // Glow all rows corresponding to arriving appointments
            appointments.forEach(a => {
                const row = document.getElementById('appt-row-' + a.id);
                if (row) row.classList.add('row-arriving');
            });
        } else {
            dismissGlobalAlert();
            activeAlertAppointmentId = null;
        }
    })
    .catch(err => console.log('Polling error', err));
}

// Poll every 30 seconds
setInterval(pollArrivingAppointments, 30000);
// Initial poll
setTimeout(pollArrivingAppointments, 2000);
</script>

@stack('scripts')
</body>
</html>
