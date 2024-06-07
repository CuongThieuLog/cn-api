<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;

    protected $table = 'information';

    protected $fillable = [
        'address',
        'birthday',
        'phone',
        'bio',
        'gender',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
