<?php

namespace App\Http\Requests;

class InformationRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'address' => 'nullable|string|max:255',
            'birthday' => 'nullable|date',
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string',
            'gender' => 'nullable|in:Male,Female,Other',
            'user_id' => 'required|exists:users,id',
        ];
    }
}