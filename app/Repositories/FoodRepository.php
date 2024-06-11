<?php

namespace App\Repositories;

use App\Models\Food;
use App\Repositories\Interfaces\FoodInterface;

class FoodRepository implements FoodInterface
{
    protected $food;

    public function __construct(Food $food)
    {
        $this->food = $food;
    }

    public function store($data)
    {
        return $this->food->create($data);
    }

    public function update($data, $id)
    {
        $food = $this->food->findOrFail($id);
        $food->fill($data);
        $food->save();

        return $food;
    }

    public function show($id)
    {
        return $this->food->findOrFail($id);
    }
}