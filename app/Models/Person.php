<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'person';

    protected $fillable = [
        'name',
        'position',
        'avatar',
        'date_of_birth',
        'biography',
    ];

    protected $dates = ['date_of_birth', 'deleted_at'];
}
