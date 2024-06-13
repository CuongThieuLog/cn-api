<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieImage extends Model
{
    use HasFactory;

    protected $table = 'movie_image';

    protected $fillable = [
        'image_url',
        'image_key',
        'movie_id',
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}