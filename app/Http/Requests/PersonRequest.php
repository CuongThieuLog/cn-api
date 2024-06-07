<?php

namespace App\Http\Requests;

class PersonRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'avatar' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'biography' => 'required|string|max:255',
        ];
    }
}