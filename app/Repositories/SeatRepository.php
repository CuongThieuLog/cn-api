<?php

namespace App\Repositories;

use App\Models\Seat;
use App\Repositories\Interfaces\SeatInterface;

class SeatRepository implements SeatInterface
{
    protected $seat;

    public function __construct(Seat $seat)
    {
        $this->seat = $seat;
    }

    public function store($data)
    {
        return $this->seat->create($data);
    }

    public function update($data, $id)
    {
        $seat = $this->seat->findOrFail($id);
        $seat->fill($data);
        $seat->save();

        return $seat;
    }

    public function show($id)
    {
        return $this->seat->findOrFail($id);
    }
}