<div id="page-story" class="app-page">
    <div class="container py-5">
        
        <!-- Header -->
        <div class="text-center mb-5">
            <button class="btn btn-sm btn-outline rounded-pill px-4 mb-3" onclick="showPage('home')">
                <i class="fa-solid fa-arrow-left me-1"></i> Retour
            </button>
            <h2 class="section-title">{{ $contentByKey['story_title'] ?? 'Notre Histoire d\'Amour' }}</h2>
            <p class="text-muted">Les moments forts qui nous ont réunis</p>
        </div>

        <!-- Timeline Container -->
        <div class="position-relative">
            <!-- Ligne verticale centrale -->
            <div class="timeline-line"></div>

            @foreach($timelineEvents as $event)
                <div class="row mb-5 align-items-center timeline-item">
                    
                    <!-- Contenu (Carte) -->
                    <div class="col-md-6 {{ $loop->odd ? '' : 'order-md-2' }} {{ $loop->odd ? 'text-start' : 'text-end' }}">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden" style="background: #fff;">
                            <div class="row g-0">
                                @if($loop->odd)
                                    <!-- Cas impair : Image à gauche -->
                                    <div class="col-md-5">
                                        <img src="{{ $event->image_url }}" class="img-fluid w-100 h-100 object-fit-cover" style="min-height: 200px;" alt="{{ $event->title }}">
                                    </div>
                                    <div class="col-md-7 p-4 d-flex flex-column justify-content-center">
                                        <span class="pill pill-sage mb-2 align-self-start">{{ $event->date ?? 'Date' }}</span>
                                        <h4 class="h5 mb-2" style="font-family: 'Cormorant Garamond'; color: var(--text-primary);">{{ $event->title }}</h4>
                                        <h6 class="text-muted small mb-3 fst-italic">{{ $event->subtitle }}</h6>
                                        <p class="mb-0 small text-muted">{{ $event->description }}</p>
                                    </div>
                                @else
                                    <!-- Cas pair : Image à droite -->
                                    <div class="col-md-7 p-4 d-flex flex-column justify-content-center">
                                        <span class="pill pill-gold mb-2 align-self-start">{{ $event->date ?? 'Date' }}</span>
                                        <h4 class="h5 mb-2" style="font-family: 'Cormorant Garamond'; color: var(--text-primary);">{{ $event->title }}</h4>
                                        <h6 class="text-muted small mb-3 fst-italic">{{ $event->subtitle }}</h6>
                                        <p class="mb-0 small text-muted">{{ $event->description }}</p>
                                    </div>
                                    <div class="col-md-5">
                                        <img src="{{ $event->image_url }}" class="img-fluid w-100 h-100 object-fit-cover" style="min-height: 200px;" alt="{{ $event->title }}">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Point central de la timeline -->
                    <div class="col-md-6 {{ $loop->even ? 'order-md-1' : '' }}">
                        <div class="timeline-dot"></div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
</div>

@push('styles')
<style>
    /* --- CSS SPÉCIFIQUE POUR LA TIMELINE --- */
    .timeline-line {
        position: absolute;
        left: 50%;
        top: 0;
        bottom: 0;
        width: 2px;
        background-color: var(--sage);
        transform: translateX(-50%);
        z-index: 0;
    }

    .timeline-dot {
        width: 20px;
        height: 20px;
        background-color: #fff;
        border: 4px solid var(--blush-deep);
        border-radius: 50%;
        position: relative;
        z-index: 1;
        margin: 0 auto; /* Centrage horizontal */
    }

    /* Ajustement Mobile : Déplacer la ligne à gauche */
    @media (max-width: 768px) {
        .timeline-line {
            left: 20px;
        }
        
        .timeline-dot {
            position: absolute;
            left: 20px;
            transform: translateX(-50%);
            margin: 0;
        }

        .timeline-item {
            padding-left: 50px !important; /* Espace pour le point */
        }
        
        /* Forcer les cartes à prendre toute la largeur sur mobile */
        .timeline-item > div:first-child {
            width: 100% !important;
            max-width: 100%;
            text-align: left !important;
        }
        
        /* Sur mobile, on cache la colonne vide qui contenait le point sur desktop */
        .timeline-item > div:last-child {
            display: none;
        }

        /* Sur mobile, réorganiser l'image : toujours en haut ou en bas ? */
        /* Ici on garde la structure bootstrap standard (image/texte côte à côte si l'écran le permet, sinon empilé) */
    }
</style>
@endpush