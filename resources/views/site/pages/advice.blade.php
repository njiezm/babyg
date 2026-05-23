<div id="page-advice" class="app-page">
    <div class="container py-5">
        <div class="text-center mb-4">
            <button class="btn btn-sm btn-light rounded-pill px-4 mb-3 shadow-sm" onclick="showPage('home')">Retour</button>
            <h2 class="display-5 fw-bold">{{ $contentByKey['guestbook_title'] ?? "Livre d'Or" }}</h2>
            <p>{{ $contentByKey['guestbook_subtitle'] ?? '' }}</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="post" action="{{ route('guestbook.store') }}" class="glass-panel p-4 mb-5">@csrf
                    <input type="text" name="author" class="form-control mb-2" placeholder="Votre nom" required>
                    <textarea name="message" class="form-control mb-2" rows="3" placeholder="Ecrivez votre message" required></textarea>
                    <div class="text-end"><button class="btn btn-magical btn-sm">Publier</button></div>
                </form>
                @foreach($guestbookMessages as $m)
                    <div class="glass-panel p-4 mb-3">
                        <div class="d-flex justify-content-between mb-2"><span class="fw-bold text-primary">{{ $m->author }}</span><small class="text-muted">{{ $m->created_at->diffForHumans() }}</small></div>
                        <p class="mb-0">{{ $m->message }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
