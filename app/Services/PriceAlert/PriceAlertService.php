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
        Redis::rpush(PriceAlertService::PRICE_ALERT_LIST_PREFIX_KEY.$alert->price, json_encode($alert->toArray()));
        Redis::zadd(PriceAlertService::PRICE_ALERT_PRICES_KEY, $alert->price, $alert->price);
    }

    public function fetchAlerts(int $currentPrice): array
    {
        $alerts = [];

        $prices = $this->fetchActivatedPrices($currentPrice);

        foreach ($prices as $price) {
            $alertIds = $this->fetchStoredAlerts($price);
            if (! empty($alertIds)) {
                $alerts[$price] = $alertIds;
            }
            $this->deleteStoredAlerts($price);
        }

        return $alerts;
    }

    public function recoverData(): void
    {
        // Clear Redis
        $prices = Redis::zrange(PriceAlertService::PRICE_ALERT_PRICES_KEY, 0, -1);

        foreach ($prices as $price) {
            $alertIdsKey = PriceAlertService::PRICE_ALERT_LIST_PREFIX_KEY.$price;
            Redis::del($alertIdsKey);
            Redis::zrem(PriceAlertService::PRICE_ALERT_PRICES_KEY, $price);
        }

        // Recover Data From Database
        PriceAlert::all()->each(function ($priceAlert) {
            $this->addPriceAlert($priceAlert);
        });
    }

    private function fetchStoredAlerts(int $price): array
    {
        $alertIdsKey = PriceAlertService::PRICE_ALERT_LIST_PREFIX_KEY.$price;

        return Redis::lrange($alertIdsKey, 0, -1);
    }

    private function deleteStoredAlerts(int $price): void
    {
        $alertIdsKey = PriceAlertService::PRICE_ALERT_LIST_PREFIX_KEY.$price;
        Redis::del($alertIdsKey);
        Redis::zrem(PriceAlertService::PRICE_ALERT_PRICES_KEY, $price);
    }

    private function fetchActivatedPrices(int $currentPrice)
    {
        return Redis::zrangebyscore(PriceAlertService::PRICE_ALERT_PRICES_KEY, '-inf', $currentPrice);
    }
}
