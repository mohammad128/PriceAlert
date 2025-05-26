<?php

namespace App\Http\Controllers;

use App\Actions\CreatePriceAlertAction;
use App\Http\Requests\PriceAlertRequest;
use App\Http\Resources\PriceAlertResource;

class PriceAlertController extends Controller
{
    public function __invoke(PriceAlertRequest $request): PriceAlertResource
    {
        $alert = CreatePriceAlertAction::run($request->toDto());

        return PriceAlertResource::make($alert);
    }
}
