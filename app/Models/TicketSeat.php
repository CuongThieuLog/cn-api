<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketSeat extends Model
{
    use HasFactory;

    protected $table = 'ticket_seat';

    protected $fillable = [
        'ticket_id',
        'seat_id',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }
}
