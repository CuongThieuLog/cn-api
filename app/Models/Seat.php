<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $table = 'seat';

    protected $fillable = [
        'name',
        'row',
        'column',
        'seat_type',
        'is_active',
        'screen_id',
    ];

    protected $casts = [
        'row' => 'integer',
        'column' => 'integer',
        'is_active' => 'boolean',
        'screen_id' => 'integer',
    ];

    public function screen()
    {
        return $this->belongsTo(Screen::class);
    }
}
