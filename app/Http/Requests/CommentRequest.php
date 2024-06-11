<?php

namespace App\Http\Requests;

class CommentRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'content' => 'required|string|max:1000',
            'user_id' => 'required|exists:users,id',
            'movie_id' => 'required|exists:movie,id',
            'star' => 'required|integer|min:1|max:5',
            'feeling' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}