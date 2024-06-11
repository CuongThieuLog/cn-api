<?php

namespace App\Http\Requests;

class TicketFoodRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ticket_id' => 'required|exists:ticket,id',
            'food_id' => 'required|exists:food,id',
        ];
    }
}