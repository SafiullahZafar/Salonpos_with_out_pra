<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session Expired - SalonPOS</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #fff;
            font-family: 'Inter', sans-serif;
        }

        .expired-card {
            background: #fff;
            border: 1px solid #DDD6FE;
            border-radius: 20px;
            padding: 48px 40px;
            width: 100%;
            max-width: 420px;
            text-align: center;
            box-shadow: 0 20px 40px -10px rgba(59,7,100,.18);
        }

        .icon-container {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: #EDE9FE;
            color: #7C3AED;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
        }

        .title {
            color: #3B0764;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0 0 12px;
            letter-spacing: -0.02em;
        }

        .description {
            color: #64748b;
            font-size: 0.95rem;
            line-height: 1.5;
            margin: 0 0 32px;
        }

        .login-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #7C3AED 0%, #4C1D95 100%);
            color: #fff;
            font-weight: 700;
            font-size: 1rem;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px -6px rgba(212, 175, 55, 0.4);
        }
    </style>
</head>
<body>

    <div class="expired-card">
        <div class="icon-container">
            <svg width="32" height="32" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <h1 class="title">Session Expired</h1>
        <p class="description">For your security, your session has timed out due to inactivity or token expiration. Please successfully sign in again to continue.</p>
        
        <a href="{{ route('login') }}" class="login-btn">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
            </svg>
            Return to Sign In
        </a>
    </div>

</body>
</html>
