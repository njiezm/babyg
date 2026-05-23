<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContentBlock;
use App\Models\Donation;
use App\Models\GiftItem;
use App\Models\GuestbookMessage;
use App\Models\NameOption;
use App\Models\TimelineEvent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $contentBlocks = ContentBlock::orderBy('group_name')->orderBy('sort_order')->get();
        $guestbookMessages = GuestbookMessage::where('is_approved', true)->latest()->get();
        $donationTotal = Donation::where('confirmed', true)->sum('amount');


        return view('admin.dashboard', [
            'contentBlocks' => $contentBlocks,
            'contentGroups' => $contentBlocks->groupBy('group_name'),
            'timelineEvents' => TimelineEvent::orderBy('sort_order')->get(),
            'giftItems' => GiftItem::orderBy('sort_order')->get(),
            'nameOptions' => NameOption::withCount('votes')->orderByDesc('votes_count')->orderBy('name')->get(),
            'messages' => GuestbookMessage::latest()->get(),
            'donations' => Donation::latest()->get(),
            'donationTotal' => Donation::where('confirmed', true)->sum('amount'),
            'guestbookMessages' => $guestbookMessages,
        ]);
    }

    public function updateContentold(ContentBlock $contentBlock, Request $request): RedirectResponse
    {
        $data = $request->validate([
            'value' => ['nullable', 'string'],
            'label' => ['required', 'string', 'max:120'],
            'group_name' => ['required', 'string', 'max:80'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:9999'],
        ]);

        $contentBlock->update($data);

        return back()->with('success', 'Contenu mis à jour.');
    }

    public function updateContent(ContentBlock $contentBlock, Request $request): RedirectResponse
{
    $data = $request->validate([
        'value' => ['nullable', 'string'],
    ]);

    $contentBlock->update($data);

    return back()->with('success', 'Contenu mis à jour.');
}

    public function storeTimeline(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'subtitle' => ['nullable', 'string', 'max:120'],
            'description' => ['nullable', 'string', 'max:500'],
            'image_url' => ['nullable', 'string', 'max:500'],
            'image_file' => ['nullable', 'image', 'max:4096'],
            'event_date' => ['nullable', 'date'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:9999'],
        ]);

        $data['image_url'] = $this->resolveImagePath($request, 'image_file', 'image_url');
        TimelineEvent::create($data);

        return back()->with('success', 'Évènement ajouté.');
    }

    public function updateTimeline(TimelineEvent $timelineEvent, Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'subtitle' => ['nullable', 'string', 'max:120'],
            'description' => ['nullable', 'string', 'max:500'],
            'image_url' => ['nullable', 'string', 'max:500'],
            'image_file' => ['nullable', 'image', 'max:4096'],
            'remove_image' => ['nullable', 'boolean'],
            'event_date' => ['nullable', 'date'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:9999'],
        ]);

        $data['image_url'] = $this->resolveImagePath($request, 'image_file', 'image_url', $timelineEvent->image_url);
        $timelineEvent->update($data);

        return back()->with('success', 'Évènement mis à jour.');
    }

    public function deleteTimeline(TimelineEvent $timelineEvent): RedirectResponse
    {
        $timelineEvent->delete();

        return back()->with('success', 'Évènement supprimé.');
    }

    public function storeGift(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'category' => ['nullable', 'string', 'max:80'],
            'price' => ['required', 'numeric', 'min:0'],
            'image_url' => ['nullable', 'string', 'max:500'],
            'image_file' => ['nullable', 'image', 'max:4096'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:9999'],
        ]);

        $data['image_url'] = $this->resolveImagePath($request, 'image_file', 'image_url');
        GiftItem::create($data);

        return back()->with('success', 'Cadeau ajouté.');
    }

    public function updateGift(GiftItem $giftItem, Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'category' => ['nullable', 'string', 'max:80'],
            'price' => ['required', 'numeric', 'min:0'],
            'image_url' => ['nullable', 'string', 'max:500'],
            'image_file' => ['nullable', 'image', 'max:4096'],
            'remove_image' => ['nullable', 'boolean'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:9999'],
            'is_reserved' => ['nullable', 'boolean'],
            'reserved_by' => ['nullable', 'string', 'max:100'],
        ]);

        $data['is_reserved'] = $request->boolean('is_reserved');
        if (! $data['is_reserved']) {
            $data['reserved_by'] = null;
        }

        $data['image_url'] = $this->resolveImagePath($request, 'image_file', 'image_url', $giftItem->image_url);
        $giftItem->update($data);

        return back()->with('success', 'Cadeau mis à jour.');
    }

    public function deleteGift(GiftItem $giftItem): RedirectResponse
    {
        $giftItem->delete();

        return back()->with('success', 'Cadeau supprimé.');
    }

    public function storeName(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:50', 'unique:name_options,name'],
        ]);

        NameOption::create($data);

        return back()->with('success', 'Prénom ajouté.');
    }

    public function updateName(NameOption $nameOption, Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:50', 'unique:name_options,name,'.$nameOption->id],
        ]);

        $nameOption->update($data);

        return back()->with('success', 'Prénom mis à jour.');
    }

    public function deleteName(NameOption $nameOption): RedirectResponse
    {
        $nameOption->delete();

        return back()->with('success', 'Prénom supprimé.');
    }

    public function toggleMessageApproval(GuestbookMessage $guestbookMessage): RedirectResponse
    {
        $guestbookMessage->update([
            'is_approved' => ! $guestbookMessage->is_approved,
        ]);

        return back()->with('success', 'Statut du message mis à jour.');
    }

    public function deleteMessage(GuestbookMessage $guestbookMessage): RedirectResponse
    {
        $guestbookMessage->delete();

        return back()->with('success', 'Message supprimé.');
    }

    private function resolveImagePath(Request $request, string $fileInput, string $urlInput, ?string $current = null): ?string
{
    if ($request->boolean('remove_image')) {
        return null;
    }

    // 1. PRIORITÉ ABSOLUE : fichier uploadé
    if ($request->hasFile($fileInput)) {
        $path = $request->file($fileInput)->store('baby-shower', 'public');
        return Storage::url($path);
    }

    // 2. sinon URL
    if ($request->filled($urlInput)) {
        return trim((string) $request->input($urlInput));
    }

    // 3. sinon ancien
    return $current;
}

    private function resolveImagePathold(Request $request, string $fileInput, string $urlInput, ?string $current = null): ?string
    {
        if ($request->boolean('remove_image')) {
            return null;
        }

        if ($request->hasFile($fileInput)) {
            $path = $request->file($fileInput)->store('baby-shower', 'public');

            return Storage::url($path);
        }

        if ($request->filled($urlInput)) {
            return trim((string) $request->input($urlInput));
        }

        return $current;
    }
}

