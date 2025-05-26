<?php

namespace App\Services\PriceAlert;

use App\Models\PriceAlert;
use Illuminate\Support\Facades\Redis;

class PriceAlertService implements PriceAlertServiceInterface
{
    public const PRICE_ALERT_PRICES_KEY = 'PRICE_ALERT_PRICES';

    public const PRICE_ALERT_LIST_PREFIX_KEY = 'PRICE_ALERTS:';

    public function addPriceAlert(PriceAlert $alert): void
    {
        Redis::rpush(PriceAlertService::PRICE_ALERT_LIST_PREFIX_KEY.$alert->price, $alert->id);
        Redis::zadd(PriceAlertService::PRICE_ALERT_PRICES_KEY, $alert->price, $alert->price);
    }

    public function fetchAlerts(int $currentPrice): array
    {
        $alerts = [];

        $priceKey = PriceAlertService::PRICE_ALERT_PRICES_KEY;

        $prices = Redis::zrangebyscore(PriceAlertService::PRICE_ALERT_PRICES_KEY, '-inf', $currentPrice);

        foreach ($prices as $price) {
            $alertIdsKey = PriceAlertService::PRICE_ALERT_LIST_PREFIX_KEY.$price;
            $alertIds = Redis::lrange($alertIdsKey, 0, -1);

            if (! empty($alertIds)) {
                $alerts[$price] = $alertIds;

                Redis::del($alertIdsKey);
                Redis::zrem($priceKey, $price);
            }
        }

        return $alerts;
    }

    public function recoverData()
    {
        // TODO: Recover data from the database when a problem occurs.
    }
}
