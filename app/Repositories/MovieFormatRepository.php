<?php

namespace App\Repositories;

use App\Models\MovieFormat;
use App\Repositories\Interfaces\MovieFormatInterface;

class MovieFormatRepository implements MovieFormatInterface
{
    protected $movieFormat;

    public function __construct(MovieFormat $movieFormat)
    {
        $this->movieFormat = $movieFormat;
    }

    public function store($data)
    {
        return $this->movieFormat->create($data);
    }

    public function update($data, $id)
    {
        $movieFormat = $this->movieFormat->findOrFail($id);
        $movieFormat->fill($data);
        $movieFormat->save();

        return $movieFormat;
    }

    public function show($id)
    {
        return $this->movieFormat->findOrFail($id);
    }
}