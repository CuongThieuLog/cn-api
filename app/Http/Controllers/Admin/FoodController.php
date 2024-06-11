<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\FoodRequest;
use App\Http\Services\Admin\FoodService;

class FoodController extends BaseController
{
    public function __construct(FoodService $food)
    {
        $this->service = $food;
    }

    public function store(FoodRequest $request)
    {
        return $this->service->store($request);
    }

    public function update(FoodRequest $request, $id)
    {
        return $this->service->update($request, $id);
    }

    public function show($id)
    {
        return $this->service->show($id);
    }
}