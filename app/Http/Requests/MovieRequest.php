<?php

namespace App\Http\Requests;

class MovieRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'national' => 'required|string|max:255',
            'released_at' => 'required|date',
            'language_movie' => 'required|string|max:50',
            'duration' => 'required|integer|min:1',
            'limit_age' => 'required|integer|min:0',
            'brief_movie' => 'required|string',
            'trailer_movie' => 'required|url',
            'movie_type_id' => 'required|exists:movie_type,id',
            'movie_format_id' => 'required|exists:movie_format,id',
            'ticket_price' => 'required|integer|min:0',
        ];
    }
}