<section id="cms-guestbook" class="section-anchor mb-4">
    <div class="card section-card"><div class="card-header bg-white fw-bold">CMS - Livre d'Or</div><div class="card-body">
        @foreach(($contentGroups['guestbook'] ?? collect()) as $block)
            <form method="post" action="{{ route('admin.contents.update', $block) }}" class="row g-2 border rounded p-2 mb-2">
                @csrf @method('PUT')
                <input type="hidden" name="group_name" value="{{ $block->group_name }}">
                <div class="col-md-3"><input class="form-control" name="label" value="{{ $block->label }}"></div>
                <div class="col-md-1"><input class="form-control" type="number" name="sort_order" value="{{ $block->sort_order }}"></div>
                <div class="col-md-7"><input class="form-control" name="value" value="{{ $block->value }}"></div>
                <div class="col-md-1"><button class="btn btn-primary w-100">OK</button></div>
            </form>
        @endforeach

        @foreach($messages as $message)
            <div class="border rounded bg-white p-2 mb-2">
                <div class="d-flex justify-content-between"><strong>{{ $message->author }}</strong><small>{{ $message->created_at }}</small></div>
                <div class="small mb-2">{{ $message->message }}</div>
                <div class="d-flex gap-2">
                    <form method="post" action="{{ route('admin.messages.toggle', $message) }}">@csrf @method('PATCH')<button class="btn btn-sm {{ $message->is_approved ? 'btn-warning' : 'btn-success' }}">{{ $message->is_approved ? 'Masquer' : 'Approuver' }}</button></form>
                    <form method="post" action="{{ route('admin.messages.delete', $message) }}">@csrf @method('DELETE')<button class="btn btn-outline-danger btn-sm">Supprimer</button></form>
                </div>
            </div>
        @endforeach
    </div></div>
</section>
