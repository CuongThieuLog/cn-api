<?php

namespace App\Http\Requests;

class TicketSeatRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ticket_id' => 'required|exists:ticket,id',
            'seat_id' => 'required|exists:seat,id',
        ];
    }
}