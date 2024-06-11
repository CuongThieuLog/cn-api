<?php

namespace App\Http\Requests;

class ScheduleRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'screen_id' => 'required|exists:screen,id',
            'movie_id' => 'required|exists:movie,id',
        ];
    }
}