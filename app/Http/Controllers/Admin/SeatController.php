<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\SeatRequest;
use App\Http\Services\SeatService;

class SeatController extends BaseController
{
    public function __construct(SeatService $seatService)
    {
        $this->service = $seatService;
    }

    public function store(SeatRequest $request)
    {
        return $this->service->store($request);
    }

    public function update(SeatRequest $request, $id)
    {
        return $this->service->update($request, $id);
    }

    public function show($id)
    {
        return $this->service->show($id);
    }
}