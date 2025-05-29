<?php

namespace App\Actions;

use App\DTOs\PriceAlertDto;
use App\Models\PriceAlert;
use App\Services\PriceAlert\PriceAlertServiceInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class CreatePriceAlertAction
{
    use AsAction;

    public function __construct(public PriceAlertServiceInterface $alertService) {}

    public function handle(PriceAlertDto $dto): PriceAlert
    {
        return DB::transaction(function () use ($dto) {
            $alert = PriceAlert::query()->create(
                attributes: $dto->toArray()
            );
            $this->alertService->addPriceAlert(alert: $alert->load('user'));

            return $alert;
        });
    }
}
