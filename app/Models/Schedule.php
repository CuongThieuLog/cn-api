<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedule';

    protected $fillable = [
        'start_time',
        'end_time',
        'screen_id',
        'movie_id',
    ];

    public function screen()
    {
        return $this->belongsTo(Screen::class);
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
