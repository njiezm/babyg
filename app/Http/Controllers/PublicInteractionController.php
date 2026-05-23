<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\GiftItem;
use App\Models\GuestbookMessage;
use App\Models\NameOption;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PublicInteractionController extends Controller
{
    public function suggestName(Request $request): JsonResponse|RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:50'],
        ]);

        $option = NameOption::firstOrCreate([
            'name' => trim($data['name']),
        ]);

        if ($option->wasRecentlyCreated) {
            $option->votes()->create([
                'voter_name' => 'Suggestion automatique',
                'ip_address' => $request->ip(),
            ]);
        }

        return $this->response($request, [
            'message' => 'Suggestion enregistrée.',
            'option' => $option->loadCount('votes'),
        ]);
    }

    public function voteName(Request $request, NameOption $nameOption): JsonResponse|RedirectResponse
    {
        $data = $request->validate([
            'voter_name' => ['required', 'string', 'min:2', 'max:80'],
        ]);

        $nameOption->votes()->create([
            'voter_name' => trim($data['voter_name']),
            'ip_address' => $request->ip(),
        ]);

        return $this->response($request, [
            'message' => 'Vote enregistré.',
            'votes_count' => $nameOption->votes()->count(),
        ]);
    }

    public function reserveGift(Request $request, GiftItem $giftItem): JsonResponse|RedirectResponse
    {
        $data = $request->validate([
            'reserver_name' => ['required', 'string', 'min:2', 'max:100'],
        ]);

        if ($giftItem->is_reserved) {
            return $this->response($request, [
                'message' => 'Ce cadeau est déjà réservé.',
            ], 422);
        }

        $giftItem->update([
            'is_reserved' => true,
            'reserved_by' => trim($data['reserver_name']),
        ]);

        return $this->response($request, [
            'message' => 'Réservation enregistrée.',
        ]);
    }

    public function storeDonation(Request $request): JsonResponse|RedirectResponse
    {
        $data = $request->validate([
            'amount' => ['required', 'numeric', 'min:1', 'max:10000'],
            'donor_name' => ['nullable', 'string', 'max:100'],
            'payment_method' => ['nullable', 'string', 'max:50'],
            'note' => ['nullable', 'string', 'max:500'],
        ]);

        Donation::create([
            'amount' => $data['amount'],
            'donor_name' => $data['donor_name'] ?? null,
            'payment_method' => $data['payment_method'] ?? 'manuel',
            'note' => $data['note'] ?? null,
            'confirmed' => true,
        ]);

        return $this->response($request, [
            'message' => 'Don enregistré. Merci !',
            'total' => Donation::where('confirmed', true)->sum('amount'),
        ]);
    }

    public function storeGuestbook(Request $request): JsonResponse|RedirectResponse
    {
        $data = $request->validate([
            'author' => ['required', 'string', 'min:2', 'max:100'],
            'message' => ['required', 'string', 'min:3', 'max:800'],
        ]);

        $entry = GuestbookMessage::create([
            'author' => trim($data['author']),
            'message' => trim($data['message']),
            'is_approved' => true,
        ]);

        return $this->response($request, [
            'message' => 'Message ajouté au livre d\'or.',
            'entry' => $entry,
        ]);
    }

    private function response(Request $request, array $payload, int $status = 200): JsonResponse|RedirectResponse
    {
        if ($request->expectsJson()) {
            return response()->json($payload, $status);
        }

        return back()->with($status >= 400 ? 'error' : 'success', $payload['message'] ?? 'Action effectuée.');
    }
}

