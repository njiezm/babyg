<div id="page-names" class="app-page">
    <div class="container py-5">
        <div class="text-center mb-4">
            <button class="btn btn-sm btn-light rounded-pill px-4 mb-3 shadow-sm" onclick="showPage('home')">Retour</button>
            <h2 class="display-5 fw-bold">{{ $contentByKey['names_title'] ?? 'Votez pour le Prenom' }}</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-7">
                <form method="post" action="{{ route('names.suggest') }}" class="glass-panel p-4 mb-4 d-flex gap-2">@csrf<input type="text" class="form-control" name="name" placeholder="Votre suggestion..." required><button class="btn btn-primary rounded-pill">Ajouter</button></form>
                @foreach($nameOptions as $name)
                    <div class="glass-panel p-3 mb-3 d-flex align-items-center justify-content-between">
                        <div><div class="fw-bold fs-5">{{ $name->name }}</div><small class="text-muted">{{ $name->votes_count }} vote(s)</small></div>
                        <button class="btn btn-sm btn-light rounded-circle" onclick="voteName({{ $name->id }}, '{{ addslashes($name->name) }}')"><i class="fa-solid fa-heart text-danger"></i></button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
