<?php

namespace App\Repositories;

use App\Models\Cinema;
use App\Repositories\Interfaces\CinemaInterface;

class CinemaRepository implements CinemaInterface
{
    protected $cinema;

    public function __construct(Cinema $cinema)
    {
        $this->cinema = $cinema;
    }

    public function store($data)
    {
        return $this->cinema->create($data);
    }

    public function update($data, $id)
    {
        $cinema = $this->cinema->findOrFail($id);
        $cinema->fill($data);
        $cinema->save();

        return $cinema;
    }

    public function show($id)
    {
        return $this->cinema->findOrFail($id);
    }
}