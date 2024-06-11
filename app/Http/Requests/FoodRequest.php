<?php

namespace App\Http\Requests;

class FoodRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'require|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ];
    }
}