{{-- @extends('layouts.site')

@section('content')
    @include('site.pages.home')
    @include('site.pages.story')
    @include('site.pages.list')
    @include('site.pages.names')
    @include('site.pages.urn')
    @include('site.pages.advice')
@endsection --}}

@extends('layouts.app')

@section('title', 'Baby Shower · Bébé arrive bientôt ✨')

@push('styles')
<style>
/* ========================
   HERO
======================== */
.hero {
    min-height: calc(100vh - 72px);
    display: grid;
    grid-template-columns: 1fr 1fr;
    align-items: center;
    gap: 4rem;
    padding: 4rem 2rem 4rem;
    max-width: 1100px;
    margin: 0 auto;
    position: relative;
}
.hero-content { position: relative; z-index: 2; }
.hero-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.8rem;
    font-weight: 500;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: var(--blush-deep);
    margin-bottom: 1.5rem;
}
.hero-eyebrow::before, .hero-eyebrow::after {
    content: '';
    width: 32px; height: 1px;
    background: var(--blush-deep);
    display: block;
}
.hero-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(3rem, 6vw, 5rem);
    font-weight: 300;
    line-height: 1.08;
    color: var(--text-primary);
    margin-bottom: 1.5rem;
}
.hero-title em { color: var(--blush-deep); font-style: italic; font-weight: 300; }
.hero-desc {
    color: var(--text-muted);
    font-size: 1.05rem;
    line-height: 1.8;
    margin-bottom: 2.5rem;
    max-width: 420px;
}
.hero-actions { display: flex; gap: 1rem; flex-wrap: wrap; }
.hero-stats {
    display: flex;
    gap: 2rem;
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 1px solid var(--border);
}
.stat-item {}
.stat-number {
    font-family: 'Cormorant Garamond', serif;
    font-size: 2rem;
    font-weight: 300;
    color: var(--text-primary);
    display: block;
}
.stat-label {
    font-size: 0.78rem;
    color: var(--text-muted);
    letter-spacing: 0.05em;
    text-transform: uppercase;
}
.hero-visual {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 520px;
}
.hero-img-wrap {
    width: 380px;
    height: 460px;
    border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%;
    overflow: hidden;
    position: relative;
    box-shadow: 0 24px 64px rgba(58,47,42,0.15);
}
.hero-img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.hero-img-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, var(--blush) 0%, var(--blush-deep) 50%, var(--sage) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Cormorant Garamond', serif;
    font-size: 5rem;
    color: white;
    opacity: 0.7;
}
.hero-floater {
    position: absolute;
    background: var(--warm-white);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 1rem 1.25rem;
    box-shadow: 0 8px 32px rgba(58,47,42,0.1);
}
.hero-floater-1 { top: 60px; right: -20px; }
.hero-floater-2 { bottom: 80px; left: -20px; }
.floater-label { font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--text-muted); }
.floater-value { font-family: 'Cormorant Garamond', serif; font-size: 1.4rem; font-weight: 300; color: var(--text-primary); }
.deco-ring {
    position: absolute;
    border-radius: 50%;
    border: 1px solid var(--blush);
    opacity: 0.4;
    pointer-events: none;
}
/* countdown */
.countdown {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin: 1rem 0;
}
.countdown-item {
    text-align: center;
    background: var(--cream);
    border-radius: 12px;
    padding: 0.75rem 1rem;
    min-width: 60px;
}
.countdown-num {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.75rem;
    font-weight: 300;
    color: var(--text-primary);
    display: block;
}
.countdown-lbl { font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--text-muted); }

/* ========================
   STORY / TIMELINE
======================== */
.story-section {
    background: var(--cream);
    position: relative;
    overflow: hidden;
}
.story-header { text-align: center; margin-bottom: 4rem; }
.timeline {
    position: relative;
    max-width: 800px;
    margin: 0 auto;
}
.timeline::before {
    content: '';
    position: absolute;
    left: 50%;
    top: 0; bottom: 0;
    width: 1px;
    background: var(--blush);
    transform: translateX(-50%);
}
.timeline-item {
    display: grid;
    grid-template-columns: 1fr 60px 1fr;
    gap: 0;
    margin-bottom: 3rem;
    position: relative;
    align-items: start;
}
.timeline-item:nth-child(odd) .tl-content { grid-column: 1; text-align: right; padding-right: 2rem; }
.timeline-item:nth-child(odd) .tl-content { grid-row: 1; }
.timeline-item:nth-child(odd) .tl-dot { grid-column: 2; grid-row: 1; }
.timeline-item:nth-child(odd) .tl-image { grid-column: 3; grid-row: 1; padding-left: 2rem; }

.timeline-item:nth-child(even) .tl-image { grid-column: 1; grid-row: 1; padding-right: 2rem; text-align: right; }
.timeline-item:nth-child(even) .tl-dot { grid-column: 2; grid-row: 1; }
.timeline-item:nth-child(even) .tl-content { grid-column: 3; grid-row: 1; text-align: left; padding-left: 2rem; }

.tl-dot {
    display: flex;
    align-items: flex-start;
    justify-content: center;
    padding-top: 0.25rem;
}
.tl-dot-inner {
    width: 14px; height: 14px;
    border-radius: 50%;
    background: var(--blush-deep);
    border: 3px solid var(--warm-white);
    box-shadow: 0 0 0 2px var(--blush-deep);
    flex-shrink: 0;
}
.tl-date {
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--blush-deep);
    font-weight: 500;
    margin-bottom: 0.4rem;
}
.tl-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.3rem;
    font-weight: 400;
    margin-bottom: 0.4rem;
}
.tl-desc { font-size: 0.9rem; color: var(--text-muted); line-height: 1.7; }
.tl-image-wrap {
    border-radius: 16px;
    overflow: hidden;
    aspect-ratio: 4/3;
    max-width: 200px;
    box-shadow: 0 8px 24px rgba(58,47,42,0.1);
}
.tl-image-wrap img { width: 100%; height: 100%; object-fit: cover; }
.tl-image-placeholder {
    width: 100%;
    height: 100%;
    min-height: 140px;
    background: var(--blush);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    opacity: 0.5;
}

/* ========================
   GIFTS
======================== */
.gifts-section {}
.gifts-header { display: flex; align-items: flex-end; justify-content: space-between; margin-bottom: 3rem; flex-wrap: wrap; gap: 1rem; }
.gifts-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem; }
.gift-card {
    background: var(--warm-white);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    overflow: hidden;
    transition: transform 0.2s, box-shadow 0.2s;
    position: relative;
}
.gift-card:hover { transform: translateY(-4px); box-shadow: 0 16px 40px rgba(58,47,42,0.1); }
.gift-card.reserved { opacity: 0.65; }
.gift-img {
    height: 200px;
    overflow: hidden;
    background: var(--cream);
    position: relative;
}
.gift-img img { width: 100%; height: 100%; object-fit: cover; }
.gift-img-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    background: var(--cream);
    color: var(--blush-deep);
}
.gift-reserved-badge {
    position: absolute;
    top: 12px; right: 12px;
    background: var(--text-primary);
    color: var(--warm-white);
    font-size: 0.7rem;
    font-weight: 500;
    padding: 0.3rem 0.7rem;
    border-radius: 50px;
    letter-spacing: 0.04em;
}
.gift-body { padding: 1.25rem 1.5rem 1.5rem; }
.gift-category {
    font-size: 0.72rem;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--text-muted);
    margin-bottom: 0.35rem;
}
.gift-name {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.2rem;
    font-weight: 400;
    margin-bottom: 0.75rem;
}
.gift-footer { display: flex; align-items: center; justify-content: space-between; margin-top: 1rem; }
.gift-price { font-size: 1.1rem; font-weight: 500; }
.gifts-progress { margin-bottom: 2.5rem; }
.progress-label { display: flex; justify-content: space-between; font-size: 0.85rem; color: var(--text-muted); margin-bottom: 0.5rem; }
.progress-bar { height: 6px; background: var(--border); border-radius: 50px; overflow: hidden; }
.progress-fill { height: 100%; background: linear-gradient(90deg, var(--blush-deep), var(--gold)); border-radius: 50px; transition: width 0.6s ease; }

/* Gift modal */
.modal-backdrop {
    position: fixed; inset: 0;
    background: rgba(58,47,42,0.5);
    z-index: 300;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.25s;
}
.modal-backdrop.open { opacity: 1; pointer-events: all; }
.modal {
    background: var(--warm-white);
    border-radius: var(--radius);
    padding: 2rem;
    max-width: 420px;
    width: 100%;
    transform: translateY(20px);
    transition: transform 0.25s;
    box-shadow: 0 24px 64px rgba(58,47,42,0.2);
}
.modal-backdrop.open .modal { transform: translateY(0); }
.modal-title { font-family: 'Cormorant Garamond', serif; font-size: 1.5rem; font-weight: 300; margin-bottom: 1.5rem; }
.modal-close {
    position: absolute;
    top: 1.25rem; right: 1.5rem;
    background: none; border: none;
    font-size: 1.5rem; cursor: pointer;
    color: var(--text-muted);
}

/* ========================
   DONATION
======================== */
.donation-section {
    background: var(--text-primary);
    color: var(--cream);
    position: relative;
    overflow: hidden;
}
.donation-section .section-title { color: var(--cream); }
.donation-section .section-title em { color: var(--blush); }
.donation-section p { color: var(--text-light); }
.donation-inner { display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center; }
.donation-total-wrap { text-align: center; }
.donation-total-circle {
    width: 220px; height: 220px;
    border-radius: 50%;
    border: 2px solid rgba(245,214,204,0.3);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    position: relative;
}
.donation-total-amount {
    font-family: 'Cormorant Garamond', serif;
    font-size: 2.75rem;
    font-weight: 300;
    color: var(--warm-white);
    line-height: 1;
}
.donation-total-label { font-size: 0.78rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-light); margin-top: 0.25rem; }
.donation-form-wrap { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius); padding: 2rem; }
.donation-form-wrap label { color: rgba(255,255,255,0.6); }
.donation-form-wrap input { background: rgba(255,255,255,0.08); border-color: rgba(255,255,255,0.15); color: var(--warm-white); }
.donation-form-wrap input::placeholder { color: rgba(255,255,255,0.3); }
.amount-options { display: flex; gap: 0.5rem; flex-wrap: wrap; margin-bottom: 1.25rem; }
.amount-btn {
    padding: 0.5rem 1rem;
    border-radius: 50px;
    border: 1.5px solid rgba(255,255,255,0.2);
    background: transparent;
    color: var(--cream);
    font-size: 0.875rem;
    cursor: pointer;
    transition: all 0.2s;
    font-family: 'DM Sans', sans-serif;
}
.amount-btn:hover, .amount-btn.active { background: var(--blush); border-color: var(--blush); color: var(--text-primary); }
.paypal-btn {
    width: 100%;
    background: #FFC439;
    color: #003087;
    border: none;
    border-radius: 50px;
    padding: 0.85rem 1.5rem;
    font-size: 0.95rem;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    font-family: 'DM Sans', sans-serif;
    transition: opacity 0.2s;
    margin-top: 1rem;
}
.paypal-btn:hover { opacity: 0.9; }

/* ========================
   NAME VOTE
======================== */
.name-section { background: var(--cream); }
.name-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; }
.name-list { display: flex; flex-direction: column; gap: 0.75rem; }
.name-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 1.25rem;
    background: var(--warm-white);
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    transition: box-shadow 0.2s;
}
.name-item:hover { box-shadow: var(--shadow); }
.name-text { flex: 1; font-family: 'Cormorant Garamond', serif; font-size: 1.15rem; font-weight: 400; }
.name-votes { font-size: 0.8rem; color: var(--text-muted); white-space: nowrap; }
.name-bar-wrap { flex: 1; height: 4px; background: var(--border); border-radius: 50px; margin: 0 0.75rem; overflow: hidden; }
.name-bar { height: 100%; background: var(--blush-deep); border-radius: 50px; transition: width 0.6s; }
.vote-btn {
    width: 32px; height: 32px;
    border-radius: 50%;
    border: 1.5px solid var(--border);
    background: transparent;
    cursor: pointer;
    font-size: 0.8rem;
    color: var(--text-muted);
    transition: all 0.2s;
    flex-shrink: 0;
}
.vote-btn:hover { background: var(--blush); border-color: var(--blush); color: var(--text-primary); }

/* ========================
   GUESTBOOK
======================== */
.guestbook-section {}
.messages-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem; margin-bottom: 3rem; }
.message-card {
    background: var(--cream);
    border-radius: var(--radius);
    padding: 1.75rem;
    position: relative;
    border: 1px solid var(--border);
}
.message-quote {
    font-family: 'Cormorant Garamond', serif;
    font-size: 3rem;
    font-weight: 300;
    color: var(--blush);
    line-height: 0.5;
    margin-bottom: 1rem;
    display: block;
}
.message-text { font-size: 0.95rem; line-height: 1.75; color: var(--text-primary); margin-bottom: 1.25rem; font-style: italic; }
.message-author { font-size: 0.8rem; font-weight: 500; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.06em; }
.message-date { font-size: 0.75rem; color: var(--text-light); }
.guestbook-form-wrap { max-width: 600px; margin: 0 auto; }
.guestbook-form-wrap .card { background: var(--cream); }

/* ========================
   RESPONSIVE
======================== */
@media (max-width: 900px) {
    .hero { grid-template-columns: 1fr; text-align: center; }
    .hero-visual { display: none; }
    .hero-desc { max-width: 100%; }
    .hero-actions { justify-content: center; }
    .hero-stats { justify-content: center; }
    .timeline::before { display: none; }
    .timeline-item { grid-template-columns: 1fr; }
    .timeline-item:nth-child(odd) .tl-content,
    .timeline-item:nth-child(even) .tl-content { grid-column: 1; text-align: left; padding: 0; }
    .timeline-item:nth-child(odd) .tl-image,
    .timeline-item:nth-child(even) .tl-image { grid-column: 1; padding: 1rem 0; text-align: left; }
    .timeline-item .tl-dot { display: none; }
    .donation-inner { grid-template-columns: 1fr; }
    .name-grid { grid-template-columns: 1fr; }
    .gifts-header { flex-direction: column; align-items: flex-start; }
}
</style>
@endpush

@section('content')

{{-- ===== HERO ===== --}}
<section style="min-height: calc(100vh - 72px); position: relative; overflow: hidden;">
    <div class="deco-petal" style="background: var(--blush); top: -100px; right: -100px; width: 500px; height: 500px;"></div>
    <div class="deco-petal" style="background: var(--sage); bottom: -50px; left: -100px; width: 350px; height: 350px;"></div>

    <div class="hero">
        <div class="hero-content">
            <div class="hero-eyebrow">Bébé arrive bientôt</div>
            <h1 class="hero-title">
                {!! $contentByKey->get('hero_title', 'Un <em>petit miracle</em> est en chemin') !!}
            </h1>
            <p class="hero-desc">{{ $contentByKey->get('hero_subtitle', 'Rejoignez-nous pour célébrer l\'arrivée de ce petit être tant attendu. Partagez vos voeux, réservez un cadeau et participez au vote du prénom.') }}</p>
            <div class="hero-actions">
                <a href="#cadeaux" class="btn btn-primary">Voir la liste cadeaux</a>
                <a href="#participer" class="btn btn-outline">Laisser un message</a>
            </div>
            <div class="hero-stats">
                <div class="stat-item">
                    <span class="stat-number" id="heroGiftCount">{{ $giftItems->count() }}</span>
                    <span class="stat-label">Cadeaux</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ $guestbookMessages->count() }}</span>
                    <span class="stat-label">Messages</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ number_format($donationTotal, 0) }}€</span>
                    <span class="stat-label">Collectés</span>
                </div>
            </div>
        </div>
        <div class="hero-visual">
            <div class="deco-ring" style="width: 480px; height: 480px; top: 50%; left: 50%; transform: translate(-50%,-50%);"></div>
            <div class="deco-ring" style="width: 380px; height: 380px; top: 50%; left: 50%; transform: translate(-50%,-50%); border-color: var(--sage);"></div>
            <div class="hero-img-wrap">
                @if($contentByKey->get('hero_image'))
                    <img src="{{ $contentByKey->get('hero_image') }}" alt="Photo principale">
                @else
                    <div class="hero-img-placeholder">🌸</div>
                @endif
            </div>
            <div class="hero-floater hero-floater-1">
                @php
                    $dateNaissance = $contentByKey->get('due_date') ? \Carbon\Carbon::parse($contentByKey->get('due_date')) : null;
                @endphp
                <div class="floater-label">Date prévue</div>
                <div class="floater-value">{{ $dateNaissance ? $dateNaissance->locale('fr')->isoFormat('D MMM') : '— — —' }}</div>
            </div>
            <div class="hero-floater hero-floater-2">
                <div class="floater-label">Réservés</div>
                <div class="floater-value">{{ $reservedGiftsCount }} / {{ $giftItems->count() }}</div>
            </div>
        </div>
    </div>

    @if($contentByKey->get('due_date'))
    <div style="text-align: center; padding: 0 2rem 4rem;">
        <p style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-muted); margin-bottom: 1rem;">Le grand jour arrive dans</p>
        <div class="countdown" id="countdown">
            <div class="countdown-item"><span class="countdown-num" id="cd-d">—</span><span class="countdown-lbl">Jours</span></div>
            <div class="countdown-item"><span class="countdown-num" id="cd-h">—</span><span class="countdown-lbl">Heures</span></div>
            <div class="countdown-item"><span class="countdown-num" id="cd-m">—</span><span class="countdown-lbl">Min</span></div>
            <div class="countdown-item"><span class="countdown-num" id="cd-s">—</span><span class="countdown-lbl">Sec</span></div>
        </div>
    </div>
    @endif
</section>

{{-- ===== STORY / TIMELINE ===== --}}
<section class="section story-section" id="histoire">
    <div class="deco-petal" style="background: var(--blush); top: -80px; left: -80px; opacity: 0.08;"></div>
    <div class="container">
        <div class="story-header">
            <p class="section-subtitle">Notre histoire d'amour</p>
            <h2 class="section-title">De <em>deux</em> à <em>trois</em></h2>
            <p style="color: var(--text-muted); max-width: 500px; margin: 1rem auto 0;">{{ $contentByKey->get('story_intro', 'Retracez les moments qui nous ont conduits jusqu\'à cette belle aventure.') }}</p>
        </div>
        <div class="timeline">
            @forelse($timelineEvents as $event)
            <div class="timeline-item">
                @if($loop->odd)
                    <div class="tl-content">
                        @if($event->event_date)<div class="tl-date">{{ \Carbon\Carbon::parse($event->event_date)->locale('fr')->isoFormat('MMMM YYYY') }}</div>@endif
                        <h3 class="tl-title">{{ $event->title }}</h3>
                        @if($event->subtitle)<p style="font-size: 0.8rem; color: var(--blush-deep); margin-bottom: 0.4rem; font-weight: 500;">{{ $event->subtitle }}</p>@endif
                        <p class="tl-desc">{{ $event->description }}</p>
                    </div>
                    <div class="tl-dot"><div class="tl-dot-inner"></div></div>
                    <div class="tl-image">
                        @if($event->image_url)
                            <div class="tl-image-wrap"><img src="{{ $event->image_url }}" alt="{{ $event->title }}"></div>
                        @else
                            <div class="tl-image-wrap"><div class="tl-image-placeholder">🌿</div></div>
                        @endif
                    </div>
                @else
                    <div class="tl-image">
                        @if($event->image_url)
                            <div class="tl-image-wrap" style="margin-left:auto"><img src="{{ $event->image_url }}" alt="{{ $event->title }}"></div>
                        @else
                            <div class="tl-image-wrap" style="margin-left:auto"><div class="tl-image-placeholder">🌸</div></div>
                        @endif
                    </div>
                    <div class="tl-dot"><div class="tl-dot-inner"></div></div>
                    <div class="tl-content">
                        @if($event->event_date)<div class="tl-date">{{ \Carbon\Carbon::parse($event->event_date)->locale('fr')->isoFormat('MMMM YYYY') }}</div>@endif
                        <h3 class="tl-title">{{ $event->title }}</h3>
                        @if($event->subtitle)<p style="font-size: 0.8rem; color: var(--blush-deep); margin-bottom: 0.4rem; font-weight: 500;">{{ $event->subtitle }}</p>@endif
                        <p class="tl-desc">{{ $event->description }}</p>
                    </div>
                @endif
            </div>
            @empty
            <div style="text-align:center; color: var(--text-muted); padding: 3rem;">
                <p style="font-family:'Cormorant Garamond',serif; font-size:1.5rem; font-weight:300;">Notre histoire sera bientôt ici ✨</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- ===== GIFTS ===== --}}
<section class="section" id="cadeaux">
    <div class="container">
        <div class="gifts-header">
            <div>
                <p class="section-subtitle">Liste de naissance</p>
                <h2 class="section-title">Idées <em>cadeaux</em></h2>
            </div>
            <div>
                @php $total = $giftItems->count(); $reserved = $giftItems->where('is_reserved', true)->count(); $pct = $total > 0 ? round($reserved / $total * 100) : 0; @endphp
                <div class="gifts-progress" style="min-width: 220px;">
                    <div class="progress-label">
                        <span>{{ $reserved }} réservé{{ $reserved > 1 ? 's' : '' }}</span>
                        <span>{{ $pct }}%</span>
                    </div>
                    <div class="progress-bar"><div class="progress-fill" style="width: {{ $pct }}%"></div></div>
                </div>
            </div>
        </div>
        <div class="gifts-grid">
            @forelse($giftItems as $gift)
            <div class="gift-card {{ $gift->is_reserved ? 'reserved' : '' }}">
                <div class="gift-img">
                    @if($gift->image_url)
                        <img src="{{ $gift->image_url }}" alt="{{ $gift->name }}">
                    @else
                        <div class="gift-img-placeholder">🎁</div>
                    @endif
                    @if($gift->is_reserved)
                        <div class="gift-reserved-badge">✓ Réservé</div>
                    @endif
                </div>
                <div class="gift-body">
                    @if($gift->category)<p class="gift-category">{{ $gift->category }}</p>@endif
                    <h3 class="gift-name">{{ $gift->name }}</h3>
                    <div class="gift-footer">
                        <span class="gift-price">{{ number_format($gift->price, 2, ',', ' ') }} €</span>
                        @if(!$gift->is_reserved)
                            <button class="btn btn-blush" onclick="openGiftModal({{ $gift->id }}, '{{ addslashes($gift->name) }}')" style="padding: 0.5rem 1.1rem; font-size: 0.82rem;">
                                Réserver
                            </button>
                        @else
                            <span style="font-size: 0.8rem; color: var(--text-muted);">par {{ $gift->reserved_by }}</span>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div style="grid-column: 1/-1; text-align: center; padding: 4rem; color: var(--text-muted);">
                <p style="font-family:'Cormorant Garamond',serif; font-size:1.5rem; font-weight:300;">La liste sera bientôt disponible ✨</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- Gift Modal --}}
<div class="modal-backdrop" id="giftModal">
    <div class="modal" style="position: relative;">
        <button class="modal-close" onclick="closeGiftModal()">×</button>
        <h3 class="modal-title">Réserver <em id="modalGiftName" style="color: var(--blush-deep);">ce cadeau</em></h3>
        <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1.5rem;">Votre prénom sera indiqué comme réservant. Merci de votre générosité ! 💝</p>
        <form id="giftReserveForm" method="POST">
            @csrf
            @method('POST')
            <div class="form-group">
                <label>Votre prénom</label>
                <input type="text" name="reserver_name" required placeholder="ex. Marie">
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%">Confirmer la réservation</button>
        </form>
    </div>
</div>

{{-- ===== DONATION ===== --}}
<section class="section donation-section" id="participer">
    <div style="position: absolute; inset: 0; opacity: 0.03; background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.5) 1px, transparent 0); background-size: 24px 24px;"></div>
    <div class="container" style="position: relative; z-index: 1;">
        <div class="donation-inner">
            <div class="donation-total-wrap">
                <p class="section-subtitle" style="color: var(--text-light);">Cagnotte</p>
                <h2 class="section-title">Offrir <em>un don</em></h2>
                <p style="margin: 1rem 0 2rem; max-width: 360px;">{{ $contentByKey->get('donation_text', 'Participez à la cagnotte pour aider les jeunes parents à préparer l\'arrivée de bébé.') }}</p>
                <div class="donation-total-circle">
                    <span class="donation-total-amount">{{ number_format($donationTotal, 0, ',', ' ') }} €</span>
                    <span class="donation-total-label">collectés</span>
                </div>
                @if($contentByKey->get('paypal_pool_url'))
                <a href="{{ $contentByKey->get('paypal_pool_url') }}" target="_blank" class="paypal-btn">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M7.076 21.337H2.47a.641.641 0 0 1-.633-.74L4.944.901C5.026.382 5.474 0 5.998 0h7.46c2.57 0 4.578.543 5.69 1.81 1.01 1.15 1.304 2.42 1.012 4.287-.023.143-.047.288-.077.437-.983 5.05-4.349 6.797-8.647 6.797h-2.19c-.524 0-.968.382-1.05.9l-1.12 7.106zm14.146-14.42a3.35 3.35 0 0 0-.607-.541c-.013.076-.026.175-.041.254-.59 3.025-2.566 6.082-8.558 6.082H9.825l-1.296 8.218H12.6c.458 0 .85-.333.92-.785l.038-.197.733-4.648.047-.256a.933.933 0 0 1 .92-.785h.58c3.748 0 6.683-1.523 7.541-5.927.36-1.845.173-3.385-.757-4.415z"/></svg>
                    Cagnotte PayPal
                </a>
                @endif
            </div>
            <div class="donation-form-wrap">
                <h3 style="font-family:'Cormorant Garamond',serif; font-size:1.4rem; font-weight:300; color: var(--cream); margin-bottom: 1.5rem;">Faire un don</h3>
                <div class="amount-options">
                    <button class="amount-btn" onclick="setAmount(10)">10 €</button>
                    <button class="amount-btn" onclick="setAmount(20)">20 €</button>
                    <button class="amount-btn" onclick="setAmount(50)">50 €</button>
                    <button class="amount-btn" onclick="setAmount(100)">100 €</button>
                </div>
                <form action="{{ route('donations.store') }}" method="POST" id="donationForm">
                    @csrf
                    <div class="form-group">
                        <label>Montant (€)</label>
                        <input type="number" name="amount" id="donationAmount" min="1" placeholder="Montant libre..." required>
                    </div>
                    <div class="form-group">
                        <label>Votre prénom (facultatif)</label>
                        <input type="text" name="donor_name" placeholder="Anonyme">
                    </div>
                    <div class="form-group">
                        <label>Message (facultatif)</label>
                        <input type="text" name="note" placeholder="Un petit mot ?">
                    </div>
                    <input type="hidden" name="payment_method" value="paypal">
                    @if($contentByKey->get('paypal_email'))
                    <button type="submit" class="paypal-btn">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M7.076 21.337H2.47a.641.641 0 0 1-.633-.74L4.944.901C5.026.382 5.474 0 5.998 0h7.46c2.57 0 4.578.543 5.69 1.81 1.01 1.15 1.304 2.42 1.012 4.287-.023.143-.047.288-.077.437-.983 5.05-4.349 6.797-8.647 6.797h-2.19c-.524 0-.968.382-1.05.9l-1.12 7.106zm14.146-14.42a3.35 3.35 0 0 0-.607-.541c-.013.076-.026.175-.041.254-.59 3.025-2.566 6.082-8.558 6.082H9.825l-1.296 8.218H12.6c.458 0 .85-.333.92-.785l.038-.197.733-4.648.047-.256a.933.933 0 0 1 .92-.785h.58c3.748 0 6.683-1.523 7.541-5.927.36-1.845.173-3.385-.757-4.415z"/></svg>
                        Payer via PayPal
                    </button>
                    @else
                    <button type="submit" class="btn btn-blush" style="width:100%">Enregistrer le don</button>
                    @endif
                </form>
            </div>
        </div>
    </div>
</section>

{{-- ===== NAME VOTE ===== --}}
<section class="section name-section" id="prenom">
    <div class="container">
        <div style="text-align: center; margin-bottom: 3.5rem;">
            <p class="section-subtitle">On a besoin de vous !</p>
            <h2 class="section-title">Votez pour le <em>prénom</em></h2>
            <p style="color: var(--text-muted); max-width: 480px; margin: 1rem auto 0;">{{ $contentByKey->get('names_intro', 'Nous héstitons encore ! Aidez-nous à choisir le prénom de notre petit bout.') }}</p>
        </div>
        <div class="name-grid">
            <div>
                <h3 style="font-family:'Cormorant Garamond',serif; font-size:1.3rem; font-weight:300; margin-bottom: 1.25rem; color: var(--text-muted);">Les candidats</h3>
                <div class="name-list" id="nameList">
                    @php $maxVotes = $nameOptions->max('votes_count') ?: 1; @endphp
                    @forelse($nameOptions as $opt)
                    <div class="name-item" id="name-{{ $opt->id }}">
                        <span class="name-text">{{ $opt->name }}</span>
                        <div class="name-bar-wrap">
                            <div class="name-bar" style="width: {{ round($opt->votes_count / $maxVotes * 100) }}%"></div>
                        </div>
                        <span class="name-votes">{{ $opt->votes_count }} vote{{ $opt->votes_count > 1 ? 's' : '' }}</span>
                        <button class="vote-btn" onclick="openVoteModal({{ $opt->id }}, '{{ addslashes($opt->name) }}')" title="Voter">♡</button>
                    </div>
                    @empty
                    <p style="color: var(--text-muted); font-style: italic;">Aucun prénom proposé pour l'instant.</p>
                    @endforelse
                </div>
            </div>
            <div>
                <h3 style="font-family:'Cormorant Garamond',serif; font-size:1.3rem; font-weight:300; margin-bottom: 1.25rem; color: var(--text-muted);">Proposer un prénom</h3>
                <div class="card">
                    <form action="{{ route('names.suggest') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Votre suggestion</label>
                            <input type="text" name="name" placeholder="ex. Luna, Théo, Rose..." required minlength="2" maxlength="50">
                        </div>
                        <button type="submit" class="btn btn-primary" style="width:100%">Proposer ce prénom ✨</button>
                    </form>
                </div>
                <div style="margin-top: 1.5rem; padding: 1.25rem; background: var(--warm-white); border-radius: var(--radius-sm); border: 1px solid var(--border); text-align: center;">
                    <span style="font-family:'Cormorant Garamond',serif; font-size: 2rem; font-weight: 300; color: var(--blush-deep); display: block;">{{ $nameOptions->sum('votes_count') }}</span>
                    <span style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--text-muted);">votes au total</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Vote Modal --}}
<div class="modal-backdrop" id="voteModal">
    <div class="modal" style="position: relative;">
        <button class="modal-close" onclick="closeVoteModal()">×</button>
        <h3 class="modal-title">Voter pour <em id="modalVoteName" style="color: var(--blush-deep);">ce prénom</em></h3>
        <form id="voteForm" method="POST">
            @csrf
            <div class="form-group">
                <label>Votre prénom</label>
                <input type="text" name="voter_name" required placeholder="ex. Marie" minlength="2" maxlength="80">
            </div>
            <button type="submit" class="btn btn-blush" style="width:100%">Valider mon vote ♡</button>
        </form>
    </div>
</div>

{{-- ===== GUESTBOOK ===== --}}
<section class="section guestbook-section" id="livre-or">
    <div class="container">
        <div style="text-align: center; margin-bottom: 3.5rem;">
            <p class="section-subtitle">Laissez un souvenir</p>
            <h2 class="section-title">Livre <em>d'or</em></h2>
        </div>
        @if($guestbookMessages->isNotEmpty())
        <div class="messages-grid">
            @foreach($guestbookMessages as $msg)
            <div class="message-card">
                <span class="message-quote">"</span>
                <p class="message-text">{{ $msg->message }}</p>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span class="message-author">— {{ $msg->author }}</span>
                    <span class="message-date">{{ $msg->created_at->locale('fr')->diffForHumans() }}</span>
                </div>
            </div>
            @endforeach
        </div>
        @endif
        <div class="guestbook-form-wrap">
            <div class="card">
                <h3 style="font-family:'Cormorant Garamond',serif; font-size:1.4rem; font-weight:300; margin-bottom:1.5rem;">Laisser un message 💌</h3>
                <form action="{{ route('guestbook.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Votre prénom</label>
                        <input type="text" name="author" required placeholder="ex. Tante Sophie" minlength="2" maxlength="100">
                    </div>
                    <div class="form-group">
                        <label>Votre message</label>
                        <textarea name="message" required rows="4" placeholder="Un petit mot de bienvenue pour bébé..." minlength="3" maxlength="800" style="resize: vertical;"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:100%">Envoyer mon message 💝</button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
// === Countdown ===
@if($contentByKey->get('due_date'))
(function() {
    const target = new Date('{{ $contentByKey->get("due_date") }}T00:00:00');
    function update() {
        const diff = target - new Date();
        if (diff <= 0) { document.getElementById('countdown')?.remove(); return; }
        const d = Math.floor(diff / 86400000);
        const h = Math.floor(diff % 86400000 / 3600000);
        const m = Math.floor(diff % 3600000 / 60000);
        const s = Math.floor(diff % 60000 / 1000);
        document.getElementById('cd-d').textContent = String(d).padStart(2,'0');
        document.getElementById('cd-h').textContent = String(h).padStart(2,'0');
        document.getElementById('cd-m').textContent = String(m).padStart(2,'0');
        document.getElementById('cd-s').textContent = String(s).padStart(2,'0');
    }
    update(); setInterval(update, 1000);
})();
@endif

// === Gift modal ===
function openGiftModal(id, name) {
    document.getElementById('modalGiftName').textContent = name;
    document.getElementById('giftReserveForm').action = '/gifts/' + id + '/reserve';
    document.getElementById('giftModal').classList.add('open');
}
function closeGiftModal() { document.getElementById('giftModal').classList.remove('open'); }
document.getElementById('giftModal').addEventListener('click', function(e) {
    if (e.target === this) closeGiftModal();
});

// === Vote modal ===
function openVoteModal(id, name) {
    document.getElementById('modalVoteName').textContent = name;
    document.getElementById('voteForm').action = '/names/' + id + '/vote';
    document.getElementById('voteModal').classList.add('open');
}
function closeVoteModal() { document.getElementById('voteModal').classList.remove('open'); }
document.getElementById('voteModal').addEventListener('click', function(e) {
    if (e.target === this) closeVoteModal();
});

// === Donation amounts ===
function setAmount(val) {
    document.getElementById('donationAmount').value = val;
    document.querySelectorAll('.amount-btn').forEach(b => b.classList.remove('active'));
    event.currentTarget.classList.add('active');
}
</script>
@endpush
