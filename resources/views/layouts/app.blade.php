<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Baby Shower · Bébé arrive bientôt ✨')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet">
    <style>
        :root {
            --blush: #A8D8E8;
            --blush-deep: #6FB3C8;
            --sage: #B8C9B0;
            --sage-deep: #7A9B6E;
            --cream: #FBF6F0;
            --warm-white: #FFFDF9;
            --text-primary: #3A2F2A;
            --text-muted: #8C7B6E;
            --text-light: #BDB0A6;
            --gold: #C9A96E;
            --gold-light: #EDD9B0;
            --border: rgba(58,47,42,0.1);
            --shadow: 0 2px 24px rgba(58,47,42,0.06);
            --radius: 20px;
            --radius-sm: 12px;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--warm-white);
            color: var(--text-primary);
            font-size: 16px;
            line-height: 1.7;
            overflow-x: hidden;
        }
        /* Noise texture overlay */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.025'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 0;
            opacity: 0.4;
        }

        /* NAV */
        nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 100;
            padding: 0 2rem;
            height: 72px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(255,253,249,0.85);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border);
        }
        .nav-logo {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.5rem;
            font-weight: 300;
            color: var(--text-primary);
            text-decoration: none;
            letter-spacing: 0.02em;
        }
        .nav-logo span { color: var(--blush-deep); font-style: italic; }
        .nav-links {
            display: flex;
            align-items: center;
            gap: 2rem;
            list-style: none;
        }
        .nav-links a {
            text-decoration: none;
            color: var(--text-muted);
            font-size: 0.875rem;
            font-weight: 400;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            transition: color 0.2s;
        }
        .nav-links a:hover { color: var(--text-primary); }
        .nav-cta {
            background: var(--text-primary) !important;
            color: var(--warm-white) !important;
            padding: 0.5rem 1.25rem;
            border-radius: 50px;
            font-weight: 500 !important;
            transition: opacity 0.2s !important;
        }
        .nav-cta:hover { opacity: 0.8 !important; }
        .nav-mobile-toggle {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            flex-direction: column;
            gap: 5px;
        }
        .nav-mobile-toggle span {
            display: block;
            width: 24px;
            height: 1.5px;
            background: var(--text-primary);
            transition: all 0.3s;
        }

        /* Flash messages */
        .flash {
            position: fixed;
            top: 88px;
            right: 1.5rem;
            z-index: 200;
            padding: 1rem 1.5rem;
            border-radius: var(--radius-sm);
            font-size: 0.9rem;
            font-weight: 500;
            max-width: 320px;
            animation: slideIn 0.3s ease;
            box-shadow: 0 4px 24px rgba(0,0,0,0.12);
        }
        .flash-success { background: #D4EDD4; color: #2D6A2D; }
        .flash-error { background: #F5D4D4; color: #6A2D2D; }
        @keyframes slideIn { from { opacity: 0; transform: translateX(20px); } to { opacity: 1; transform: translateX(0); } }

        /* Page content */
        main { padding-top: 72px; position: relative; z-index: 1; }

        /* Footer */
        footer {
            background: var(--text-primary);
            color: var(--text-light);
            text-align: center;
            padding: 2.5rem;
            font-size: 0.85rem;
            margin-top: 6rem;
        }
        footer a { color: var(--blush); text-decoration: none; }
        footer .footer-logo {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.5rem;
            font-weight: 300;
            color: var(--cream);
            letter-spacing: 0.02em;
            display: block;
            margin-bottom: 0.5rem;
        }
        footer .footer-logo span { color: var(--blush); font-style: italic; }

        /* Utility classes */
        .container { max-width: 1100px; margin: 0 auto; padding: 0 2rem; }
        .section { padding: 5rem 0; }
        .section-sm { padding: 3rem 0; }
        .section-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 300;
            color: var(--text-primary);
            line-height: 1.2;
        }
        .section-title em { color: var(--blush-deep); font-style: italic; }
        .section-subtitle {
            color: var(--text-muted);
            font-size: 0.9rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            font-weight: 400;
            margin-bottom: 0.75rem;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.75rem;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            border: none;
            transition: all 0.2s;
            letter-spacing: 0.02em;
        }
        .btn-primary {
            background: var(--text-primary);
            color: var(--warm-white);
        }
        .btn-primary:hover { opacity: 0.85; transform: translateY(-1px); }
        .btn-outline {
            background: transparent;
            color: var(--text-primary);
            border: 1.5px solid var(--text-primary);
        }
        .btn-outline:hover { background: var(--text-primary); color: var(--warm-white); }
        .btn-blush {
            background: var(--blush);
            color: var(--text-primary);
        }
        .btn-blush:hover { background: var(--blush-deep); color: var(--warm-white); }
        .card {
            background: var(--warm-white);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 2rem;
            box-shadow: var(--shadow);
        }
        .pill {
            display: inline-block;
            padding: 0.3rem 0.9rem;
            border-radius: 50px;
            font-size: 0.78rem;
            font-weight: 500;
            letter-spacing: 0.03em;
        }
        .pill-blush { background: var(--blush); color: var(--text-primary); }
        .pill-sage { background: var(--sage); color: var(--text-primary); }
        .pill-gold { background: var(--gold-light); color: var(--text-primary); }
        input, textarea, select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            color: var(--text-primary);
            background: var(--warm-white);
            transition: border-color 0.2s;
            outline: none;
        }
        input:focus, textarea:focus, select:focus {
            border-color: var(--blush-deep);
        }
        label {
            display: block;
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--text-muted);
            margin-bottom: 0.4rem;
            letter-spacing: 0.02em;
        }
        .form-group { margin-bottom: 1.25rem; }

        /* Decorative elements */
        .deco-petal {
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50% 60% 70% 40%;
            opacity: 0.12;
            pointer-events: none;
        }

        @media (max-width: 768px) {
            .nav-links { display: none; }
            .nav-links.open {
                display: flex;
                flex-direction: column;
                position: fixed;
                top: 72px; left: 0; right: 0;
                background: var(--warm-white);
                padding: 1.5rem 2rem 2rem;
                border-bottom: 1px solid var(--border);
                gap: 1.25rem;
            }
            .nav-mobile-toggle { display: flex; }
        }
    </style>
    @stack('styles')
</head>
<body>

<nav>
    <a href="{{ route('home') }}" class="nav-logo">bébé<span>&</span>nous</a>
    <ul class="nav-links" id="navLinks">
        <li><a href="{{ route('home') }}#histoire">Notre histoire</a></li>
        <li><a href="{{ route('home') }}#cadeaux">Liste cadeaux</a></li>
        <li><a href="{{ route('home') }}#prenom">Prénom</a></li>
        <li><a href="{{ route('home') }}#livre-or">Livre d'or</a></li>
        <li><a href="{{ route('home') }}#participer" class="nav-cta">Participer ✦</a></li>
    </ul>
    <button class="nav-mobile-toggle" id="mobileToggle" aria-label="Menu">
        <span></span><span></span><span></span>
    </button>
</nav>

@if(session('success'))
    <div class="flash flash-success" id="flashMsg">{{ session('success') }}</div>
@elseif(session('error'))
    <div class="flash flash-error" id="flashMsg">{{ session('error') }}</div>
@endif

<main>
    @yield('content')
</main>

<footer>
    <span class="footer-logo">bébé<span>&</span>nous</span>
    <p style="margin-bottom:0.5rem">Fait avec amour · {{ date('Y') }}</p>
    <p><a href="{{ route('admin.login') }}">Espace administrateur</a></p>
</footer>

<script>
document.getElementById('mobileToggle')?.addEventListener('click', () => {
    document.getElementById('navLinks').classList.toggle('open');
});
setTimeout(() => { document.getElementById('flashMsg')?.remove(); }, 4000);
</script>
@stack('scripts')
</body>
</html>
