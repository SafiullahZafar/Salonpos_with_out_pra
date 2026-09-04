<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#4C1D95">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="Veloura POS">
    <title>Sign in — Veloura Salon</title>
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <link rel="apple-touch-icon" href="{{ asset('icons/icon-192.svg') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root{--p950:#3B0764;--p900:#4C1D95;--p700:#6D28D9;--p600:#7C3AED;--p200:#DDD6FE;--p100:#EDE9FE;--p50:#F5F3FF;--ink:#17131F;--muted:#6B6474;--border:#E7E1EC}
        *{box-sizing:border-box}html,body{margin:0;min-height:100%;font-family:'Inter',system-ui,sans-serif}
        body{min-height:100vh;padding:28px;color:var(--ink);background:#fff;display:grid;place-items:center;overflow-x:hidden}
        button,input{font:inherit}.login-shell{position:relative;display:grid;grid-template-columns:minmax(320px,.82fr) minmax(430px,1.18fr);width:min(1120px,100%);min-height:min(720px,calc(100vh - 56px));overflow:hidden;background:#fff;border:1px solid rgba(255,255,255,.34);border-radius:30px;box-shadow:0 32px 90px rgba(24,7,45,.34)}
        .story-panel{position:relative;isolation:isolate;display:flex;flex-direction:column;justify-content:space-between;padding:52px;color:#fff;background:linear-gradient(155deg,#4C1D95 0%,#6D28D9 62%,#8B5CF6 100%);overflow:hidden}
        .story-panel::before,.story-panel::after{content:'';position:absolute;z-index:-1;border:1px solid rgba(255,255,255,.18);border-radius:50%}.story-panel::before{width:390px;height:390px;right:-230px;top:-110px;box-shadow:0 0 0 42px rgba(255,255,255,.035),0 0 0 92px rgba(255,255,255,.025)}.story-panel::after{width:260px;height:260px;left:-150px;bottom:-120px;box-shadow:0 0 0 32px rgba(255,255,255,.035)}
        .brand{display:flex;align-items:center;gap:13px;text-decoration:none;color:#fff}.brand-mark{width:48px;height:48px;border-radius:15px;display:grid;place-items:center;background:rgba(255,255,255,.14);border:1px solid rgba(255,255,255,.24);font-size:15px;font-weight:800;letter-spacing:-.04em}.brand-name{font-size:20px;font-weight:800;letter-spacing:-.035em}.brand-kicker{display:block;margin-top:2px;color:#DDD6FE;font-size:11px;font-weight:650;letter-spacing:.11em;text-transform:uppercase}
        .story-copy{max-width:420px;margin:70px 0}.story-eyebrow{margin-bottom:16px;color:#EDE9FE;font-size:12px;font-weight:750;letter-spacing:.13em;text-transform:uppercase}.story-copy h1{margin:0 0 18px;font-size:clamp(34px,4vw,55px);line-height:1.02;letter-spacing:-.055em;font-weight:800}.story-copy p{max-width:355px;margin:0;color:#E9D5FF;font-size:15px;line-height:1.75}.story-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:8px}.story-stat{padding:13px 12px;background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.15);border-radius:13px;backdrop-filter:blur(10px)}.story-stat strong{display:block;font-size:14px}.story-stat span{display:block;margin-top:3px;color:#DDD6FE;font-size:10px;line-height:1.35}
        .form-panel{position:relative;display:grid;place-items:center;padding:54px clamp(34px,7vw,92px);background:#fff}.form-panel::before{content:'';position:absolute;top:0;right:0;width:180px;height:180px;background:linear-gradient(225deg,var(--p50),transparent 66%);pointer-events:none}.login-card{position:relative;width:100%;max-width:440px}.mobile-brand{display:none;margin-bottom:34px;color:var(--p900)}
        .access-label{display:inline-flex;align-items:center;gap:7px;margin-bottom:18px;padding:6px 10px;color:var(--p900);background:var(--p50);border:1px solid var(--p200);border-radius:999px;font-size:11px;font-weight:750;letter-spacing:.07em;text-transform:uppercase}.access-label::before{content:'';width:7px;height:7px;border-radius:50%;background:var(--p600);box-shadow:0 0 0 4px var(--p100)}.form-header h2{margin:0 0 9px;color:var(--p950);font-size:32px;line-height:1.1;letter-spacing:-.045em}.form-header p{margin:0 0 34px;color:var(--muted);font-size:14px;line-height:1.65}
        .error-box{display:flex;align-items:flex-start;gap:9px;margin-bottom:20px;padding:12px 14px;color:var(--p900);background:var(--p50);border:1px solid var(--p200);border-radius:12px;font-size:13px;font-weight:650}.field{margin-bottom:18px}.field-head{display:flex;justify-content:space-between;align-items:center;margin-bottom:8px}.field label{color:#352E3C;font-size:13px;font-weight:700}.field-head a{color:var(--p700);font-size:12px;font-weight:700;text-decoration:none}.field-head a:hover{text-decoration:underline}.input-wrap{position:relative}.input-icon{position:absolute;left:14px;top:50%;transform:translateY(-50%);display:flex;color:#918A99;pointer-events:none}
        .field input{width:100%;height:50px;padding:0 45px 0 44px;color:var(--ink);background:#FBFAFC;border:1px solid var(--border);border-radius:13px;outline:none;transition:.2s;font-size:14px}.field input:focus{background:#fff;border-color:var(--p600);box-shadow:0 0 0 4px rgba(124,58,237,.11)}.field input::placeholder{color:#AAA3B1}.password-toggle{position:absolute;right:12px;top:50%;transform:translateY(-50%);display:grid;place-items:center;padding:7px;color:#918A99;background:transparent;border:0;border-radius:8px;cursor:pointer}.password-toggle:hover,.password-toggle:focus-visible{color:var(--p700);background:var(--p50);outline:none}
        .sign-in-button{width:100%;height:52px;margin-top:8px;display:flex;align-items:center;justify-content:center;gap:10px;color:#fff;background:linear-gradient(135deg,var(--p700),var(--p600));border:0;border-radius:13px;box-shadow:0 12px 26px rgba(109,40,217,.22);font-weight:750;cursor:pointer;transition:.2s}.sign-in-button:hover{transform:translateY(-2px);box-shadow:0 16px 30px rgba(109,40,217,.28)}.sign-in-button:focus-visible{outline:3px solid var(--p200);outline-offset:3px}.security-note{display:flex;align-items:center;justify-content:center;gap:7px;margin:22px 0 0;color:#8A8291;font-size:11px}.developer-credit{position:absolute;right:28px;bottom:22px;color:#9B94A2;font-size:11px}.developer-credit strong{color:var(--p700);font-weight:750}
        @media(max-width:860px){body{padding:16px;background:#fff}.login-shell{grid-template-columns:1fr;min-height:calc(100vh - 32px);border-radius:24px}.story-panel{display:none}.form-panel{padding:42px 28px 72px}.mobile-brand{display:flex}}
        @media(max-width:420px){body{padding:0}.login-shell{min-height:100vh;border-radius:0}.form-panel{align-items:start;padding:30px 20px 64px}.form-header h2{font-size:28px}.mobile-brand{margin-bottom:48px}.developer-credit{right:20px;left:20px;text-align:center}}
        @media(prefers-reduced-motion:reduce){*,*::before,*::after{transition:none!important;animation:none!important}}
    </style>
</head>
<body>
    <main class="login-shell">
        <aside class="story-panel" aria-label="Veloura Salon platform overview">
            <a class="brand" href="{{ route('login') }}" aria-label="Veloura Salon sign in">
                <span class="brand-mark">VS</span><span><span class="brand-name">Veloura Salon</span><span class="brand-kicker">Salon operations</span></span>
            </a>
            <div class="story-copy"><div class="story-eyebrow">Your day, beautifully organized</div><h1>Where service meets seamless control.</h1><p>Run appointments, sales, staff, clients, and inventory from one calm, connected workspace.</p></div>
            <div class="story-stats" aria-label="Platform capabilities"><div class="story-stat"><strong>POS</strong><span>Fast checkout</span></div><div class="story-stat"><strong>Calendar</strong><span>Clear schedules</span></div><div class="story-stat"><strong>Insights</strong><span>Live reporting</span></div></div>
        </aside>
        <section class="form-panel">
            <div class="login-card">
                <div class="mobile-brand brand"><span class="brand-mark">VS</span><span><span class="brand-name">Veloura Salon</span><span class="brand-kicker">Salon operations</span></span></div>
                <div class="access-label">Secure workspace</div>
                <header class="form-header"><h2>Welcome back</h2><p>Enter your account details to open the Veloura workspace.</p></header>
                @if($errors->any())
                    <div class="error-box" role="alert"><svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 8v5m0 3h.01"/></svg><span>{{ $errors->first() }}</span></div>
                @endif
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="field"><div class="field-head"><label for="email">Email address</label></div><div class="input-wrap"><span class="input-icon"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg></span><input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="name@example.com" autofocus></div></div>
                    <div class="field"><div class="field-head"><label for="password">Password</label><a href="{{ route('password.request') }}">Forgot password?</a></div><div class="input-wrap"><span class="input-icon"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><rect x="4" y="10" width="16" height="11" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3"/></svg></span><input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Enter your password"><button type="button" class="password-toggle" id="passwordToggle" aria-label="Show password" aria-pressed="false"><svg id="eyeIcon" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z"/><circle cx="12" cy="12" r="2.5"/></svg></button></div></div>
                    <button type="submit" class="sign-in-button">Sign in to workspace<svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14m-5-5 5 5-5 5"/></svg></button>
                </form>
                <p class="security-note"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M12 3 5 6v5c0 4.5 2.8 8 7 10 4.2-2 7-5.5 7-10V6l-7-3Z"/><path d="m9 12 2 2 4-4"/></svg>Protected access for authorized team members</p>
            </div>
            <div class="developer-credit">Designed and powered by <strong>PixoraSoftTech</strong></div>
        </section>
    </main>
    <script>
        const toggle=document.getElementById('passwordToggle'),password=document.getElementById('password'),eyeIcon=document.getElementById('eyeIcon');
        toggle.addEventListener('click',()=>{const showing=password.type==='text';password.type=showing?'password':'text';toggle.setAttribute('aria-pressed',showing?'false':'true');toggle.setAttribute('aria-label',showing?'Show password':'Hide password');eyeIcon.innerHTML=showing?'<path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z"/><circle cx="12" cy="12" r="2.5"/>':'<path d="M3 3l18 18M10.6 6.2A11 11 0 0 1 12 6c6.5 0 10 6 10 6a15 15 0 0 1-3 3.8M6.2 6.2C3.5 8.1 2 12 2 12s3.5 6 10 6a10 10 0 0 0 3.1-.5"/>';});
    </script>
</body>
</html>
