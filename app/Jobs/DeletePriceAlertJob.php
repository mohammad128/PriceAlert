<?php

namespace App\Jobs;

use App\Models\PriceAlert;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class DeletePriceAlertJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public int $alertId)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        PriceAlert::query()->where('id', $this->alertId)->delete();
    }
}
