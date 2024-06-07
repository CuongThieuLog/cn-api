<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonMovie extends Model
{
    use HasFactory;

    protected $table = 'person_movie';

    protected $fillable = [
        'person_id',
        'movie_id',
    ];
}
