<?php

namespace App\Console\Commands;

use App\Services\PriceAlert\PriceAlertServiceInterface;
use Illuminate\Console\Command;

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
        PriceAlertServiceInterface $priceAlertService
    )
    {
    }
}
