<?php

namespace App\Http\Requests;

class PersonMovieRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'person_id' => 'required|exists:person,id',
            'movie_id' => 'required|exists:movie,id',
        ];
    }
}