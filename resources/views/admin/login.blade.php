<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion · bébé&nous Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,400&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500&display=swap" rel="stylesheet">
    <style>
        :root {
            --blush: #A8D8E8;
            --blush-deep: #6FB3C8;
            --cream: #FBF6F0;
            --warm-white: #FFFDF9;
            --text-primary: #3A2F2A;
            --text-muted: #8C7B6E;
            --border: rgba(58,47,42,0.12);
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--text-primary);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse at 20% 50%, rgba(245,214,204,0.08) 0%, transparent 60%),
                radial-gradient(ellipse at 80% 20%, rgba(184,201,176,0.06) 0%, transparent 50%);
        }
        .login-deco {
            position: fixed;
            border-radius: 50%;
            opacity: 0.06;
        }
        .login-card {
            position: relative;
            z-index: 1;
            background: var(--warm-white);
            border-radius: 24px;
            padding: 3rem;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 32px 80px rgba(0,0,0,0.3);
        }
        .login-logo {
            text-align: center;
            margin-bottom: 2rem;
        }
        .login-logo a {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2rem;
            font-weight: 300;
            color: var(--text-primary);
            text-decoration: none;
        }
        .login-logo a span { color: var(--blush-deep); font-style: italic; }
        .login-logo p { font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.12em; color: var(--text-muted); margin-top: 0.25rem; }
        .divider { height: 1px; background: var(--border); margin: 0 0 2rem; }
        .form-group { margin-bottom: 1.25rem; }
        label { display: block; font-size: 0.78rem; font-weight: 500; color: var(--text-muted); margin-bottom: 0.4rem; text-transform: uppercase; letter-spacing: 0.04em; }
        input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1.5px solid var(--border);
            border-radius: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            color: var(--text-primary);
            background: var(--cream);
            outline: none;
            transition: border-color 0.2s;
        }
        input:focus { border-color: var(--blush-deep); background: var(--warm-white); }
        .btn-login {
            width: 100%;
            padding: 0.85rem;
            background: var(--text-primary);
            color: var(--warm-white);
            border: none;
            border-radius: 50px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: opacity 0.2s;
            margin-top: 0.5rem;
        }
        .btn-login:hover { opacity: 0.85; }
        .error-msg {
            background: #F5D4D4;
            color: #6A2D2D;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            font-size: 0.85rem;
            margin-bottom: 1.25rem;
        }
        .back-link { text-align: center; margin-top: 1.5rem; }
        .back-link a { color: var(--text-muted); font-size: 0.82rem; text-decoration: none; }
        .back-link a:hover { color: var(--text-primary); }
    </style>
</head>
<body>
    <div class="login-deco" style="width: 400px; height: 400px; background: var(--blush); top: -150px; right: -100px;"></div>
    <div class="login-deco" style="width: 300px; height: 300px; background: #B8C9B0; bottom: -100px; left: -80px;"></div>

    <div class="login-card">
        <div class="login-logo">
            <a href="{{ route('home') }}">bébé<span>&</span>nous</a>
            <p>Espace administrateur</p>
        </div>
        <div class="divider"></div>

        @if($errors->any())
            <div class="error-msg">⚠ {{ $errors->first() }}</div>
        @endif
        @if(session('error'))
            <div class="error-msg">⚠ {{ session('error') }}</div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="admin@exemple.fr">
            </div>
            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" name="password" required autocomplete="current-password" placeholder="••••••••">
            </div>
            <button type="submit" class="btn-login">Se connecter →</button>
        </form>

        <div class="back-link">
            <a href="{{ route('home') }}">← Retour au site</a>
        </div>
    </div>
</body>
</html>
