<?php

namespace App\DTOs;

class PriceAlertDto
{
    public function __construct(
        public int $user_id,
        public float $price,
    ) {}

    public function toArray(): array
    {
        return [
            'user_id' => $this->user_id,
            'price' => $this->price,
        ];
    }

    public static function make(
        int $user_id,
        float $price,
    ): static {
        return new static(
            user_id: $user_id,
            price: $price,
        );
    }
}
