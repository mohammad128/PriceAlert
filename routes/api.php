<?php

use App\Http\Controllers\PriceAlertController;
use Illuminate\Support\Facades\Route;

Route::post('set-alert', PriceAlertController::class)->name('set-alert');

Route::post('current-price', fn() => response()->json([
    'price' => \Illuminate\Support\Facades\Cache::get(\App\Services\GoldPrice\GoldPriceService::GOLD_PRICE_KEY)
]))->name('set-alert');
