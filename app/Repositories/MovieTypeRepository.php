<?php

namespace App\Repositories;

use App\Models\MovieType;
use App\Repositories\Interfaces\MovieTypeInterface;

class MovieTypeRepository implements MovieTypeInterface
{
    protected $movieType;

    public function __construct(MovieType $movieType)
    {
        $this->movieType = $movieType;
    }

    public function store($data)
    {
        return $this->movieType->create($data);
    }

    public function update($data, $id)
    {
        $movieType = $this->movieType->findOrFail($id);
        $movieType->fill($data);
        $movieType->save();

        return $movieType;
    }

    public function show($id)
    {
        return $this->movieType->findOrFail($id);
    }
}