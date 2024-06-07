<?php

namespace App\Repositories\Interfaces;

interface PersonMovieInterface
{
    public function store($data);

    public function update($data, $id);

    public function show($id);
}