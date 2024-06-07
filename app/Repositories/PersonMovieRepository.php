<?php

namespace App\Repositories;

use App\Models\PersonMovie;
use App\Repositories\Interfaces\PersonMovieInterface;

class PersonMovieRepository implements PersonMovieInterface
{
    protected $personMovie;

    public function __construct(PersonMovie $personMovie)
    {
        $this->personMovie = $personMovie;
    }

    public function store($data)
    {
        return $this->personMovie->create($data);
    }

    public function update($data, $id)
    {
        $personMovie = $this->personMovie->findOrFail($id);
        $personMovie->fill($data);
        $personMovie->save();

        return $personMovie;
    }

    public function show($id)
    {
        return $this->personMovie->findOrFail($id);
    }
}