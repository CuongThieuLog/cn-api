<?php

namespace App\Repositories\Interfaces;

interface FoodInterface
{
    public function store($data);

    public function update($data, $id);

    public function show($id);
}