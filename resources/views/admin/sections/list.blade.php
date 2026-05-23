<section id="cms-list" class="section-anchor mb-4">
    <div class="card section-card"><div class="card-header bg-white fw-bold">CMS - Liste de Naissance (Upload photo)</div><div class="card-body">
        @foreach(($contentGroups['list'] ?? collect()) as $block)
            <form method="post" action="{{ route('admin.contents.update', $block) }}" class="row g-2 border rounded p-2 mb-2">
                @csrf @method('PUT')
                <input type="hidden" name="group_name" value="{{ $block->group_name }}">
                <div class="col-md-3"><input class="form-control" name="label" value="{{ $block->label }}"></div>
                <div class="col-md-1"><input class="form-control" type="number" name="sort_order" value="{{ $block->sort_order }}"></div>
                <div class="col-md-7"><input class="form-control" name="value" value="{{ $block->value }}"></div>
                <div class="col-md-1"><button class="btn btn-primary w-100">OK</button></div>
            </form>
        @endforeach

        @foreach($giftItems as $gift)
            <form method="post" action="{{ route('admin.gifts.update', $gift) }}" enctype="multipart/form-data" class="row g-2 border rounded p-2 mb-2 bg-light">
                @csrf @method('PUT')
                <div class="col-md-2"><input class="form-control" name="name" value="{{ $gift->name }}"></div>
                <div class="col-md-1"><input class="form-control" name="category" value="{{ $gift->category }}"></div>
                <div class="col-md-1"><input class="form-control" type="number" step="0.01" name="price" value="{{ $gift->price }}"></div>
                <div class="col-md-2"><input class="form-control" name="image_url" value="{{ $gift->image_url }}" placeholder="URL image"></div>
                <div class="col-md-2"><input type="file" class="form-control" name="image_file" accept="image/*"></div>
                <div class="col-md-1"><input class="form-control" type="number" name="sort_order" value="{{ $gift->sort_order }}"></div>
                <div class="col-md-2 d-flex align-items-center gap-2"><input type="checkbox" class="form-check-input" name="is_reserved" value="1" {{ $gift->is_reserved ? 'checked' : '' }}><input class="form-control form-control-sm" name="reserved_by" value="{{ $gift->reserved_by }}" placeholder="Reserve par"></div>
                <div class="col-md-1 d-grid"><button class="btn btn-primary btn-sm">OK</button></div>
                <div class="col-md-2 form-check d-flex align-items-center gap-2"><input class="form-check-input" type="checkbox" name="remove_image" value="1"><label class="form-check-label">Suppr image</label></div>
                <div class="col-md-2">@if($gift->image_url)<img src="{{ $gift->image_url }}" alt="img" class="img-fluid rounded" style="max-height:70px;">@endif</div>
            </form>
            <form method="post" action="{{ route('admin.gifts.delete', $gift) }}" class="mb-2">@csrf @method('DELETE')<button class="btn btn-outline-danger btn-sm">Supprimer {{ $gift->name }}</button></form>
        @endforeach

        <hr>
        <form method="post" action="{{ route('admin.gifts.store') }}" enctype="multipart/form-data" class="row g-2">
            @csrf
            <div class="col-md-3"><input class="form-control" name="name" placeholder="Nom" required></div>
            <div class="col-md-2"><input class="form-control" name="category" placeholder="Categorie"></div>
            <div class="col-md-1"><input class="form-control" type="number" step="0.01" name="price" placeholder="Prix" required></div>
            <div class="col-md-2"><input class="form-control" name="image_url" placeholder="URL image"></div>
            <div class="col-md-2"><input type="file" class="form-control" name="image_file" accept="image/*"></div>
            <div class="col-md-1"><input class="form-control" type="number" name="sort_order" value="99"></div>
            <div class="col-md-1"><button class="btn btn-success w-100">+</button></div>
        </form>
    </div></div>
</section>
