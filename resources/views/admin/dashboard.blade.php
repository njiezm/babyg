@extends('layouts.admin')

@section('title', 'Tableau de bord')

@push('styles')
<style>
.section-anchor { scroll-margin-top: 80px; }
.tabs { display: flex; gap: 0.5rem; flex-wrap: wrap; margin-bottom: 2rem; }
.tab-btn {
    padding: 0.5rem 1.1rem;
    border-radius: 50px;
    border: 1.5px solid var(--border);
    background: transparent;
    color: var(--text-muted);
    font-size: 0.8rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.15s;
    font-family: 'DM Sans', sans-serif;
    text-decoration: none;
}
.tab-btn:hover, .tab-btn.active { background: var(--text-primary); color: white; border-color: var(--text-primary); }
.section-sep { height: 1px; background: var(--border); margin: 2.5rem 0; }
.img-preview-wrap { display: flex; align-items: center; gap: 0.75rem; flex-wrap: wrap; }
.img-preview { width: 60px; height: 60px; object-fit: cover; border-radius: 8px; border: 1px solid var(--border); }
.content-group { margin-bottom: 2rem; }
.content-group-title {
    font-size: 0.72rem;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--text-muted);
    font-weight: 500;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.content-group-title::after { content: ''; flex: 1; height: 1px; background: var(--border); }
.tl-thumb { width: 48px; height: 36px; object-fit: cover; border-radius: 6px; }
.name-rank {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 28px; height: 28px;
    border-radius: 50%;
    background: var(--blush);
    font-size: 0.78rem;
    font-weight: 500;
    color: var(--text-primary);
    flex-shrink: 0;
}
.message-preview { max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-style: italic; color: var(--text-muted); }
.inline-edit-form { display: flex; gap: 0.5rem; align-items: center; flex-wrap: wrap; }
.inline-edit-form input, .inline-edit-form select { width: auto; flex: 1; min-width: 120px; }
/* Toggle switch */
.toggle { position: relative; display: inline-block; width: 36px; height: 20px; }
.toggle input { opacity: 0; width: 0; height: 0; }
.toggle-slider {
    position: absolute; inset: 0;
    background: #ccc;
    border-radius: 20px;
    cursor: pointer;
    transition: 0.2s;
}
.toggle-slider::before {
    content: '';
    position: absolute;
    width: 14px; height: 14px;
    left: 3px; bottom: 3px;
    background: white;
    border-radius: 50%;
    transition: 0.2s;
}
.toggle input:checked + .toggle-slider { background: #7A9B6E; }
.toggle input:checked + .toggle-slider::before { transform: translateX(16px); }
.donation-row td:first-child { font-family: 'Cormorant Garamond', serif; font-size: 1.1rem; }
</style>
@endpush

@section('content')

{{-- Stats --}}
<div class="stat-cards">
    <div class="stat-card">
        <div class="stat-card-icon">🎁</div>
        <div class="stat-card-value">{{ $giftItems->count() }}</div>
        <div class="stat-card-label">Cadeaux au total</div>
        <div class="stat-card-sub">{{ $giftItems->where('is_reserved', true)->count() }} réservés</div>
    </div>
    <div class="stat-card">
        <div class="stat-card-icon">💌</div>
        <div class="stat-card-value">{{ $guestbookMessages->count() }}</div>
        <div class="stat-card-label">Messages</div>
        <div class="stat-card-sub">{{ $guestbookMessages->where('is_approved', false)->count() }} en attente</div>
    </div>
    <div class="stat-card">
        <div class="stat-card-icon">💝</div>
        <div class="stat-card-value">{{ number_format($donations->where('confirmed', true)->sum('amount'), 0, ',', ' ') }} €</div>
        <div class="stat-card-label">Dons collectés</div>
        <div class="stat-card-sub">{{ $donations->count() }} don{{ $donations->count() > 1 ? 's' : '' }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-card-icon">✨</div>
        <div class="stat-card-value">{{ $nameOptions->count() }}</div>
        <div class="stat-card-label">Prénoms proposés</div>
        <div class="stat-card-sub">{{ $nameOptions->sum('votes_count') }} votes</div>
    </div>
    <div class="stat-card">
        <div class="stat-card-icon">🕐</div>
        <div class="stat-card-value">{{ $timelineEvents->count() }}</div>
        <div class="stat-card-label">Évènements timeline</div>
    </div>
</div>

<div class="tabs">
    <a href="#content" class="tab-btn">✏️ Contenu</a>
    <a href="#timeline" class="tab-btn">🕐 Timeline</a>
    <a href="#gifts" class="tab-btn">🎁 Cadeaux</a>
    <a href="#names" class="tab-btn">✨ Prénoms</a>
    <a href="#messages" class="tab-btn">💌 Messages</a>
    <a href="#donations" class="tab-btn">💝 Dons</a>
</div>

{{-- ===== CONTENT BLOCKS ===== --}}
<div id="content" class="section-anchor">
    <div class="admin-card">
        <div class="admin-card-header">
            <h3>✏️ Textes & paramètres du site</h3>
        </div>
        <div class="admin-card-body">
            @php $groups = $contentBlocks->groupBy('group_name'); @endphp
            @foreach($groups as $group => $blocks)
            <div class="content-group">
                <div class="content-group-title">{{ ucfirst($group) }}</div>
                @foreach($blocks as $block)
                <form action="{{ route('admin.contents.update', $block) }}" method="POST" enctype="multipart/form-data" style="margin-bottom: 1rem;">
                    @csrf
                    @method('PUT')
                    <label>{{ $block->label }}</label>
                    <div style="display: flex; gap: 0.75rem; align-items: flex-start;">
                        <div style="flex: 1;">
                            @if(str_contains($block->key, 'image') || str_contains($block->key, 'photo'))
                                @if($block->value)
                                    <div class="img-preview-wrap" style="margin-bottom: 0.5rem;">
                                        <img src="{{ $block->value }}" class="img-preview" alt="Aperçu">
                                        <span style="font-size: 0.78rem; color: var(--text-muted);">Image actuelle</span>
                                    </div>
                                @endif
                                <div style="margin-bottom: 0.5rem;">
                                    <label style="margin-bottom: 0.25rem; font-size: 0.72rem;">Uploader une nouvelle image</label>
                                    <input type="file" name="image_upload" accept="image/*" style="font-size: 0.8rem;">
                                </div>
                                <div>
                                    <label style="margin-bottom: 0.25rem; font-size: 0.72rem;">Ou URL directe (optionnel)</label>
                                    <input type="url" name="value" value="{{ $block->value }}" placeholder="https://...">
                                </div>
                            @elseif(str_contains($block->key, 'text') || str_contains($block->key, 'intro') || str_contains($block->key, 'description'))
                                <textarea name="value" rows="3" style="resize: vertical;">{{ $block->value }}</textarea>
                            @elseif(str_contains($block->key, 'date'))
                                <input type="date" name="value" value="{{ $block->value }}">
                            @elseif(str_contains($block->key, 'url') || str_contains($block->key, 'link'))
                                <input type="url" name="value" value="{{ $block->value }}" placeholder="https://...">
                            @else
                                <input type="text" name="value" value="{{ $block->value }}">
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm" style="margin-top: 0.25rem; white-space: nowrap;">Sauver</button>
                    </div>
                </form>
                @endforeach
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="section-sep"></div>

{{-- ===== TIMELINE ===== --}}
<div id="timeline" class="section-anchor">
    <div class="admin-card">
        <div class="admin-card-header">
            <h3>🕐 Timeline — Notre histoire</h3>
            <button class="btn btn-blush btn-sm" onclick="toggleForm('timelineAddForm')">+ Ajouter</button>
        </div>

        {{-- Add form --}}
        <div id="timelineAddForm" style="display:none; padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--border); background: var(--cream);">
            <form action="{{ route('admin.timeline.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label>Titre *</label>
                        <input type="text" name="title" required placeholder="ex. Notre première rencontre">
                    </div>
                    <div class="form-group">
                        <label>Sous-titre</label>
                        <input type="text" name="subtitle" placeholder="ex. Une nuit magique">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Date de l'événement</label>
                        <input type="date" name="event_date">
                    </div>
                    <div class="form-group">
                        <label>Ordre d'affichage</label>
                        <input type="number" name="sort_order" value="0" min="0">
                    </div>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" rows="3" placeholder="Racontez ce moment..."></textarea>
                </div>
                <div class="form-group">
                    <label>Photo (upload)</label>
                    <input type="file" name="image_upload" accept="image/*">
                </div>
                <div class="form-group">
                    <label>Ou URL de l'image (optionnel)</label>
                    <input type="url" name="image_url" placeholder="https://...">
                </div>
                <div style="display:flex; gap: 0.75rem;">
                    <button type="submit" class="btn btn-primary">Ajouter l'événement</button>
                    <button type="button" class="btn btn-ghost" onclick="toggleForm('timelineAddForm')">Annuler</button>
                </div>
            </form>
        </div>

        <div class="admin-card-body" style="padding: 0;">
            <table>
                <thead>
                    <tr>
                        <th style="width:60px">#</th>
                        <th>Événement</th>
                        <th>Date</th>
                        <th>Image</th>
                        <th style="width: 120px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($timelineEvents as $event)
                    <tr>
                        <td>
                            <span style="font-size: 0.75rem; color: var(--text-muted);">{{ $event->sort_order }}</span>
                        </td>
                        <td>
                            <strong style="font-size: 0.9rem;">{{ $event->title }}</strong>
                            @if($event->subtitle)<br><span style="font-size: 0.78rem; color: var(--text-muted);">{{ $event->subtitle }}</span>@endif
                        </td>
                        <td>
                            @if($event->event_date)
                                <span style="font-size: 0.82rem;">{{ \Carbon\Carbon::parse($event->event_date)->locale('fr')->isoFormat('MMM YYYY') }}</span>
                            @else
                                <span style="color: var(--text-light);">—</span>
                            @endif
                        </td>
                        <td>
                            @if($event->image_url)
                                <img src="{{ $event->image_url }}" class="tl-thumb" alt="">
                            @else
                                <span style="font-size: 0.75rem; color: var(--text-light);">Aucune</span>
                            @endif
                        </td>
                        <td>
                            <div style="display: flex; gap: 0.35rem;">
                                <button class="btn btn-ghost btn-sm" onclick="toggleEditRow('tledit-{{ $event->id }}')">✏️</button>
                                <form action="{{ route('admin.timeline.delete', $event) }}" method="POST" onsubmit="return confirm('Supprimer cet événement ?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">✕</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <tr id="tledit-{{ $event->id }}" style="display: none; background: var(--cream);">
                        <td colspan="5" style="padding: 1.25rem 1.5rem;">
                            <form action="{{ route('admin.timeline.update', $event) }}" method="POST" enctype="multipart/form-data">
                                @csrf @method('PUT')
                                <div class="form-row">
                                    <div class="form-group"><label>Titre</label><input type="text" name="title" value="{{ $event->title }}" required></div>
                                    <div class="form-group"><label>Sous-titre</label><input type="text" name="subtitle" value="{{ $event->subtitle }}"></div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group"><label>Date</label><input type="date" name="event_date" value="{{ $event->event_date }}"></div>
                                    <div class="form-group"><label>Ordre</label><input type="number" name="sort_order" value="{{ $event->sort_order }}" min="0"></div>
                                </div>
                                <div class="form-group"><label>Description</label><textarea name="description" rows="3">{{ $event->description }}</textarea></div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label>Nouvelle photo (upload)</label>
                                        <input type="file" name="image_upload" accept="image/*">
                                        @if($event->image_url)<p style="font-size: 0.75rem; color: var(--text-muted); margin-top: 0.25rem;">Actuelle : <a href="{{ $event->image_url }}" target="_blank">voir</a></p>@endif
                                    </div>
                                    <div class="form-group"><label>Ou URL image</label><input type="url" name="image_url" value="{{ $event->image_url }}" placeholder="https://..."></div>
                                </div>
                                <div style="display:flex; gap: 0.75rem;">
                                    <button type="submit" class="btn btn-primary">Sauvegarder</button>
                                    <button type="button" class="btn btn-ghost" onclick="toggleEditRow('tledit-{{ $event->id }}')">Annuler</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" style="text-align:center; color: var(--text-muted); padding: 2rem;">Aucun événement pour l'instant.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="section-sep"></div>

{{-- ===== GIFTS ===== --}}
<div id="gifts" class="section-anchor">
    <div class="admin-card">
        <div class="admin-card-header">
            <h3>🎁 Liste de cadeaux</h3>
            <button class="btn btn-blush btn-sm" onclick="toggleForm('giftAddForm')">+ Ajouter</button>
        </div>

        <div id="giftAddForm" style="display:none; padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--border); background: var(--cream);">
            <form action="{{ route('admin.gifts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group"><label>Nom du cadeau *</label><input type="text" name="name" required placeholder="ex. Poussette Bugaboo"></div>
                    <div class="form-group"><label>Catégorie</label><input type="text" name="category" placeholder="ex. Mobilité, Chambre, Vêtements..."></div>
                </div>
                <div class="form-row">
                    <div class="form-group"><label>Prix (€) *</label><input type="number" name="price" step="0.01" min="0" required placeholder="0.00"></div>
                    <div class="form-group"><label>Ordre d'affichage</label><input type="number" name="sort_order" value="0" min="0"></div>
                </div>
                <div class="form-group">
                    <label>Photo du cadeau (upload)</label>
                    <input type="file" name="image_upload" accept="image/*">
                </div>
                <div class="form-group">
                    <label>Ou URL image (optionnel)</label>
                    <input type="url" name="image_url" placeholder="https://...">
                </div>
                <div style="display:flex; gap: 0.75rem;">
                    <button type="submit" class="btn btn-primary">Ajouter le cadeau</button>
                    <button type="button" class="btn btn-ghost" onclick="toggleForm('giftAddForm')">Annuler</button>
                </div>
            </form>
        </div>

        <div class="admin-card-body" style="padding: 0;">
            <table>
                <thead>
                    <tr>
                        <th>Cadeau</th>
                        <th>Catégorie</th>
                        <th>Prix</th>
                        <th>Statut</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($giftItems as $gift)
                    <tr>
                        <td><strong>{{ $gift->name }}</strong></td>
                        <td><span style="font-size: 0.8rem; color: var(--text-muted);">{{ $gift->category ?: '—' }}</span></td>
                        <td><strong>{{ number_format($gift->price, 2, ',', ' ') }} €</strong></td>
                        <td>
                            @if($gift->is_reserved)
                                <span class="badge badge-green">✓ Réservé</span>
                                <span style="display: block; font-size: 0.72rem; color: var(--text-muted); margin-top: 0.2rem;">par {{ $gift->reserved_by }}</span>
                            @else
                                <span class="badge badge-gray">Disponible</span>
                            @endif
                        </td>
                        <td>
                            @if($gift->image_url)
                                <img src="{{ $gift->image_url }}" class="tl-thumb" alt="">
                            @else
                                <span style="font-size: 0.75rem; color: var(--text-light);">Aucune</span>
                            @endif
                        </td>
                        <td>
                            <div style="display:flex; gap: 0.35rem;">
                                <button class="btn btn-ghost btn-sm" onclick="toggleEditRow('gedit-{{ $gift->id }}')">✏️</button>
                                <form action="{{ route('admin.gifts.delete', $gift) }}" method="POST" onsubmit="return confirm('Supprimer ce cadeau ?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">✕</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <tr id="gedit-{{ $gift->id }}" style="display: none; background: var(--cream);">
                        <td colspan="6" style="padding: 1.25rem 1.5rem;">
                            <form action="{{ route('admin.gifts.update', $gift) }}" method="POST" enctype="multipart/form-data">
                                @csrf @method('PUT')
                                <div class="form-row">
                                    <div class="form-group"><label>Nom</label><input type="text" name="name" value="{{ $gift->name }}" required></div>
                                    <div class="form-group"><label>Catégorie</label><input type="text" name="category" value="{{ $gift->category }}"></div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group"><label>Prix (€)</label><input type="number" name="price" step="0.01" value="{{ $gift->price }}" required></div>
                                    <div class="form-group"><label>Ordre</label><input type="number" name="sort_order" value="{{ $gift->sort_order }}" min="0"></div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label>Nouvelle photo (upload)</label>
                                        <input type="file" name="image_upload" accept="image/*">
                                        @if($gift->image_url)<p style="font-size: 0.75rem; color: var(--text-muted); margin-top: 0.25rem;"><a href="{{ $gift->image_url }}" target="_blank">Voir image actuelle</a></p>@endif
                                    </div>
                                    <div class="form-group"><label>Ou URL image</label><input type="url" name="image_url" value="{{ $gift->image_url }}" placeholder="https://..."></div>
                                </div>
                                <div class="form-group">
                                    <label>Statut réservation</label>
                                    <select name="is_reserved">
                                        <option value="0" {{ !$gift->is_reserved ? 'selected' : '' }}>Disponible</option>
                                        <option value="1" {{ $gift->is_reserved ? 'selected' : '' }}>Réservé</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Réservé par</label>
                                    <input type="text" name="reserved_by" value="{{ $gift->reserved_by }}" placeholder="Prénom">
                                </div>
                                <div style="display:flex; gap: 0.75rem;">
                                    <button type="submit" class="btn btn-primary">Sauvegarder</button>
                                    <button type="button" class="btn btn-ghost" onclick="toggleEditRow('gedit-{{ $gift->id }}')">Annuler</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" style="text-align:center; color: var(--text-muted); padding: 2rem;">Aucun cadeau pour l'instant.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="section-sep"></div>

{{-- ===== NAMES ===== --}}
<div id="names" class="section-anchor">
    <div class="admin-card">
        <div class="admin-card-header">
            <h3>✨ Prénoms & votes</h3>
            <button class="btn btn-blush btn-sm" onclick="toggleForm('nameAddForm')">+ Ajouter</button>
        </div>
        <div id="nameAddForm" style="display:none; padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--border); background: var(--cream);">
            <form action="{{ route('admin.names.store') }}" method="POST">
                @csrf
                <div class="inline-edit-form">
                    <div class="form-group" style="flex: 1; margin: 0;">
                        <label>Prénom</label>
                        <input type="text" name="name" required placeholder="ex. Léa, Mathieu..." minlength="2" maxlength="50">
                    </div>
                    <button type="submit" class="btn btn-primary" style="margin-top: 1.25rem;">Ajouter</button>
                    <button type="button" class="btn btn-ghost" onclick="toggleForm('nameAddForm')" style="margin-top: 1.25rem;">Annuler</button>
                </div>
            </form>
        </div>
        <div class="admin-card-body" style="padding: 0;">
            <table>
                <thead>
                    <tr>
                        <th style="width:40px">Rang</th>
                        <th>Prénom</th>
                        <th>Votes</th>
                        <th style="width:120px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($nameOptions as $i => $opt)
                    <tr>
                        <td><span class="name-rank">{{ $i + 1 }}</span></td>
                        <td>
                            <span style="font-family:'Cormorant Garamond',serif; font-size:1.15rem; font-weight:400;">{{ $opt->name }}</span>
                        </td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <div style="height: 6px; width: 100px; background: var(--border); border-radius: 50px; overflow: hidden;">
                                    <div style="height: 100%; width: {{ $nameOptions->max('votes_count') > 0 ? round($opt->votes_count / $nameOptions->max('votes_count') * 100) : 0 }}%; background: var(--blush-deep); border-radius: 50px;"></div>
                                </div>
                                <strong>{{ $opt->votes_count }}</strong>
                            </div>
                        </td>
                        <td>
                            <div style="display:flex; gap: 0.35rem;">
                                <form action="{{ route('admin.names.delete', $opt) }}" method="POST" onsubmit="return confirm('Supprimer ce prénom ?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">✕</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" style="text-align:center; color: var(--text-muted); padding: 2rem;">Aucun prénom proposé.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="section-sep"></div>

{{-- ===== MESSAGES ===== --}}
<div id="messages" class="section-anchor">
    <div class="admin-card">
        <div class="admin-card-header">
            <h3>💌 Livre d'or</h3>
            @php $pending = $guestbookMessages->where('is_approved', false)->count(); @endphp
            @if($pending > 0)
                <span class="badge badge-blush">{{ $pending }} en attente</span>
            @endif
        </div>
        <div class="admin-card-body" style="padding: 0;">
            <table>
                <thead>
                    <tr>
                        <th>Auteur</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($guestbookMessages as $msg)
                    <tr>
                        <td><strong>{{ $msg->author }}</strong></td>
                        <td><span class="message-preview">{{ $msg->message }}</span></td>
                        <td><span style="font-size: 0.78rem; color: var(--text-muted);">{{ $msg->created_at->locale('fr')->diffForHumans() }}</span></td>
                        <td>
                            <span class="badge {{ $msg->is_approved ? 'badge-green' : 'badge-gray' }}">
                                {{ $msg->is_approved ? '✓ Publié' : 'En attente' }}
                            </span>
                        </td>
                        <td>
                            <div style="display: flex; gap: 0.35rem; align-items: center;">
                                <form action="{{ route('admin.messages.toggle', $msg) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="btn btn-ghost btn-sm" title="{{ $msg->is_approved ? 'Masquer' : 'Publier' }}">
                                        {{ $msg->is_approved ? '👁' : '👁‍🗨' }}
                                    </button>
                                </form>
                                <form action="{{ route('admin.messages.delete', $msg) }}" method="POST" onsubmit="return confirm('Supprimer ce message ?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">✕</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" style="text-align:center; color: var(--text-muted); padding: 2rem;">Aucun message pour l'instant.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="section-sep"></div>

{{-- ===== DONATIONS ===== --}}
<div id="donations" class="section-anchor">
    <div class="admin-card">
        <div class="admin-card-header">
            <h3>💝 Dons reçus</h3>
            <div style="display: flex; align-items: center; gap: 1rem;">
                <span style="font-size: 0.85rem; color: var(--text-muted);">Total :</span>
                <strong style="font-family:'Cormorant Garamond',serif; font-size: 1.3rem; font-weight: 300;">{{ number_format($donations->where('confirmed', true)->sum('amount'), 2, ',', ' ') }} €</strong>
            </div>
        </div>
        <div class="admin-card-body" style="padding: 0;">
            <table>
                <thead>
                    <tr>
                        <th>Montant</th>
                        <th>Donateur</th>
                        <th>Méthode</th>
                        <th>Note</th>
                        <th>Date</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($donations as $donation)
                    <tr class="donation-row">
                        <td><strong>{{ number_format($donation->amount, 2, ',', ' ') }} €</strong></td>
                        <td>{{ $donation->donor_name ?: '<span style="color: var(--text-light)">Anonyme</span>' }}</td>
                        <td>
                            <span class="badge badge-gray">{{ $donation->payment_method }}</span>
                        </td>
                        <td><span class="message-preview" style="font-style: normal;">{{ $donation->note ?: '—' }}</span></td>
                        <td><span style="font-size: 0.78rem; color: var(--text-muted);">{{ $donation->created_at->locale('fr')->format('d/m/Y H:i') }}</span></td>
                        <td>
                            <span class="badge {{ $donation->confirmed ? 'badge-green' : 'badge-gray' }}">
                                {{ $donation->confirmed ? '✓ Confirmé' : 'En attente' }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" style="text-align:center; color: var(--text-muted); padding: 2rem;">Aucun don pour l'instant.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function toggleForm(id) {
    const el = document.getElementById(id);
    el.style.display = el.style.display === 'none' ? 'block' : 'none';
}
function toggleEditRow(id) {
    const row = document.getElementById(id);
    row.style.display = row.style.display === 'none' ? 'table-row' : 'none';
}
// Highlight active tab based on scroll
const sections = ['content','timeline','gifts','names','messages','donations'];
const tabs = document.querySelectorAll('.tab-btn');
window.addEventListener('scroll', () => {
    let current = '';
    sections.forEach(id => {
        const el = document.getElementById(id);
        if (el && el.getBoundingClientRect().top < 120) current = id;
    });
    tabs.forEach(t => {
        t.classList.remove('active');
        if (t.getAttribute('href') === '#' + current) t.classList.add('active');
    });
});
</script>
@endpush
