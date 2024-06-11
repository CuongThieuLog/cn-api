<?php

namespace App\Http\Requests;

class SeatRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'row' => 'required|integer|min:1',
            'column' => 'required|integer|min:1',
            'seat_type' => 'required|string|max:255',
            'is_active' => 'boolean',
            'screen_id' => 'required|exists:screen,id',
        ];
    }
}