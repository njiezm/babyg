<section id="cms-global" class="section-anchor mb-4">
    <div class="card section-card"><div class="card-header bg-white fw-bold">CMS - Parametres globaux</div><div class="card-body">
        @foreach(($contentGroups['general'] ?? collect()) as $block)
            <form method="post" action="{{ route('admin.contents.update', $block) }}" class="row g-2 border rounded p-2 mb-2">
                @csrf @method('PUT')
                <input type="hidden" name="group_name" value="{{ $block->group_name }}">
                <div class="col-md-3"><input class="form-control" name="label" value="{{ $block->label }}"></div>
                <div class="col-md-1"><input class="form-control" type="number" name="sort_order" value="{{ $block->sort_order }}"></div>
                <div class="col-md-7"><input class="form-control" name="value" value="{{ $block->value }}"></div>
                <div class="col-md-1"><button class="btn btn-primary w-100">OK</button></div>
            </form>
        @endforeach
    </div></div>
</section>
