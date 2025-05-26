<?php

use App\Http\Controllers\PriceAlertController;
use Illuminate\Support\Facades\Route;

Route::post('set-alert', PriceAlertController::class)->name('set-alert');
