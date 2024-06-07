<?php

namespace App\Repositories;

use App\Models\Person;
use App\Repositories\Interfaces\PersonInterface;

class PersonRepository implements PersonInterface
{
    protected $person;

    public function __construct(Person $person)
    {
        $this->person = $person;
    }

    public function store($data)
    {
        return $this->person->create($data);
    }

    public function update($data, $id)
    {
        $person = $this->person->findOrFail($id);
        $person->fill($data);
        $person->save();

        return $person;
    }

    public function show($id)
    {
        return $this->person->findOrFail($id);
    }
}