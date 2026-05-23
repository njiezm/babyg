<section id="cms-story" class="section-anchor mb-4">
    <div class="card section-card"><div class="card-header bg-white fw-bold">CMS - Page Notre Histoire (Timeline + Upload photo)</div><div class="card-body">
        @foreach(($contentGroups['story'] ?? collect()) as $block)
            <form method="post" action="{{ route('admin.contents.update', $block) }}" class="row g-2 border rounded p-2 mb-2">
                @csrf @method('PUT')
                <input type="hidden" name="group_name" value="{{ $block->group_name }}">
                <div class="col-md-3"><input class="form-control" name="label" value="{{ $block->label }}"></div>
                <div class="col-md-1"><input class="form-control" type="number" name="sort_order" value="{{ $block->sort_order }}"></div>
                <div class="col-md-7"><input class="form-control" name="value" value="{{ $block->value }}"></div>
                <div class="col-md-1"><button class="btn btn-primary w-100">OK</button></div>
            </form>
        @endforeach

        @foreach($timelineEvents as $event)
            <form method="post" action="{{ route('admin.timeline.update', $event) }}" enctype="multipart/form-data" class="row g-2 border rounded p-2 mb-2 bg-light">
                @csrf @method('PUT')
                <div class="col-md-2"><input class="form-control" name="title" value="{{ $event->title }}" required></div>
                <div class="col-md-2"><input class="form-control" name="subtitle" value="{{ $event->subtitle }}"></div>
                <div class="col-md-3"><input class="form-control" name="description" value="{{ $event->description }}"></div>
                <div class="col-md-2"><input class="form-control" name="image_url" value="{{ $event->image_url }}" placeholder="URL image"></div>
                <div class="col-md-2"><input type="file" class="form-control" name="image_file" accept="image/*"></div>
                <div class="col-md-1 d-grid"><button class="btn btn-primary btn-sm">OK</button></div>
                <div class="col-md-2"><input class="form-control" type="date" name="event_date" value="{{ optional($event->event_date)->format('Y-m-d') }}"></div>
                <div class="col-md-1"><input class="form-control" type="number" name="sort_order" value="{{ $event->sort_order }}"></div>
                <div class="col-md-2 form-check d-flex align-items-center gap-2"><input class="form-check-input" type="checkbox" name="remove_image" value="1"><label class="form-check-label">Suppr image</label></div>
                <div class="col-md-3">@if($event->image_url)<img src="{{ $event->image_url }}" alt="img" class="img-fluid rounded" style="max-height:70px;">@endif</div>
            </form>
            <form method="post" action="{{ route('admin.timeline.delete', $event) }}" class="mb-2">@csrf @method('DELETE')<button class="btn btn-outline-danger btn-sm">Supprimer {{ $event->title }}</button></form>
        @endforeach

        <hr>
        <form method="post" action="{{ route('admin.timeline.store') }}" enctype="multipart/form-data" class="row g-2">
            @csrf
            <div class="col-md-2"><input class="form-control" name="title" placeholder="Titre" required></div>
            <div class="col-md-2"><input class="form-control" name="subtitle" placeholder="Sous-titre"></div>
            <div class="col-md-2"><input class="form-control" name="description" placeholder="Description"></div>
            <div class="col-md-2"><input class="form-control" name="image_url" placeholder="URL image"></div>
            <div class="col-md-2"><input type="file" class="form-control" name="image_file" accept="image/*"></div>
            <div class="col-md-1"><input class="form-control" type="number" name="sort_order" value="99"></div>
            <div class="col-md-1"><button class="btn btn-success w-100">+</button></div>
        </form>
    </div></div>
</section>
