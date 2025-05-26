<?php

namespace App\Http\Requests;

use App\DTOs\PriceAlertDto;
use Illuminate\Foundation\Http\FormRequest;

class PriceAlertRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => [
                'required',
                'integer',
                'exists:users,id',
            ],
            'price' => [
                'required',
                'integer',
                'min:1',
            ],
        ];
    }

    public function toDto(): PriceAlertDto
    {
        return PriceAlertDto::make(
            user_id: $this->input(key: 'user_id'),
            price: $this->input(key: 'price'),
        );
    }
}
