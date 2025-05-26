<?php

namespace App\Services\PriceAlert;

use App\Models\PriceAlert;

interface PriceAlertServiceInterface
{
    public function addPriceAlert(PriceAlert $alert): void;

    public function fetchAlerts(int $currentPrice): array;

    public function recoverData();
}
