<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Screen extends Model
{
    use HasFactory;

    protected $table = 'screen';

    protected $fillable = [
        'name', 
        'column_size', 
        'row_size', 
        'cinema_id',
    ];

    public function cinema()
    {
        return $this->belongsTo(Cinema::class);
    }
}