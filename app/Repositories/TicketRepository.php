<?php

namespace App\Repositories;

use App\Models\Ticket;
use App\Repositories\Interfaces\TicketInterface;

class TicketRepository implements TicketInterface
{
    protected $ticket;

    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function store($data)
    {
        return $this->ticket->create($data);
    }

    public function update($data, $id)
    {
        $ticket = $this->ticket->findOrFail($id);
        $ticket->fill($data);
        $ticket->save();

        return $ticket;
    }

    public function show($id)
    {
        return $this->ticket->findOrFail($id);
    }
}