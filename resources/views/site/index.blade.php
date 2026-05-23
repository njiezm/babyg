@extends('layouts.app')

@section('title', 'Baby Shower · Bébé arrive bientôt ✨')

@push('styles')
<style>
/* ========================
   CORE & ANIMATIONS
======================== */
:root {
    --blush: #F4E4E1;
    --blush-deep: #D8A7A5;
    --sage: #A3B18A;
    --cream: #FDFBF7;
    --warm-white: #FFFFFF;
    --text-primary: #3A2F2A;
    --text-muted: #8C857F;
    --text-light: #C4Beb8;
    --border: #EBE5E1;
    --gold: #D4AF37;
    --radius: 16px;
    --radius-sm: 8px;
    --shadow: 0 4px 20px rgba(58,47,42,0.06);
    --font-serif: 'Cormorant Garamond', serif;
    --font-sans: 'DM Sans', sans-serif;
}

body {
    background-color: var(--cream);
    color: var(--text-primary);
    font-family: var(--font-sans);
    -webkit-tap-highlight-color: transparent;
    padding-bottom: 80px; /* Espace pour la nav mobile */
}

/* Animation de transition entre les "pages" */
.page-section {
    display: none;
    animation: fadeIn 0.4s ease-out;
    padding-top: 2rem;
    padding-bottom: 4rem;
}
.page-section.active-section {
    display: block;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Boutons Génériques */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.8rem 1.8rem;
    border-radius: 50px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s;
    font-size: 0.95rem;
    cursor: pointer;
    border: none;
}
.btn-primary { background: var(--text-primary); color: var(--warm-white); }
.btn-primary:hover { background: var(--blush-deep); transform: translateY(-2px); }
.btn-blush { background: var(--blush-deep); color: white; }
.btn-blush:hover { background: var(--text-primary); color: white; }
.btn-outline { border: 1px solid var(--border); color: var(--text-primary); background: transparent; }
.btn-outline:hover { border-color: var(--text-primary); }

.form-group { margin-bottom: 1.25rem; }
.form-group label { display: block; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted); margin-bottom: 0.5rem; font-weight: 500; }
.form-control, input, textarea, select {
    width: 100%;
    padding: 0.85rem 1rem;
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    font-family: var(--font-sans);
    font-size: 1rem;
    background: var(--warm-white);
    color: var(--text-primary);
    box-sizing: border-box;
}
.form-control:focus { outline: none; border-color: var(--blush-deep); box-shadow: 0 0 0 3px rgba(216, 167, 165, 0.15); }

/* ========================
   MOBILE NAVIGATION (SPA)
======================== */
.mobile-nav {
    position: fixed;
    bottom: 0; left: 0; right: 0;
    background: rgba(255,255,255,0.95);
    backdrop-filter: blur(10px);
    border-top: 1px solid var(--border);
    display: flex;
    justify-content: space-around;
    padding: 0.5rem 0 1rem 0; /* Padding bottom pour iOS safe area */
    z-index: 1000;
    box-shadow: 0 -4px 20px rgba(0,0,0,0.03);
}
.nav-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    font-size: 0.65rem;
    color: var(--text-muted);
    text-decoration: none;
    background: none;
    border: none;
    flex: 1;
    padding: 0.5rem;
    transition: color 0.2s;
    cursor: pointer;
}
.nav-item span { font-size: 1.4rem; margin-bottom: 2px; display: block; transition: transform 0.2s; }
.nav-item.active { color: var(--blush-deep); font-weight: 600; }
.nav-item.active span { transform: translateY(-3px); }

/* ========================
   HERO SECTION
======================== */
.hero-header {
    text-align: center;
    padding: 2rem 1.5rem 1rem;
}
.hero-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--blush-deep);
    margin-bottom: 1rem;
}
.hero-title {
    font-family: var(--font-serif);
    font-size: clamp(2.5rem, 8vw, 4rem);
    font-weight: 300;
    line-height: 1.1;
    color: var(--text-primary);
    margin-bottom: 1rem;
}
.hero-title em { color: var(--blush-deep); font-style: italic; }
.hero-desc {
    color: var(--text-muted);
    font-size: 1rem;
    line-height: 1.7;
    margin-bottom: 2rem;
    padding: 0 1rem;
}
.hero-img-wrap {
    width: 100%;
    height: 350px;
    border-radius: 0 0 50% 50% / 20px;
    overflow: hidden;
    margin: 0 -1.5rem 2rem -1.5rem; /* Full width bleed */
    position: relative;
}
.hero-img-wrap img { width: 100%; height: 100%; object-fit: cover; }
.hero-img-placeholder {
    width: 100%; height: 100%;
    background: linear-gradient(135deg, var(--blush) 0%, var(--sage) 100%);
    display: flex; align-items: center; justify-content: center;
    font-size: 4rem;
    color: rgba(255,255,255,0.8);
}

/* Stats Row */
.hero-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
    padding: 1.5rem;
    background: var(--warm-white);
    border-radius: var(--radius);
    margin: 0 1.5rem 2rem 1.5rem;
    box-shadow: var(--shadow);
    border: 1px solid var(--border);
}
.stat-item { text-align: center; }
.stat-number {
    font-family: var(--font-serif);
    font-size: 1.5rem;
    font-weight: 400;
    color: var(--text-primary);
    display: block;
}
.stat-label { font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted); margin-top: 0.25rem; }

/* Countdown */
.countdown {
    display: flex;
    gap: 0.75rem;
    justify-content: center;
    margin: 2rem 0;
}
.countdown-item {
    text-align: center;
    background: var(--warm-white);
    border-radius: 12px;
    padding: 0.75rem 0.5rem;
    min-width: 60px;
    border: 1px solid var(--border);
    flex: 1;
}
.countdown-num {
    font-family: var(--font-serif);
    font-size: 1.5rem;
    font-weight: 400;
    color: var(--blush-deep);
    display: block;
}
.countdown-lbl { font-size: 0.6rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted); }

/* ========================
   TIMELINE (MOBILE FIRST)
======================== */
.story-header { text-align: center; margin-bottom: 2.5rem; padding: 0 1rem; }
.section-title {
    font-family: var(--font-serif);
    font-size: 2rem;
    font-weight: 300;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
}
.section-subtitle {
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.15em;
    color: var(--text-muted);
    margin-bottom: 0.5rem;
    display: block;
}

.timeline {
    position: relative;
    max-width: 600px;
    margin: 0 auto;
    padding: 0 1.5rem;
}
/* Ligne verticale à gauche sur Mobile */
.timeline::before {
    content: '';
    position: absolute;
    left: 24px; /* Aligné avec les points */
    top: 10px; bottom: 0;
    width: 2px;
    background: var(--border);
}

.timeline-item {
    position: relative;
    margin-bottom: 3rem;
    padding-left: 50px; /* Espace pour la ligne et le point */
}
/* Point sur la ligne */
.tl-dot {
    position: absolute;
    left: 17px; /* Centré sur la ligne (24px - 7px) */
    top: 0;
    width: 16px; height: 16px;
    border-radius: 50%;
    background: var(--warm-white);
    border: 3px solid var(--blush-deep);
    z-index: 2;
    box-shadow: 0 0 0 2px var(--cream); /* Crée un espace blanc autour du point */
}
.tl-date {
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--blush-deep);
    font-weight: 600;
    margin-bottom: 0.5rem;
}
.tl-title {
    font-family: var(--font-serif);
    font-size: 1.4rem;
    font-weight: 400;
    margin-bottom: 0.5rem;
    line-height: 1.2;
}
.tl-desc { font-size: 0.95rem; color: var(--text-muted); line-height: 1.6; margin-bottom: 1rem; }
.tl-image-wrap {
    border-radius: var(--radius);
    overflow: hidden;
    aspect-ratio: 16/9;
    width: 100%;
    box-shadow: var(--shadow);
    margin-top: 1rem;
}
.tl-image-wrap img { width: 100%; height: 100%; object-fit: cover; }

/* ========================
   GIFTS
======================== */
.gifts-header { padding: 0 1.5rem; margin-bottom: 1.5rem; }
.gifts-grid { display: grid; grid-template-columns: 1fr; gap: 1.5rem; padding: 0 1.5rem; }
.gift-card {
    background: var(--warm-white);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    overflow: hidden;
    display: flex;
    flex-direction: column;
}
.gift-img { height: 180px; background: var(--cream); position: relative; }
.gift-img img { width: 100%; height: 100%; object-fit: cover; }
.gift-img-placeholder {
    width: 100%; height: 100%;
    display: flex; align-items: center; justify-content: center;
    font-size: 3rem; background: var(--cream); color: var(--blush-deep);
}
.gift-reserved-badge {
    position: absolute; top: 10px; right: 10px;
    background: var(--text-primary); color: var(--warm-white);
    font-size: 0.7rem; font-weight: 600; padding: 0.25rem 0.75rem;
    border-radius: 50px; letter-spacing: 0.05em;
}
.gift-body { padding: 1.25rem; flex: 1; display: flex; flex-direction: column; }
.gift-category { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-muted); margin-bottom: 0.25rem; }
.gift-name { font-family: var(--font-serif); font-size: 1.25rem; font-weight: 400; margin-bottom: 0.5rem; }
.gift-footer { margin-top: auto; display: flex; align-items: center; justify-content: space-between; padding-top: 1rem; border-top: 1px dashed var(--border); }
.gift-price { font-size: 1.1rem; font-weight: 500; color: var(--text-primary); }

/* Progress Bar */
.gifts-progress { margin: 1rem 1.5rem 2rem; background: var(--warm-white); padding: 1rem; border-radius: var(--radius); border: 1px solid var(--border); }
.progress-label { display: flex; justify-content: space-between; font-size: 0.8rem; color: var(--text-muted); margin-bottom: 0.5rem; }
.progress-bar { height: 8px; background: var(--border); border-radius: 4px; overflow: hidden; }
.progress-fill { height: 100%; background: var(--sage); border-radius: 4px; transition: width 0.6s ease; }

/* ========================
   DONATION & NAMES
======================== */
.donation-card {
    background: var(--text-primary);
    color: var(--cream);
    border-radius: var(--radius);
    padding: 2rem 1.5rem;
    text-align: center;
    margin: 0 1.5rem;
}
.donation-total-circle {
    width: 140px; height: 140px;
    border-radius: 50%;
    border: 2px solid var(--blush-deep);
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    margin: 0 auto 1.5rem;
}
.donation-total-amount { font-family: var(--font-serif); font-size: 2rem; font-weight: 300; line-height: 1; }
.donation-total-label { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-light); margin-top: 0.25rem; }

.amount-options { display: flex; gap: 0.5rem; flex-wrap: wrap; margin-bottom: 1.25rem; justify-content: center; }
.amount-btn {
    padding: 0.5rem 1rem;
    border-radius: 50px;
    border: 1px solid rgba(255,255,255,0.3);
    background: transparent;
    color: var(--cream);
    font-size: 0.9rem;
    cursor: pointer;
}
.amount-btn.active { background: var(--blush-deep); border-color: var(--blush-deep); color: var(--text-primary); }

/* Names */
.name-list { display: flex; flex-direction: column; gap: 1rem; padding: 0 1.5rem; }
.name-item {
    background: var(--warm-white);
    padding: 1rem;
    border-radius: var(--radius-sm);
    border: 1px solid var(--border);
    display: flex;
    align-items: center;
    gap: 1rem;
}
.name-text { flex: 1; font-family: var(--font-serif); font-size: 1.2rem; }
.vote-btn {
    width: 36px; height: 36px;
    border-radius: 50%;
    border: 1px solid var(--border);
    background: transparent;
    color: var(--text-muted);
    font-size: 1.1rem;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer;
}
.vote-btn:active { background: var(--blush-deep); color: white; border-color: var(--blush-deep); }

/* ========================
   MODAL
======================== */
.modal-backdrop {
    position: fixed; inset: 0; background: rgba(58,47,42,0.6); z-index: 2000;
    display: flex; align-items: flex-end; /* Sheet style on mobile */
    opacity: 0; pointer-events: none; transition: opacity 0.3s;
}
.modal-backdrop.open { opacity: 1; pointer-events: all; }
.modal {
    background: var(--warm-white);
    width: 100%; max-width: 500px; margin: 0 auto;
    border-radius: 20px 20px 0 0;
    padding: 2rem;
    transform: translateY(100%); transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}
.modal-backdrop.open .modal { transform: translateY(0); }
.modal-close { position: absolute; top: 1rem; right: 1.5rem; font-size: 1.5rem; background: none; border: none; color: var(--text-muted); cursor: pointer; }

/* ========================
   RESPONSIVE / DESKTOP
======================== */
@media (min-width: 768px) {
    body { padding-bottom: 0; padding-top: 80px; } /* Pour nav desktop */

    /* Navigation Desktop */
    .mobile-nav {
        top: 0; bottom: auto;
        border-top: none; border-bottom: 1px solid var(--border);
        justify-content: center;
        padding: 0 2rem;
        height: 72px;
    }
    .nav-item { flex: 0; margin: 0 1.5rem; flex-direction: row; gap: 0.5rem; font-size: 0.9rem; }
    .nav-item span { font-size: 1.2rem; margin-bottom: 0; }
    .nav-item.active span { transform: none; }

    /* Timeline Desktop */
    .timeline::before { left: 50%; transform: translateX(-50%); width: 1px; background: var(--blush); }
    .timeline-item { display: grid; grid-template-columns: 1fr 40px 1fr; padding: 0; margin-bottom: 4rem; }
    .timeline-item:nth-child(odd) .tl-content { grid-column: 1; text-align: right; padding-right: 2rem; }
    .timeline-item:nth-child(odd) .tl-dot { grid-column: 2; left: auto; position: relative; margin: 0 auto; }
    .timeline-item:nth-child(odd) .tl-image { grid-column: 3; padding-left: 2rem; }

    .timeline-item:nth-child(even) .tl-image { grid-column: 1; text-align: right; padding-right: 2rem; }
    .timeline-item:nth-child(even) .tl-dot { grid-column: 2; left: auto; position: relative; margin: 0 auto; }
    .timeline-item:nth-child(even) .tl-content { grid-column: 3; text-align: left; padding-left: 2rem; }

    /* Grids Desktop */
    .gifts-grid { grid-template-columns: repeat(2, 1fr); }
    .gifts-grid { padding: 0; }
    .hero-img-wrap { border-radius: 50%; width: 450px; height: 550px; margin: 0 auto 3rem; }
    .hero-stats { max-width: 600px; margin: 0 auto 3rem; }

    /* Modal Desktop Center */
    .modal-backdrop { align-items: center; }
    .modal { border-radius: var(--radius); transform: translateY(20px); margin: 0; }
    .modal-backdrop.open .modal { transform: translateY(0); }
}

@media (min-width: 1024px) {
    .gifts-grid { grid-template-columns: repeat(3, 1fr); }
}
</style>
@endpush

@section('content')

{{-- ===== MOBILE NAVIGATION ===== --}}
<nav class="mobile-nav">
    <button class="nav-item active" onclick="switchTab('home')" id="nav-home">
        <span>🏠</span> Accueil
    </button>
    <button class="nav-item" onclick="switchTab('story')" id="nav-story">
        <span>📖</span> Histoire
    </button>
    <button class="nav-item" onclick="switchTab('gifts')" id="nav-gifts">
        <span>🎁</span> Liste
    </button>
    <button class="nav-item" onclick="switchTab('names')" id="nav-names">
        <span>💬</span> Prénom
    </button>
    <button class="nav-item" onclick="switchTab('guestbook')" id="nav-guestbook">
        <span>💌</span> Livre d'or
    </button>
</nav>

{{-- ===== PAGE 1: HOME ===== --}}
<section id="home" class="page-section active-section">
    <div class="hero-header">
        <div class="hero-eyebrow">Bébé arrive bientôt</div>
        <h1 class="hero-title">
            {!! $contentByKey->get('hero_title', 'Un <em>petit miracle</em> est en chemin') !!}
        </h1>
        <p class="hero-desc">{{ $contentByKey->get('hero_subtitle', 'Rejoignez-nous pour célébrer l\'arrivée de ce petit être tant attendu.') }}</p>

        <div style="display: flex; gap: 1rem; justify-content: center; margin-bottom: 2rem;">
            <button onclick="switchTab('gifts')" class="btn btn-primary">Voir la liste</button>
            <button onclick="switchTab('guestbook')" class="btn btn-outline">Laisser un message</button>
        </div>
    </div>

    <div class="hero-img-wrap">
        @if($contentByKey->get('hero_image'))
            <img src="{{ $contentByKey->get('hero_image') }}" alt="Photo principale">
        @else
            <div class="hero-img-placeholder">🌸</div>
        @endif
    </div>

    <div class="hero-stats">
        <div class="stat-item">
            <span class="stat-number">{{ $giftItems->count() }}</span>
            <span class="stat-label">Cadeaux</span>
        </div>
        <div class="stat-item">
            <span class="stat-number">{{ $guestbookMessages->count() }}</span>
            <span class="stat-label">Messages</span>
        </div>
        <div class="stat-item">
            <span class="stat-number">{{ number_format($donationTotal, 0) }}€</span>
            <span class="stat-label">Cagnotte</span>
        </div>
    </div>

    @if($contentByKey->get('due_date'))
    <div style="padding: 0 1.5rem;">
        <p style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-muted); text-align: center; margin-bottom: 1rem;">Le grand jour arrive dans</p>
        <div class="countdown">
            <div class="countdown-item"><span class="countdown-num" id="cd-d">—</span><span class="countdown-lbl">Jours</span></div>
            <div class="countdown-item"><span class="countdown-num" id="cd-h">—</span><span class="countdown-lbl">Heures</span></div>
            <div class="countdown-item"><span class="countdown-num" id="cd-m">—</span><span class="countdown-lbl">Min</span></div>
        </div>
    </div>
    @endif
</section>

{{-- ===== PAGE 2: STORY (TIMELINE) ===== --}}
<section id="story" class="page-section">
    <div class="container" style="padding-top: 1rem;">
        <div class="story-header">
            <p class="section-subtitle">Notre histoire</p>
            <h2 class="section-title">De <em>deux</em> à <em>trois</em></h2>
        </div>
        <div class="timeline">
            @forelse($timelineEvents as $event)
            <div class="timeline-item">
                <div class="tl-dot"></div>
                <div class="tl-content">
                    @if($event->event_date)<div class="tl-date">{{ \Carbon\Carbon::parse($event->event_date)->locale('fr')->isoFormat('MMMM YYYY') }}</div>@endif
                    <h3 class="tl-title">{{ $event->title }}</h3>
                    @if($event->subtitle)<p style="font-size: 0.85rem; color: var(--blush-deep); font-weight: 500; margin-bottom: 0.5rem;">{{ $event->subtitle }}</p>@endif
                    <p class="tl-desc">{{ $event->description }}</p>
                </div>
                @if($event->image_url)
                <div class="tl-image">
                    <div class="tl-image-wrap"><img src="{{ $event->image_url }}" alt="{{ $event->title }}"></div>
                </div>
                @endif
            </div>
            @empty
            <div style="text-align:center; color: var(--text-muted); padding: 3rem;">
                <p style="font-family:var(--font-serif); font-size:1.5rem;">Notre histoire sera bientôt ici ✨</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- ===== PAGE 3: GIFTS ===== --}}
<section id="gifts" class="page-section">
    <div class="container" style="padding-top: 0.5rem;">
        <div class="story-header">
            <p class="section-subtitle">Liste de naissance</p>
            <h2 class="section-title">Idées <em>cadeaux</em></h2>
        </div>

        @php $total = $giftItems->count(); $reserved = $giftItems->where('is_reserved', true)->count(); $pct = $total > 0 ? round($reserved / $total * 100) : 0; @endphp
        <div class="gifts-progress">
            <div class="progress-label">
                <span>{{ $reserved }} réservé(s)</span>
                <span>{{ $pct }}%</span>
            </div>
            <div class="progress-bar"><div class="progress-fill" style="width: {{ $pct }}%"></div></div>
        </div>

        <div class="gifts-grid">
            @forelse($giftItems as $gift)
            <div class="gift-card {{ $gift->is_reserved ? 'reserved' : '' }}" style="{{ $gift->is_reserved ? 'opacity:0.7' : '' }}">
                <div class="gift-img">
                    @if($gift->image_url)
                        <img src="{{ $gift->image_url }}" alt="{{ $gift->name }}" loading="lazy">
                    @else
                        <div class="gift-img-placeholder">🎁</div>
                    @endif
                    @if($gift->is_reserved)
                        <div class="gift-reserved-badge">Réservé</div>
                    @endif
                </div>
                <div class="gift-body">
                    @if($gift->category)<p class="gift-category">{{ $gift->category }}</p>@endif
                    <h3 class="gift-name">{{ $gift->name }}</h3>
                    <div class="gift-footer">
                        <span class="gift-price">{{ number_format($gift->price, 2, ',', ' ') }} €</span>
                        @if(!$gift->is_reserved)
                            <button class="btn btn-blush" style="padding: 0.5rem 1rem; font-size: 0.85rem;" onclick="openGiftModal({{ $gift->id }}, '{{ addslashes($gift->name) }}')">
                                Réserver
                            </button>
                        @else
                            <span style="font-size: 0.75rem; color: var(--text-muted);">par {{ $gift->reserved_by }}</span>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div style="grid-column: 1/-1; text-align: center; padding: 3rem;">
                <p style="font-family:var(--font-serif); font-size:1.5rem; color: var(--text-muted);">Liste bientôt disponible ✨</p>
            </div>
            @endforelse
        </div>

        @if($contentByKey->get('paypal_pool_url'))
        <div style="text-align: center; margin-top: 3rem; padding: 2rem 1.5rem; background: #fff8f8; border-radius: var(--radius);">
            <h3 style="font-family:var(--font-serif); margin-bottom: 0.5rem;">Préférez-vous un don libre ?</h3>
            <p style="font-size: 0.9rem; color: var(--text-muted); margin-bottom: 1rem;">Chaque contribution est un grand pas pour bébé.</p>
            <a href="{{ $contentByKey->get('paypal_pool_url') }}" target="_blank" class="btn btn-outline" style="background: white;">
                Voir la cagnotte PayPal
            </a>
        </div>
        @endif
    </div>
</section>

{{-- ===== PAGE 4: NAMES & DONATION ===== --}}
<section id="names" class="page-section">
    <div class="container" style="padding-top: 0.5rem;">
        <!-- Vote Prénom -->
        <div class="story-header">
            <p class="section-subtitle">Aidez-nous</p>
            <h2 class="section-title">Le <em>Prénom</em></h2>
        </div>

        <div style="padding: 0 1.5rem 2rem;">
            @php $maxVotes = $nameOptions->max('votes_count') ?: 1; @endphp
            <div class="name-list">
                @forelse($nameOptions as $opt)
                <div class="name-item">
                    <span class="name-text">{{ $opt->name }}</span>
                    <div style="flex:1; height: 6px; background: var(--border); border-radius: 3px; margin: 0 0.5rem; overflow:hidden;">
                        <div style="height:100%; width: {{ round($opt->votes_count / $maxVotes * 100) }}%; background: var(--sage);"></div>
                    </div>
                    <span style="font-size: 0.8rem; color: var(--text-muted); margin-right: 0.5rem;">{{ $opt->votes_count }}</span>
                    <button class="vote-btn" onclick="openVoteModal({{ $opt->id }}, '{{ addslashes($opt->name) }}')">♡</button>
                </div>
                @empty
                <p style="text-align: center; color: var(--text-muted);">Aucun prénom proposé pour l'instant.</p>
                @endforelse
            </div>

            <form action="{{ route('names.suggest') }}" method="POST" style="margin-top: 2rem; background: var(--warm-white); padding: 1.5rem; border-radius: var(--radius); border: 1px solid var(--border);">
                @csrf
                <h4 style="font-family: var(--font-serif); font-size: 1.2rem; margin-bottom: 1rem;">Proposer un prénom</h4>
                <div style="display: flex; gap: 0.5rem;">
                    <input type="text" name="name" placeholder="ex. Léo, Chloé..." required style="flex:1;">
                    <button type="submit" class="btn btn-primary" style="padding: 0 1.5rem;">OK</button>
                </div>
            </form>
        </div>

        <!-- Donation Box -->
        <div class="donation-card" style="margin-top: 3rem;">
            <p class="section-subtitle" style="color: var(--text-light);">Cagnotte</p>
            <h2 class="section-title" style="color: var(--warm-white);">Offrir <em>un don</em></h2>
            <p style="margin-bottom: 2rem; color: var(--text-light);">{{ $contentByKey->get('donation_text', 'Pour aider à préparer son arrivée.') }}</p>

            <div class="donation-total-circle">
                <span class="donation-total-amount">{{ number_format($donationTotal, 0, ',', ' ') }} €</span>
                <span class="donation-total-label">collectés</span>
            </div>

            <form action="{{ route('donations.store') }}" method="POST">
                @csrf
                <div class="amount-options">
                    <button type="button" class="amount-btn" onclick="setAmount(10)">10€</button>
                    <button type="button" class="amount-btn" onclick="setAmount(20)">20€</button>
                    <button type="button" class="amount-btn" onclick="setAmount(50)">50€</button>
                </div>
                <div style="display: flex; gap: 0.5rem; margin-bottom: 1rem;">
                    <input type="number" name="amount" id="donationAmount" min="1" placeholder="Autre montant" required style="background: rgba(255,255,255,0.1); border-color: rgba(255,255,255,0.2); color: white; text-align: center;">
                </div>
                <button type="submit" class="btn" style="background: #FFC439; color: #003087; width: 100%; font-weight: 600;">
                    Payer via PayPal
                </button>
            </form>
        </div>
    </div>
</section>

{{-- ===== PAGE 5: GUESTBOOK ===== --}}
<section id="guestbook" class="page-section">
    <div class="container" style="padding-top: 0.5rem;">
        <div class="story-header">
            <p class="section-subtitle">Souvenirs</p>
            <h2 class="section-title">Livre <em>d'or</em></h2>
        </div>

        <div style="padding: 0 1.5rem 2rem;">
            <!-- Messages List -->
            @if($guestbookMessages->isNotEmpty())
            <div style="display: flex; flex-direction: column; gap: 1.5rem; margin-bottom: 3rem;">
                @foreach($guestbookMessages as $msg)
                <div style="background: var(--warm-white); padding: 1.5rem; border-radius: var(--radius); border: 1px solid var(--border); position: relative;">
                    <span style="position: absolute; top: 1rem; left: 1rem; font-family: var(--font-serif); font-size: 3rem; color: var(--blush-deep); opacity: 0.2; line-height: 0;">&ldquo;</span>
                    <p style="font-style: italic; margin-bottom: 1rem; padding-left: 1rem; position: relative; z-index: 1;">{{ $msg->message }}</p>
                    <div style="display: flex; justify-content: space-between; align-items: center; font-size: 0.8rem; color: var(--text-muted);">
                        <span style="font-weight: 600; text-transform: uppercase;">{{ $msg->author }}</span>
                        <span>{{ $msg->created_at->locale('fr')->diffForHumans() }}</span>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            <!-- Form -->
            <form action="{{ route('guestbook.store') }}" method="POST" style="background: var(--cream); padding: 2rem; border-radius: var(--radius); border: 1px dashed var(--blush-deep);">
                @csrf
                <h3 style="font-family:var(--font-serif); font-size: 1.5rem; margin-bottom: 1.5rem; text-align: center;">Écrivez un message 💌</h3>
                <div class="form-group">
                    <label>Votre prénom</label>
                    <input type="text" name="author" required placeholder="ex. Tatie Marie">
                </div>
                <div class="form-group">
                    <label>Votre message</label>
                    <textarea name="message" required rows="4" placeholder="Un petit mot doux pour bébé..." style="resize: none;"></textarea>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%;">Envoyer 💝</button>
            </form>
        </div>
    </div>
</section>

{{-- ===== MODALS ===== --}}
<div class="modal-backdrop" id="giftModal">
    <div class="modal">
        <button class="modal-close" onclick="closeModal('giftModal')">×</button>
        <h3 class="modal-title">Réserver <em id="modalGiftName">ce cadeau</em></h3>
        <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1.5rem;">Votre prénom sera affiché aux parents. Merci !</p>
        <form id="giftReserveForm" method="POST">
            @csrf
            @method('POST')
            <div class="form-group">
                <label>Votre prénom</label>
                <input type="text" name="reserver_name" required placeholder="ex. Jean">
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%">Confirmer</button>
        </form>
    </div>
</div>

<div class="modal-backdrop" id="voteModal">
    <div class="modal">
        <button class="modal-close" onclick="closeModal('voteModal')">×</button>
        <h3 class="modal-title">Voter pour <em id="modalVoteName">ce prénom</em></h3>
        <form id="voteForm" method="POST">
            @csrf
            <div class="form-group">
                <label>Votre prénom</label>
                <input type="text" name="voter_name" required placeholder="ex. Sophie">
            </div>
            <button type="submit" class="btn btn-blush" style="width:100%">Valider mon vote ♡</button>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
// === NAVIGATION SYSTEM (SPA) ===
function switchTab(tabId) {
    // Cacher toutes les sections
    document.querySelectorAll('.page-section').forEach(el => {
        el.classList.remove('active-section');
    });
    // Désactiver tous les boutons nav
    document.querySelectorAll('.nav-item').forEach(el => {
        el.classList.remove('active');
    });

    // Activer la cible
    document.getElementById(tabId).classList.add('active-section');
    document.getElementById('nav-' + tabId).classList.add('active');

    // Scroll top
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// === COUNTDOWN ===
@if($contentByKey->get('due_date'))
(function() {
    const target = new Date('{{ $contentByKey->get("due_date") }}T00:00:00');
    function update() {
        const diff = target - new Date();
        if (diff <= 0) {
            document.getElementById('cd-d').textContent = "0";
            return;
        }
        const d = Math.floor(diff / 86400000);
        const h = Math.floor(diff % 86400000 / 3600000);
        const m = Math.floor(diff % 3600000 / 60000);

        document.getElementById('cd-d').textContent = String(d).padStart(2,'0');
        document.getElementById('cd-h').textContent = String(h).padStart(2,'0');
        document.getElementById('cd-m').textContent = String(m).padStart(2,'0');
    }
    update(); setInterval(update, 1000);
})();
@endif

// === MODALS ===
function openGiftModal(id, name) {
    document.getElementById('modalGiftName').textContent = name;
    document.getElementById('giftReserveForm').action = '/gifts/' + id + '/reserve';
    document.getElementById('giftModal').classList.add('open');
}
function openVoteModal(id, name) {
    document.getElementById('modalVoteName').textContent = name;
    document.getElementById('voteForm').action = '/names/' + id + '/vote';
    document.getElementById('voteModal').classList.add('open');
}
function closeModal(id) {
    document.getElementById(id).classList.remove('open');
}
// Close on backdrop click
document.querySelectorAll('.modal-backdrop').forEach(b => {
    b.addEventListener('click', function(e) {
        if (e.target === this) this.classList.remove('open');
    });
});

// === DONATION ===
function setAmount(val) {
    const input = document.getElementById('donationAmount');
    input.value = val;
    input.focus();
    document.querySelectorAll('.amount-btn').forEach(b => b.classList.remove('active'));
    event.currentTarget.classList.add('active');
}
</script>
@endpush
