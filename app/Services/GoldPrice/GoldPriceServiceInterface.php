<?php

namespace App\Services\GoldPrice;

interface GoldPriceServiceInterface
{
    public function fetchPrice(): int;
}
