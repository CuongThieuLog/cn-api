<?php

namespace App\Repositories;

use App\Models\TicketFood;
use App\Repositories\Interfaces\TicketFoodInterface;

class TicketFoodRepository implements TicketFoodInterface
{
    protected $ticketFood;

    public function __construct(TicketFood $ticketFood)
    {
        $this->ticketFood = $ticketFood;
    }

    public function store($data)
    {
        return $this->ticketFood->create($data);
    }

    public function update($data, $id)
    {
        $ticketFood = $this->ticketFood->findOrFail($id);
        $ticketFood->fill($data);
        $ticketFood->save();

        return $ticketFood;
    }

    public function show($id)
    {
        return $this->ticketFood->findOrFail($id);
    }
}