<?php

namespace App\Console\Commands;

use App\Jobs\DeletePriceAlertJob;
use App\Jobs\SendingEmailJob;
use App\Services\GoldPrice\GoldPriceServiceInterface;
use App\Services\PriceAlert\PriceAlertServiceInterface;
use Illuminate\Console\Command;
use RedisException;

class PriceAlertProcessorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:price-alert-processor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'process price alerts';

    /**
     * Execute the console command.
     */
    public function handle(
        GoldPriceServiceInterface $goldPriceService,
        PriceAlertServiceInterface $priceAlertService,
    ): void {
        try {
            $currentPrice = $goldPriceService->fetchPrice();
            $alerts = $priceAlertService->fetchAlerts($currentPrice);

            foreach ($alerts as $price => $items) {
                foreach ($items as $item) {
                    $alert = json_decode($item);
                    $message = $currentPrice > $price ?
                        "Dear {$alert->user->name}. The price of gold has crossed {$price}. The current price of gold is {$currentPrice}." :
                        "Dear {$alert->user->name}. The price of gold has reached {$price}.";
                    $uniqueKey = "alert_{$alert->id}";
                    SendingEmailJob::dispatch($alert->user->email, $message, $uniqueKey);
                    DeletePriceAlertJob::dispatch($alert->id);
                }
            }
        } catch (RedisException $th) {
            sleep(3);
            $priceAlertService->recoverData();
        }
    }
}
