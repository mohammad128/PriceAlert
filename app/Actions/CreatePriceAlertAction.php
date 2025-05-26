<?php

namespace App\Actions;

use App\DTOs\PriceAlertDto;
use App\Models\PriceAlert;
use App\Services\PriceAlert\PriceAlertServiceInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class CreatePriceAlertAction
{
    use AsAction;

    public function __construct(public PriceAlertServiceInterface $alertService) {}

    public function handle(PriceAlertDto $dto): PriceAlert
    {
        $alert = PriceAlert::query()->create(
            attributes: $dto->toArray()
        );
        $this->alertService->addPriceAlert(alert: $alert);

        return $alert;
    }
}
