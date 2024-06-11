<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketFood extends Model
{
    use HasFactory;

    protected $table = 'ticket_food';

    protected $fillable = [
        'ticket_id',
        'food_id',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function food()
    {
        return $this->belongsTo(Food::class);
    }
}
