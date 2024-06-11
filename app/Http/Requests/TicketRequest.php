<?php

namespace App\Http\Requests;

class TicketRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
            'schedule_id' => 'required|integer|exists:schedule,id',
            'price' => 'required|numeric',
            'is_checkin' => 'sometimes|boolean',
            'payment_status' => 'required|string',
            'payment_intent_id' => 'required|string',
            'canceled_at' => 'require|date',
        ];
    }
}