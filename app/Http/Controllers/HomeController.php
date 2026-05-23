<?php

namespace App\Http\Controllers;

use App\Models\ContentBlock;
use App\Models\Donation;
use App\Models\GiftItem;
use App\Models\GuestbookMessage;
use App\Models\NameOption;
use App\Models\TimelineEvent;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $content = ContentBlock::orderBy('group_name')->orderBy('sort_order')->get();
        $contentByKey = $content->pluck('value', 'key');
        $giftItems = GiftItem::orderBy('sort_order')->get();
        $timelineEvents = TimelineEvent::orderBy('sort_order')->get();
        $guestbookMessages = GuestbookMessage::where('is_approved', true)->latest()->get();
        $donationTotal = Donation::where('confirmed', true)->sum('amount');

        return view('site.index', [
            'contentBlocks' => $content,
            'contentByKey' => $contentByKey,
            'timelineEvents' => $timelineEvents,
            'giftItems' => $giftItems,
            'nameOptions' => NameOption::withCount('votes')->orderByDesc('votes_count')->orderBy('name')->get(),
            'guestbookMessages' => $guestbookMessages,
            'donationTotal' => $donationTotal,
            'reservedGiftsCount' => $giftItems->where('is_reserved', true)->count(),
            'featuredGifts' => $giftItems->take(3),
            'latestMessages' => $guestbookMessages->take(3),
            'timelineHighlight' => $timelineEvents->first(),
        ]);
    }
}

