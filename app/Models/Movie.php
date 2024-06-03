<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'movie';

    protected $fillable = [
        'name',
        'national',
        'released_at',
        'language_movie',
        'duration',
        'limit_age',
        'brief_movie',
        'trailer_movie',
        'movie_type_id',
        'movie_format_id',
        'ticket_price',
    ];

    protected $dates = ['released_at', 'created_at', 'updated_at', 'deleted_at'];

    public function movieType()
    {
        return $this->belongsTo(MovieType::class);
    }

    public function movieFormat()
    {
        return $this->belongsTo(MovieFormat::class);
    }
}