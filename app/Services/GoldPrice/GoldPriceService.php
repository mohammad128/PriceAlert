<?php

namespace App\Services\GoldPrice;

use Illuminate\Support\Facades\Cache;

class GoldPriceService implements GoldPriceServiceInterface
{
    public const GOLD_PRICE_KEY = 'GOLD_PRICE';

    public function fetchPrice(): int
    {
        $price = (int) Cache::get('GOLD_PRICE', 1000);
        $change = ceil(rand(-10, 10));
        $price += $change;

        $price = max(900, $price);

        Cache::set('GOLD_PRICE', $price);

        return $price;
    }
}
