<div id="page-home" class="app-page active">

    <!-- HERO SECTION -->
    <div class="container pt-5 pb-4 text-center">
        <div class="mb-5">
            <span class="pill pill-blush mb-4 d-inline-block px-4 py-2">
                <i class="fa-solid fa-heart-pulse me-1"></i> {{ $contentByKey['hero_badge'] ?? 'Juin 2026' }}
            </span>
            <h1 class="section-title mb-4" style="font-size: 3rem;">
                {{ $contentByKey['hero_title'] ?? 'Le Petit Prince arrive bientôt' }}
            </h1>
            <p class="lead text-muted mb-5" style="max-width: 700px; margin-left: auto; margin-right: auto;">
                {{ $contentByKey['hero_subtitle'] ?? 'Nous sommes heureux de vous compter parmi nous pour cet événement unique.' }}
            </p>

            <!-- Compte à rebours -->
            <div id="countdown" class="d-flex justify-content-center flex-wrap gap-3 mb-5"></div>

            <!-- Boutons -->
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-blush px-5" onclick="showPage('urn')">Participer à l'Urne</button>
                <button class="btn btn-outline px-5" onclick="showPage('story')">Notre Histoire</button>
            </div>
        </div>

        <!-- STATISTIQUES : Design épuré, pas de fond lourd -->
        <div class="row g-4 mb-5 text-center">
            <div class="col-md-4">
                <div class="p-4 border-0 shadow-sm rounded-3" style="background: white;">
                    <div class="small text-muted text-uppercase tracking-wider mb-2">Total Dons</div>
                    <div class="h2 mb-0" style="font-family: 'Cormorant Garamond'; color: var(--text-primary);">
                        {{ number_format((float)$donationTotal, 0, ',', ' ') }} <span style="font-size: 1rem; color: var(--blush-deep);">€</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 border-0 shadow-sm rounded-3" style="background: white;">
                    <div class="small text-muted text-uppercase tracking-wider mb-2">Cadeaux Réservés</div>
                    <div class="h2 mb-0" style="font-family: 'Cormorant Garamond'; color: var(--text-primary);">
                        {{ $reservedGiftsCount }}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 border-0 shadow-sm rounded-3" style="background: white;">
                    <div class="small text-muted text-uppercase tracking-wider mb-2">Messages Doux</div>
                    <div class="h2 mb-0" style="font-family: 'Cormorant Garamond'; color: var(--text-primary);">
                        {{ $latestMessages->count() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- CONTENU PRINCIPAL -->
        <div class="row g-5 mb-5 align-items-stretch">
            <!-- GAUCHE : Événement -->
            <div class="col-lg-7">
                <div class="card h-100 border-0 shadow-sm overflow-hidden rounded-4">
                    <div class="row g-0 h-100">
                        @if($timelineHighlight)
                            <div class="col-md-6">
                                <img src="{{ $timelineHighlight->image_url }}" class="img-fluid w-100 h-100 object-fit-cover" style="min-height: 300px;" alt="{{ $timelineHighlight->title }}">
                            </div>
                        @endif
                        <div class="col-md-6 p-4 d-flex flex-column justify-content-center">
                            <span class="pill pill-sage mb-3 align-self-start" style="font-size: 0.7rem;">Prochain moment</span>
                            <h3 class="h4 mb-2" style="font-family: 'Cormorant Garamond'; color: var(--text-primary);">{{ $timelineHighlight->title ?? 'Événement' }}</h3>
                            <div class="text-muted small mb-3 fst-italic">{{ $timelineHighlight->subtitle ?? '' }}</div>
                            <p class="mb-4 text-muted">{{ $timelineHighlight->description ?? '' }}</p>
                            <div class="mt-auto">
                                <button class="btn btn-sm btn-outline px-4" onclick="showPage('story')">Voir la timeline</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DROITE : Messages -->
            <div class="col-lg-5">
                <div class="card h-100 border-0 shadow-sm rounded-4">
                    <div class="card-body p-4 d-flex flex-column">
                        <h3 class="h5 mb-4 text-center" style="font-family: 'Cormorant Garamond'; color: var(--text-primary);">Derniers Mots</h3>

                        <div class="flex-grow-1 overflow-auto" style="max-height: 320px;">
                            @forelse($latestMessages as $msg)
                                <div class="mb-3 pb-3" style="border-bottom: 1px dashed var(--border);">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="fw-bold text-primary" style="font-size: 0.9rem;">{{ $msg->author }}</span>
                                        <div style="width: 8px; height: 8px; background: var(--blush); border-radius: 50%;"></div>
                                    </div>
                                    <div class="text-muted small fst-italic">
                                        {{ $msg->message }}
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-5 text-muted small">
                                    Pas encore de message.
                                </div>
                            @endforelse
                        </div>

                        <div class="mt-3 pt-3 text-center border-top" style="border-color: var(--border) !important;">
                            <button class="btn btn-blush w-100 btn-sm" onclick="showPage('advice')">Laisser un message</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CADEAUX POPULAIRES -->
        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-end mb-4">
                <div>
                    <h2 class="h3 mb-0" style="font-family: 'Cormorant Garamond'; color: var(--text-primary);">Idées <em>Cadeaux</em></h2>
                </div>
                <button class="btn btn-sm btn-outline" onclick="showPage('list')">Tout voir &rarr;</button>
            </div>

            <div class="row g-4">
                @foreach($featuredGifts as $gift)
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden" style="transition: transform 0.3s ease;">
                            <div style="height: 220px; overflow: hidden; background: #f8f8f8;">
                                <img src="{{ $gift->image_url }}" class="img-fluid w-100 h-100 object-fit-cover" alt="{{ $gift->name }}">
                            </div>
                            <div class="p-3">
                                <div class="small text-muted text-uppercase mb-1" style="font-size: 0.7rem;">{{ $gift->category }}</div>
                                <h5 class="card-title h6 mb-2 fw-bold text-truncate">{{ $gift->name }}</h5>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="fw-bold" style="color: var(--text-primary); font-family: 'Cormorant Garamond'; font-size: 1.2rem;">
                                        {{ number_format((float)$gift->price, 0, ',', ' ') }} €
                                    </span>
                                    <button class="btn btn-blush btn-sm rounded-pill px-3">Voir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@push('scripts')
<style>
    /* Ajustements visuels spécifiques */
    .card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.05) !important; }
    .card { transition: all 0.3s ease; }
    .tracking-wider { letter-spacing: 0.05em; }
</style>

<script>
    const targetDate = new Date("{{ $contentByKey['countdown_target'] ?? '2026-06-15 00:00:00' }}").getTime();
    const container = document.getElementById('countdown');

    setInterval(() => {
        const now = new Date().getTime();
        const distance = targetDate - now;

        if (distance < 0) {
            container.innerHTML = '<span class="h5 fw-bold" style="color:var(--blush-deep)">C\'est le grand jour !</span>';
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        const createBox = (val, label) => `
            <div class="d-flex flex-column align-items-center justify-content-center border rounded-3 shadow-sm" style="min-width: 90px; padding: 15px 10px; background: #fff; border-color: var(--border) !important;">
                <div style="font-size: 1.8rem; font-family: 'Cormorant Garamond'; color: var(--text-primary); line-height: 1; font-weight: 600;">${val}</div>
                <div class="text-muted" style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px; margin-top: 5px; color: var(--sage-deep) !important;">${label}</div>
            </div>
        `;

        container.innerHTML = createBox(days, 'Jours') + createBox(hours, 'Heures') + createBox(minutes, 'Min') + createBox(seconds, 'Sec');
    }, 1000);
</script>
@endpush
