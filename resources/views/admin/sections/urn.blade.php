<section id="cms-urn" class="section-anchor mb-4">
    <div class="card section-card"><div class="card-header bg-white fw-bold">CMS - Page Urne</div><div class="card-body">
        @foreach(($contentGroups['urn'] ?? collect()) as $block)
            <form method="post" action="{{ route('admin.contents.update', $block) }}" class="row g-2 border rounded p-2 mb-2">
                @csrf @method('PUT')
                <input type="hidden" name="group_name" value="{{ $block->group_name }}">
                <div class="col-md-3"><input class="form-control" name="label" value="{{ $block->label }}"></div>
                <div class="col-md-1"><input class="form-control" type="number" name="sort_order" value="{{ $block->sort_order }}"></div>
                <div class="col-md-7"><input class="form-control" name="value" value="{{ $block->value }}"></div>
                <div class="col-md-1"><button class="btn btn-primary w-100">OK</button></div>
            </form>
        @endforeach

        <h6 class="mt-4">Dons recus</h6>
        <div class="table-responsive"><table class="table table-sm table-striped bg-white"><thead><tr><th>Date</th><th>Nom</th><th>Montant</th><th>Paiement</th><th>Note</th></tr></thead><tbody>
            @foreach($donations as $donation)
                <tr><td>{{ $donation->created_at }}</td><td>{{ $donation->donor_name }}</td><td>{{ number_format((float)$donation->amount, 2, ',', ' ') }} EUR</td><td>{{ $donation->payment_method }}</td><td>{{ $donation->note }}</td></tr>
            @endforeach
        </tbody></table></div>
    </div></div>
</section>
