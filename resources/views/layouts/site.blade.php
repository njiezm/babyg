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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --blush: #F5D6CC;
            --blush-deep: #E8A898;
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
            min-height: 100vh;
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

        /* NAVIGATION STYLE (Elegant Naturel) */
        nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 100;
            padding: 0.5rem 2rem;
            height: 72px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(255,253,249,0.95);
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

        /* Adaptation pour le menu utilisateur (Bootstrap-like) */
        .navbar-nav {
            display: flex;
            align-items: center;
            list-style: none;
            margin: 0;
            padding: 0;
            gap: 1rem;
        }

        .nav-link {
            text-decoration: none;
            color: var(--text-muted);
            font-size: 0.85rem;
            font-weight: 500;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            transition: all 0.2s;
            padding: 0.5rem 0.8rem;
            border-radius: var(--radius-sm);
            position: relative;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--text-primary);
            background: rgba(58,47,42,0.03);
        }

        /* Style spécifique pour le Backoffice demandé */
        .nav-link.text-primary {
            color: var(--text-primary) !important; /* Forcer la couleur primaire (marron foncé ici) */
            font-weight: 700 !important;
        }
        .nav-link.text-primary:hover {
            opacity: 0.7;
            background: transparent;
        }

        /* Mobile Menu */
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

        /* PAGE CONTENT (Single Page Logic) */
        main { padding-top: 72px; position: relative; z-index: 1; }

        /* Cacher les pages par défaut */
        .app-page { display: none; animation: fadeIn 0.4s ease-out; }
        /* Afficher la page active */
        .app-page.active { display: block; }

        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

        /* Footer */
        footer {
            background: var(--text-primary);
            color: var(--text-light);
            text-align: center;
            padding: 2.5rem;
            font-size: 0.85rem;
            margin-top: 4rem;
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
        .section-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 300;
            color: var(--text-primary);
            line-height: 1.2;
        }
        .section-title em { color: var(--blush-deep); font-style: italic; }

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
        .btn-blush {
            background: var(--blush);
            color: var(--text-primary);
        }
        .btn-blush:hover { background: var(--blush-deep); color: var(--warm-white); }
        .btn-outline {
            background: transparent;
            color: var(--text-primary);
            border: 1.5px solid var(--text-primary);
        }
        .btn-outline:hover { background: var(--text-primary); color: var(--warm-white); }

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

        @media (max-width: 768px) {
            .navbar-nav {
                display: none;
                flex-direction: column;
                position: fixed;
                top: 72px; left: 0; right: 0;
                background: var(--warm-white);
                padding: 1.5rem;
                border-bottom: 1px solid var(--border);
                width: 100%;
            }
            .navbar-nav.open { display: flex; }
            .nav-mobile-toggle { display: flex; }
            .nav-link { width: 100%; text-align: center; padding: 10px; }
        }
                /* --- SYSTEME DE GRILLE & UTILITAIRES (Pour que le layout fonctionne) --- */
        .container { width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto; max-width: 1140px; }
        .row { display: flex; flex-wrap: wrap; margin-right: -15px; margin-left: -15px; }

        .col, .col-6, .col-12 { position: relative; width: 100%; padding-right: 15px; padding-left: 15px; }
        .col-6 { flex: 0 0 50%; max-width: 50%; }

        @media (min-width: 768px) {
            .col-md-4 { flex: 0 0 33.333333%; max-width: 33.333333%; }
            .col-md-5 { flex: 0 0 41.666667%; max-width: 41.666667%; }
            .col-md-6 { flex: 0 0 50%; max-width: 50%; }
            .col-md-7 { flex: 0 0 58.333333%; max-width: 58.333333%; }
        }
        @media (min-width: 992px) {
            .col-lg-5 { flex: 0 0 41.666667%; max-width: 41.666667%; }
            .col-lg-7 { flex: 0 0 58.333333%; max-width: 58.333333%; }
        }

        /* Utilitaires Flexbox & Espacement */
        .d-flex { display: flex !important; }
        .flex-column { flex-direction: column !important; }
        .flex-wrap { flex-wrap: wrap !important; }
        .flex-grow-1 { flex-grow: 1 !important; }
        .align-items-center { align-items: center !important; }
        .align-items-stretch { align-items: stretch !important; }
        .align-items-end { align-items: flex-end !important; }
        .justify-content-center { justify-content: center !important; }
        .justify-content-between { justify-content: space-between !important; }
        .gap-2 { gap: 0.5rem !important; }
        .gap-3 { gap: 1rem !important; }
        .gap-4 { gap: 1.5rem !important; }
        .gap-5 { gap: 3rem !important; }

        /* Utilitaires Texte */
        .text-center { text-align: center !important; }
        .text-end { text-align: right !important; }
        .text-muted { color: var(--text-muted) !important; }
        .text-primary { color: var(--text-primary) !important; }
        .text-truncate { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .text-uppercase { text-transform: uppercase !important; }
        .fst-italic { font-style: italic !important; }
        .fw-bold { font-weight: 700 !important; }
        .small { font-size: 0.875em; }
        .lead { font-size: 1.25rem; font-weight: 300; }

        /* Utilitaires Dimensions & Marges */
        .w-100 { width: 100% !important; }
        .h-100 { height: 100% !important; }
        .h1, .h2, .h3, .h4, .h5, .h6 { margin-bottom: 0.5rem; font-weight: 500; line-height: 1.2; }
        .h1 { font-size: 2.5rem; }
        .h2 { font-size: 2rem; }
        .h3 { font-size: 1.75rem; }
        .h4 { font-size: 1.5rem; }
        .h5 { font-size: 1.25rem; }
        .h6 { font-size: 1rem; }
        .display-4 { font-size: 3.5rem; font-weight: 300; line-height: 1.2; }

        .m-0 { margin: 0 !important; }
        .mb-0 { margin-bottom: 0 !important; }
        .mb-1 { margin-bottom: 0.25rem !important; }
        .mb-2 { margin-bottom: 0.5rem !important; }
        .mb-3 { margin-bottom: 1rem !important; }
        .mb-4 { margin-bottom: 1.5rem !important; }
        .mb-5 { margin-bottom: 3rem !important; }
        .mt-auto { margin-top: auto !important; }
        .mt-3 { margin-top: 1rem !important; }
        .my-5 { margin-top: 3rem !important; margin-bottom: 3rem !important; }
        .mx-auto { margin-right: auto !important; margin-left: auto !important; }
        .ms-1 { margin-left: 0.25rem !important; }
        .me-1 { margin-right: 0.25rem !important; }
        .ps-4 { padding-left: 1.5rem !important; }
        .px-1 { padding-left: 0.25rem !important; padding-right: 0.25rem !important; }
        .px-3 { padding-left: 1rem !important; padding-right: 1rem !important; }
        .px-4 { padding-left: 1.5rem !important; padding-right: 1.5rem !important; }
        .py-1 { padding-top: 0.25rem !important; padding-bottom: 0.25rem !important; }
        .py-2 { padding-top: 0.5rem !important; padding-bottom: 0.5rem !important; }
        .py-4 { padding-top: 1.5rem !important; padding-bottom: 1.5rem !important; }
        .py-5 { padding-top: 3rem !important; padding-bottom: 3rem !important; }
        .pb-2 { padding-bottom: 0.5rem !important; }
        .pb-3 { padding-bottom: 1rem !important; }
        .pb-4 { padding-bottom: 1.5rem !important; }
        .pt-2 { padding-top: 0.5rem !important; }
        .pt-3 { padding-top: 1rem !important; }
        .pt-5 { padding-top: 3rem !important; }

        /* Utilitaires Bordures & Autres */
        .border { border: 1px solid var(--border) !important; }
        .border-0 { border: 0 !important; }
        .border-top { border-top: 1px solid var(--border) !important; }
        .border-end { border-right: 1px solid var(--border) !important; }
        .rounded { border-radius: var(--radius-sm) !important; }
        .rounded-3 { border-radius: var(--radius) !important; }
        .rounded-4 { border-radius: calc(var(--radius) * 1.5) !important; }
        .shadow-sm { box-shadow: 0 .125rem .25rem rgba(0,0,0,.075) !important; }
        .overflow-auto { overflow: auto !important; }
        .overflow-hidden { overflow: hidden !important; }
        .position-relative { position: relative !important; }
        .d-inline-block { display: inline-block !important; }
        .object-fit-cover { object-fit: cover !important; }
        .fa-2x { font-size: 2em; }
    </style>
    @stack('styles')
</head>
<body>

<nav>
    <a href="#" onclick="showPage('home'); return false;" class="nav-logo">bébé<span>&</span>nous</a>

    <!-- TON MENU ICI -->
    <ul class="navbar-nav" id="navbarNav">
        <li class="nav-item"><a class="nav-link" href="#" onclick="showPage('home'); return false;">Accueil</a></li>
        <li class="nav-item"><a class="nav-link" href="#" onclick="showPage('story'); return false;">Notre Histoire</a></li>
        <li class="nav-item"><a class="nav-link" href="#" onclick="showPage('list'); return false;">Liste de Naissance</a></li>
        <li class="nav-item"><a class="nav-link" href="#" onclick="showPage('names'); return false;">Votes</a></li>
        <li class="nav-item"><a class="nav-link" href="#" onclick="showPage('urn'); return false;">Urne</a></li>
        <li class="nav-item"><a class="nav-link" href="#" onclick="showPage('advice'); return false;">Livre d'Or</a></li>
        <li class="nav-item"><a class="nav-link text-primary fw-bold" href="{{ route('admin.login') }}">Backoffice</a></li>
    </ul>
    <!-- FIN TON MENU -->

    <button class="nav-mobile-toggle" id="mobileToggle" aria-label="Menu">
        <span></span><span></span><span></span>
    </button>
</nav>

<main>
    @yield('content')
</main>

<footer>
    <span class="footer-logo">bébé<span>&</span>nous</span>
    <p style="margin-bottom:0.5rem">Fait avec amour · {{ date('Y') }}</p>
    <p><a href="{{ route('admin.login') }}">Espace administrateur</a></p>
</footer>

<script>
    // Gestion du menu mobile
    document.getElementById('mobileToggle').addEventListener('click', () => {
        document.getElementById('navbarNav').classList.toggle('open');
    });

    // FONCTION POUR CHANGER DE PAGE (Sans rechargement)
    function showPage(pageId) {
        // Fermer le menu mobile si ouvert
        document.getElementById('navbarNav').classList.remove('open');

        // Cacher toutes les pages
        document.querySelectorAll('.app-page').forEach(page => {
            page.classList.remove('active');
        });

        // Afficher la page demandée
        const target = document.getElementById('page-' + pageId);
        if (target) {
            target.classList.add('active');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    }
</script>
@stack('scripts')
</body>
</html>
