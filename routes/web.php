<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicInteractionController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::post('/names/suggest', [PublicInteractionController::class, 'suggestName'])->name('names.suggest');
Route::post('/names/{nameOption}/vote', [PublicInteractionController::class, 'voteName'])->name('names.vote');
Route::post('/gifts/{giftItem}/reserve', [PublicInteractionController::class, 'reserveGift'])->name('gifts.reserve');
Route::post('/donations', [PublicInteractionController::class, 'storeDonation'])->name('donations.store');
Route::post('/guestbook', [PublicInteractionController::class, 'storeGuestbook'])->name('guestbook.store');

Route::middleware('guest')->group(function (): void {
    Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
});

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function (): void {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::put('/contents/{contentBlock}', [DashboardController::class, 'updateContent'])->name('contents.update');

    Route::post('/timeline', [DashboardController::class, 'storeTimeline'])->name('timeline.store');
    Route::put('/timeline/{timelineEvent}', [DashboardController::class, 'updateTimeline'])->name('timeline.update');
    Route::delete('/timeline/{timelineEvent}', [DashboardController::class, 'deleteTimeline'])->name('timeline.delete');

    Route::post('/gifts', [DashboardController::class, 'storeGift'])->name('gifts.store');
    Route::put('/gifts/{giftItem}', [DashboardController::class, 'updateGift'])->name('gifts.update');
    Route::delete('/gifts/{giftItem}', [DashboardController::class, 'deleteGift'])->name('gifts.delete');

    Route::post('/names', [DashboardController::class, 'storeName'])->name('names.store');
    Route::put('/names/{nameOption}', [DashboardController::class, 'updateName'])->name('names.update');
    Route::delete('/names/{nameOption}', [DashboardController::class, 'deleteName'])->name('names.delete');

    Route::patch('/messages/{guestbookMessage}/toggle', [DashboardController::class, 'toggleMessageApproval'])->name('messages.toggle');
    Route::delete('/messages/{guestbookMessage}', [DashboardController::class, 'deleteMessage'])->name('messages.delete');
});
