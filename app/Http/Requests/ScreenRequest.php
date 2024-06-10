<?php

namespace App\Http\Requests;

class ScreenRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'column_size' => 'required|integer|min:1',
            'row_size' => 'required|integer|min:1',
            'cinema_id' => 'required|exists:cinema,id',
        ];
    }
}