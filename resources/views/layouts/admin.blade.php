<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') · bébé&nous</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,400&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500&display=swap" rel="stylesheet">
    <style>
        :root {
            --blush: #A8D8E8;
            --blush-deep: #6FB3C8;
            --sage: #B8C9B0;
            --cream: #FBF6F0;
            --warm-white: #FFFDF9;
            --text-primary: #3A2F2A;
            --text-muted: #8C7B6E;
            --text-light: #BDB0A6;
            --gold: #C9A96E;
            --border: rgba(58,47,42,0.1);
            --shadow: 0 2px 16px rgba(58,47,42,0.06);
            --radius: 16px;
            --radius-sm: 10px;
            --sidebar-w: 260px;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: #F4F0EB;
            color: var(--text-primary);
            font-size: 14px;
            line-height: 1.6;
            display: flex;
            min-height: 100vh;
        }
        /* Sidebar */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--text-primary);
            min-height: 100vh;
            position: fixed;
            top: 0; left: 0;
            display: flex;
            flex-direction: column;
            z-index: 50;
            transition: transform 0.3s;
        }
        .sidebar-logo {
            padding: 1.75rem 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }
        .sidebar-logo a {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.4rem;
            font-weight: 300;
            color: var(--cream);
            text-decoration: none;
            letter-spacing: 0.02em;
        }
        .sidebar-logo a span { color: var(--blush); font-style: italic; }
        .sidebar-logo p { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.1em; color: rgba(255,255,255,0.35); margin-top: 0.25rem; }
        .sidebar-nav { flex: 1; padding: 1rem 0; }
        .nav-section { margin-bottom: 0.25rem; }
        .nav-section-label {
            padding: 0.75rem 1.5rem 0.35rem;
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: rgba(255,255,255,0.3);
            font-weight: 500;
        }
        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.65rem 1.5rem;
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 400;
            transition: all 0.15s;
            border-left: 3px solid transparent;
            margin: 0 0.5rem;
            border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
        }
        .nav-item:hover { background: rgba(255,255,255,0.06); color: rgba(255,255,255,0.9); }
        .nav-item.active {
            background: rgba(245,214,204,0.12);
            color: var(--blush);
            border-left-color: var(--blush-deep);
        }
        .nav-item-icon { font-size: 1rem; width: 20px; text-align: center; }
        .sidebar-footer {
            padding: 1.25rem 1.5rem;
            border-top: 1px solid rgba(255,255,255,0.08);
        }
        .sidebar-footer a {
            color: rgba(255,255,255,0.5);
            font-size: 0.8rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .sidebar-footer a:hover { color: var(--blush); }

        /* Main content */
        .admin-main {
            margin-left: var(--sidebar-w);
            flex: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .admin-topbar {
            height: 64px;
            background: var(--warm-white);
            border-bottom: 1px solid var(--border);
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 40;
        }
        .admin-topbar h1 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.3rem;
            font-weight: 300;
        }
        .topbar-actions { display: flex; align-items: center; gap: 1rem; }
        .topbar-badge {
            background: var(--blush);
            color: var(--text-primary);
            font-size: 0.7rem;
            font-weight: 500;
            padding: 0.2rem 0.6rem;
            border-radius: 50px;
        }
        .admin-content { padding: 2rem; flex: 1; }

        /* Flash */
        .flash {
            padding: 0.85rem 1.25rem;
            border-radius: var(--radius-sm);
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .flash-success { background: #D4EDD4; color: #2D6A2D; }
        .flash-error { background: #F5D4D4; color: #6A2D2D; }

        /* Cards & forms */
        .admin-card {
            background: var(--warm-white);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
        }
        .admin-card-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .admin-card-header h3 { font-size: 0.9rem; font-weight: 500; }
        .admin-card-body { padding: 1.5rem; }
        .admin-grid { display: grid; gap: 1.5rem; }
        .admin-grid-2 { grid-template-columns: 1fr 1fr; }
        .admin-grid-3 { grid-template-columns: 1fr 1fr 1fr; }
        table { width: 100%; border-collapse: collapse; }
        table th {
            text-align: left;
            padding: 0.75rem 1rem;
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--text-muted);
            font-weight: 500;
            border-bottom: 1px solid var(--border);
        }
        table td {
            padding: 0.85rem 1rem;
            border-bottom: 1px solid var(--border);
            font-size: 0.875rem;
        }
        table tr:last-child td { border-bottom: none; }
        table tr:hover td { background: var(--cream); }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            border: none;
            transition: all 0.15s;
            font-family: 'DM Sans', sans-serif;
        }
        .btn-sm { padding: 0.35rem 0.75rem; font-size: 0.75rem; }
        .btn-primary { background: var(--text-primary); color: var(--warm-white); }
        .btn-primary:hover { opacity: 0.85; }
        .btn-blush { background: var(--blush); color: var(--text-primary); }
        .btn-blush:hover { background: var(--blush-deep); color: white; }
        .btn-danger { background: #F5D4D4; color: #6A2D2D; }
        .btn-danger:hover { background: #E8AAAA; }
        .btn-ghost { background: transparent; border: 1px solid var(--border); color: var(--text-muted); }
        .btn-ghost:hover { background: var(--cream); color: var(--text-primary); }
        input, textarea, select {
            width: 100%;
            padding: 0.6rem 0.85rem;
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.875rem;
            color: var(--text-primary);
            background: var(--warm-white);
            outline: none;
            transition: border-color 0.2s;
        }
        input:focus, textarea:focus, select:focus { border-color: var(--blush-deep); }
        label {
            display: block;
            font-size: 0.78rem;
            font-weight: 500;
            color: var(--text-muted);
            margin-bottom: 0.35rem;
            letter-spacing: 0.02em;
            text-transform: uppercase;
        }
        .form-group { margin-bottom: 1rem; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .badge {
            display: inline-block;
            padding: 0.2rem 0.6rem;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 500;
        }
        .badge-green { background: #D4EDD4; color: #2D6A2D; }
        .badge-red { background: #F5D4D4; color: #6A2D2D; }
        .badge-blush { background: var(--blush); color: var(--text-primary); }
        .badge-gray { background: var(--cream); color: var(--text-muted); }

        /* Stats */
        .stat-cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 1rem; margin-bottom: 2rem; }
        .stat-card {
            background: var(--warm-white);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.25rem;
            box-shadow: var(--shadow);
        }
        .stat-card-label { font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--text-muted); margin-bottom: 0.5rem; }
        .stat-card-value { font-family: 'Cormorant Garamond', serif; font-size: 2rem; font-weight: 300; color: var(--text-primary); }
        .stat-card-sub { font-size: 0.75rem; color: var(--text-muted); margin-top: 0.25rem; }
        .stat-card-icon { font-size: 1.5rem; margin-bottom: 0.5rem; }

        /* Photo upload */
        .photo-upload {
            border: 2px dashed var(--border);
            border-radius: var(--radius-sm);
            padding: 1.5rem;
            text-align: center;
            cursor: pointer;
            transition: border-color 0.2s;
        }
        .photo-upload:hover { border-color: var(--blush-deep); }
        .photo-upload p { color: var(--text-muted); font-size: 0.85rem; }
        .photo-preview {
            width: 80px; height: 80px;
            border-radius: 10px;
            object-fit: cover;
            border: 2px solid var(--border);
        }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .admin-main { margin-left: 0; }
            .admin-grid-2, .admin-grid-3, .form-row { grid-template-columns: 1fr; }
        }
    </style>
    @stack('styles')
</head>
<body>
<aside class="sidebar" id="adminSidebar">
    <div class="sidebar-logo">
        <a href="{{ route('home') }}" target="_blank">bébé<span>&</span>nous</a>
        <p>Back-office</p>
    </div>
    <nav class="sidebar-nav">
        <div class="nav-section">
            <div class="nav-section-label">Général</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="nav-item-icon">✦</span> Tableau de bord
            </a>
        </div>
        <div class="nav-section">
            <div class="nav-section-label">Contenu</div>
            <a href="{{ route('admin.dashboard') }}#content" class="nav-item">
                <span class="nav-item-icon">✏️</span> Textes & médias
            </a>
            <a href="{{ route('admin.dashboard') }}#timeline" class="nav-item">
                <span class="nav-item-icon">🕐</span> Timeline
            </a>
        </div>
        <div class="nav-section">
            <div class="nav-section-label">Interactions</div>
            <a href="{{ route('admin.dashboard') }}#gifts" class="nav-item">
                <span class="nav-item-icon">🎁</span> Liste cadeaux
            </a>
            <a href="{{ route('admin.dashboard') }}#names" class="nav-item">
                <span class="nav-item-icon">✨</span> Prénoms
            </a>
            <a href="{{ route('admin.dashboard') }}#messages" class="nav-item">
                <span class="nav-item-icon">💌</span> Livre d'or
            </a>
            <a href="{{ route('admin.dashboard') }}#donations" class="nav-item">
                <span class="nav-item-icon">💝</span> Dons
            </a>
        </div>
    </nav>
    <div class="sidebar-footer">
        <a href="{{ route('home') }}" target="_blank">↗ Voir le site</a>
        <form action="{{ route('admin.logout') }}" method="POST" style="margin-top: 0.75rem;">
            @csrf
            <button type="submit" style="background: none; border: none; cursor: pointer; color: rgba(255,255,255,0.4); font-size: 0.8rem; display: flex; align-items: center; gap: 0.5rem; font-family: inherit;">
                ← Déconnexion
            </button>
        </form>
    </div>
</aside>

<div class="admin-main">
    <div class="admin-topbar">
        <h1>@yield('title', 'Tableau de bord')</h1>
        <div class="topbar-actions">
            <span class="topbar-badge">✓ Connecté</span>
            <a href="{{ route('home') }}" target="_blank" class="btn btn-ghost btn-sm">↗ Voir le site</a>
        </div>
    </div>
    <div class="admin-content">
        @if(session('success'))
            <div class="flash flash-success">✓ {{ session('success') }}</div>
        @elseif(session('error'))
            <div class="flash flash-error">⚠ {{ session('error') }}</div>
        @endif
        @yield('content')
    </div>
</div>

<script>
document.querySelector('.flash')?.setTimeout && setTimeout(() => document.querySelector('.flash')?.remove(), 4000);
</script>
@stack('scripts')
</body>
</html>
