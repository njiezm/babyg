<div id="page-list" class="app-page">
    <div class="container py-5">
        <div class="text-center mb-5">
            <button class="btn btn-sm btn-light rounded-pill px-4 mb-3 shadow-sm" onclick="showPage('home')">Retour</button>
            <h2 class="display-5 fw-bold">{{ $contentByKey['list_title'] ?? 'Liste de Naissance' }}</h2>
        </div>
        <div class="row g-4">
            @foreach($giftItems as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 glass-panel border-0">
                        <div class="product-img-wrapper">
                            <img src="{{ $item->image_url }}" alt="{{ $item->name }}">
                            @if($item->is_reserved)
                                <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-50 d-flex align-items-center justify-content-center text-white fw-bold">Reserve</div>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between"><span class="badge bg-light text-secondary border">{{ $item->category }}</span><strong>{{ number_format((float) $item->price, 0, ',', ' ') }} EUR</strong></div>
                            <h5 class="fw-bold mt-2">{{ $item->name }}</h5>
                            @if($item->is_reserved)
                                <div class="alert alert-success py-2 small mb-0">Par {{ $item->reserved_by }}</div>
                            @else
                                <button class="btn btn-outline-primary w-100 rounded-pill" onclick="reserveGift({{ $item->id }})">Offrir ce cadeau</button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
