<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#3B0764">
    <title>Select Branch — Veloura Salon</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root{--purple:#6D28D9;--deep:#3B0764;--violet:#8B5CF6;--soft:#F5F3FF;--line:#E7E1EC;--ink:#211828;--muted:#776E7E;color-scheme:light}
        *{box-sizing:border-box}
        html,body{min-height:100%;margin:0;background:#fff!important}
        body{min-height:100vh;color:var(--ink);font-family:'Inter',sans-serif}
        button{font:inherit}
        .gateway{display:grid;grid-template-columns:minmax(330px,42%) minmax(0,58%);min-height:100vh;background:#fff}
        .welcome-panel{position:relative;isolation:isolate;display:flex;flex-direction:column;justify-content:space-between;min-height:100vh;padding:48px clamp(32px,5vw,74px);overflow:hidden;color:#fff;background:linear-gradient(150deg,#2E064E 0%,#4C1D95 47%,#6D28D9 100%)}
        .welcome-panel::before,.welcome-panel::after{content:'';position:absolute;z-index:-1;border:1px solid rgba(255,255,255,.13);border-radius:50%}
        .welcome-panel::before{width:430px;height:430px;right:-225px;top:-170px}.welcome-panel::after{width:300px;height:300px;left:-160px;bottom:-115px}
        .brand{display:flex;align-items:center;gap:13px}.brand-mark{width:48px;height:48px;display:grid;place-items:center;background:#fff;color:var(--deep);border-radius:14px;font-weight:850;letter-spacing:-.04em;box-shadow:0 10px 28px rgba(19,3,33,.2)}.brand-name{font-size:1.05rem;font-weight:850}.brand-note{display:block;margin-top:3px;color:#D8CBE6;font-size:.62rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase}
        .welcome-copy{max-width:470px;margin:70px 0}.welcome-eyebrow{display:flex;align-items:center;gap:8px;margin-bottom:17px;color:#DDD6FE;font-size:.66rem;font-weight:850;letter-spacing:.13em;text-transform:uppercase}.welcome-eyebrow::before{content:'';width:24px;height:1px;background:#C4B5FD}.welcome-copy h1{margin:0 0 17px;font-size:clamp(2.25rem,4.5vw,4rem);line-height:.98;letter-spacing:-.065em}.welcome-copy p{max-width:390px;margin:0;color:#E9D5FF;font-size:.88rem;line-height:1.75}
        .session-card{position:relative;display:grid;grid-template-columns:auto 1fr;gap:12px;align-items:center;padding:15px;background:rgba(255,255,255,.09);border:1px solid rgba(255,255,255,.15);border-radius:14px;backdrop-filter:blur(10px)}.user-avatar{width:39px;height:39px;display:grid;place-items:center;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);border-radius:11px;font-size:.8rem;font-weight:850}.session-card strong{display:block;font-size:.75rem}.session-card span{display:block;margin-top:3px;color:#D8CBE6;font-size:.62rem}
        .branch-panel{display:flex;min-width:0;flex-direction:column;justify-content:center;min-height:100vh;padding:46px clamp(32px,6vw,92px);background:#fff}
        .branch-header{display:flex;align-items:flex-end;justify-content:space-between;gap:20px;padding-bottom:22px;border-bottom:1px solid var(--line)}.branch-kicker{color:var(--purple);font-size:.65rem;font-weight:850;letter-spacing:.13em;text-transform:uppercase}.branch-header h2{margin:7px 0 0;color:var(--ink);font-size:clamp(1.75rem,3vw,2.55rem);letter-spacing:-.055em}.branch-count{flex:0 0 auto;padding:7px 10px;color:var(--deep);background:var(--soft);border:1px solid #DDD6FE;border-radius:999px;font-size:.65rem;font-weight:800}
        .instruction{display:flex;align-items:center;gap:8px;margin:17px 0;color:var(--muted);font-size:.72rem}.instruction svg{color:var(--purple)}
        .branch-list{display:grid;gap:11px}.branch-form{margin:0}.branch-card{position:relative;width:100%;display:grid;grid-template-columns:52px minmax(0,1fr) auto;align-items:center;gap:15px;min-height:88px;padding:15px 17px;text-align:left;color:inherit;background:#fff;border:1px solid var(--line);border-radius:14px;cursor:pointer;transition:transform .18s,border-color .18s,box-shadow .18s}.branch-card:hover,.branch-card:focus-visible{transform:translateX(5px);border-color:#A78BFA;box-shadow:0 10px 28px rgba(59,7,100,.09);outline:none}.branch-icon{width:52px;height:52px;display:grid;place-items:center;color:var(--deep);background:var(--soft);border:1px solid #DDD6FE;border-radius:13px}.branch-number{margin-bottom:4px;color:#938B99;font-size:.57rem;font-weight:850;letter-spacing:.1em;text-transform:uppercase}.branch-name{overflow:hidden;color:#291F30;font-size:.92rem;font-weight:850;text-overflow:ellipsis;white-space:nowrap}.branch-address{overflow:hidden;margin-top:4px;color:#817987;font-size:.68rem;text-overflow:ellipsis;white-space:nowrap}.open-action{display:flex;align-items:center;gap:7px;color:var(--purple);font-size:.67rem;font-weight:850}.open-action svg{transition:transform .18s}.branch-card:hover .open-action svg{transform:translateX(3px)}
        .empty-state{padding:42px 24px;text-align:center;color:var(--muted);background:#fff;border:1px dashed #CFC6D5;border-radius:14px}.empty-icon{width:52px;height:52px;display:grid;place-items:center;margin:0 auto 12px;color:var(--purple);background:var(--soft);border-radius:15px}.empty-state strong{display:block;color:var(--deep);font-size:.88rem}.empty-state span{display:block;margin-top:6px;font-size:.7rem}
        .panel-footer{display:flex;align-items:center;justify-content:space-between;gap:15px;margin-top:22px;padding-top:18px;border-top:1px solid var(--line);color:#9A929F;font-size:.61rem}.panel-footer strong{color:#6D28D9}.secure-note{display:flex;align-items:center;gap:6px}
        @media(max-width:850px){.gateway{grid-template-columns:1fr}.welcome-panel{min-height:auto;padding:30px 24px}.welcome-copy{margin:45px 0}.welcome-copy h1{font-size:2.6rem}.session-card{max-width:430px}.branch-panel{min-height:auto;padding:38px 22px}.branch-card:hover{transform:translateY(-2px)}}
        @media(max-width:520px){.welcome-copy{margin:38px 0}.branch-header{align-items:flex-start;flex-direction:column}.branch-card{grid-template-columns:46px minmax(0,1fr);padding:14px}.branch-icon{width:46px;height:46px}.open-action{grid-column:2}.panel-footer{align-items:flex-start;flex-direction:column}}
    </style>
</head>
<body>
<main class="gateway">
    <section class="welcome-panel">
        <div class="brand"><div class="brand-mark">VS</div><div><div class="brand-name">Veloura Salon</div><span class="brand-note">Operations workspace</span></div></div>
        <div class="welcome-copy"><div class="welcome-eyebrow">Your workday starts here</div><h1>Choose your salon workspace.</h1><p>Each branch keeps its own appointments, clients, inventory and financial activity organised. Select where you are working today.</p></div>
        <div class="session-card"><div class="user-avatar">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</div><div><strong>{{ auth()->user()->name }}</strong><span>Signed in securely · Ready to select a branch</span></div></div>
    </section>

    <section class="branch-panel">
        <header class="branch-header"><div><div class="branch-kicker">Available workspaces</div><h2>Select a branch</h2></div><span class="branch-count">{{ $branches->count() }} {{ \Illuminate\Support\Str::plural('location',$branches->count()) }}</span></header>
        <div class="instruction"><svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 8h.01M11 12h1v4h1"/></svg>Your selection controls the data shown throughout the dashboard.</div>
        <div class="branch-list">
            @forelse($branches as $branch)
            <form action="{{ route('admin.branch.switch_from_select') }}" method="POST" class="branch-form">@csrf<input type="hidden" name="branch_id" value="{{ $branch->id }}">
                <button type="submit" class="branch-card">
                    <span class="branch-icon"><svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M3 21h18M5 21V5l7-3 7 3v16M9 9h1m4 0h1M9 13h1m4 0h1M9 17h6"/></svg></span>
                    <span style="min-width:0"><span class="branch-number">Branch {{ str_pad($loop->iteration,2,'0',STR_PAD_LEFT) }}</span><span class="branch-name">{{ $branch->name }}</span><span class="branch-address">{{ $branch->address ?: 'Location details available inside the workspace' }}</span></span>
                    <span class="open-action">Enter workspace <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="m9 18 6-6-6-6"/></svg></span>
                </button>
            </form>
            @empty
            <div class="empty-state"><div class="empty-icon"><svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M3 21h18M5 21V5l7-3 7 3v16"/></svg></div><strong>No active branches available</strong><span>Ask an administrator to activate a branch before continuing.</span></div>
            @endforelse
        </div>
        <footer class="panel-footer"><span class="secure-note"><svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="4" y="10" width="16" height="11" rx="2"/><path d="M8 10V7a4 4 0 018 0v3"/></svg>Secure branch access</span><span>Powered by <strong>PixoraSoftTech</strong></span></footer>
    </section>
</main>
</body>
</html>
