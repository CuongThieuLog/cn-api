<?php

namespace App\Repositories;

use App\Models\TicketSeat;
use App\Repositories\Interfaces\TicketSeatInterface;

class TicketSeatRepository implements TicketSeatInterface
{
    protected $ticketSeat;

    public function __construct(TicketSeat $ticketSeat)
    {
        $this->ticketSeat = $ticketSeat;
    }

    public function store($data)
    {
        return $this->ticketSeat->create($data);
    }

    public function update($data, $id)
    {
        $ticketSeat = $this->ticketSeat->findOrFail($id);
        $ticketSeat->fill($data);
        $ticketSeat->save();

        return $ticketSeat;
    }

    public function show($id)
    {
        return $this->ticketSeat->findOrFail($id);
    }
}