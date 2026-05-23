<div id="page-urn" class="app-page">
    <div class="container py-5 text-center">
        <button class="btn btn-sm btn-light rounded-pill px-4 mb-3 shadow-sm" onclick="showPage('home')">Retour</button>
        <h2 class="display-5 fw-bold">{{ $contentByKey['urn_title'] ?? "L'Urne Digitale" }}</h2>
        <p class="text-muted">{{ $contentByKey['urn_subtitle'] ?? '' }}</p>
        <div class="row justify-content-center mt-4"><div class="col-md-8"><div class="glass-panel p-5">
            <h3>{{ number_format((float) $donationTotal, 0, ',', ' ') }} EUR</h3>
            @php $goal = (float)($contentByKey['urn_goal'] ?? 2000); $pct = $goal > 0 ? min(($donationTotal / $goal) * 100, 100) : 0; @endphp
            <p class="text-muted">recoltes sur {{ number_format($goal, 0, ',', ' ') }} EUR</p>
            <div class="progress mb-4" style="height:22px;"><div class="progress-bar" style="width:{{ $pct }}%;background:linear-gradient(90deg,#FFD54F,#FF7043);"></div></div>
            <button class="btn btn-magical" data-bs-toggle="collapse" data-bs-target="#donationForm">Faire un don</button>
            <div class="collapse mt-4" id="donationForm">
                <form method="post" action="{{ route('donations.store') }}" class="row g-2">@csrf
                    <div class="col-md-4"><input name="donor_name" class="form-control" placeholder="Votre nom (optionnel)"></div>
                    <div class="col-md-3"><input name="amount" type="number" min="1" class="form-control" placeholder="Montant" required></div>
                    <div class="col-md-3"><select class="form-select" name="payment_method"><option value="paypal">PayPal</option><option value="virement">Virement</option><option value="cash">Cash</option></select></div>
                    <div class="col-md-2"><button class="btn btn-primary w-100">Valider</button></div>
                </form>
                <div class="mt-3 small">IBAN: <strong>{{ $contentByKey['iban_text'] ?? '' }}</strong></div>
            </div>
        </div></div></div>
    </div>
</div>
