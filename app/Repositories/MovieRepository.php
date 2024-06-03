<?php

namespace App\Repositories;

use App\Models\Movie;
use App\Repositories\Interfaces\MovieInterface;

class MovieRepository implements MovieInterface
{
    protected $movie;

    public function __construct(Movie $movie)
    {
        $this->movie = $movie;
    }

    public function store($data)
    {
        return $this->movie->create($data);
    }

    public function update($data, $id)
    {
        $movie = $this->movie->findOrFail($id);
        $movie->fill($data);
        $movie->save();

        return $movie;
    }

    public function show($id)
    {
        return $this->movie->findOrFail($id);
    }
}