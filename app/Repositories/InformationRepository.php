<?php

namespace App\Repositories;

use App\Models\Information;
use App\Repositories\Interfaces\InformationInterface;

class InformationRepository implements InformationInterface
{
    protected $information;

    public function __construct(Information $information)
    {
        $this->information = $information;
    }

    public function store($data)
    {
        return $this->information->create($data);
    }

    public function update($data, $id)
    {
        $information = $this->information->findOrFail($id);
        $information->fill($data);
        $information->save();

        return $information;
    }

    public function show($id)
    {
        return $this->information->findOrFail($id);
    }
}