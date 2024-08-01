<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\TicketFoodRequest;
use App\Http\Services\TicketFoodService;

class TicketFoodController extends BaseController
{
    public function __construct(TicketFoodService $ticketFoodService)
    {
        $this->service = $ticketFoodService;
    }

    public function store(TicketFoodRequest $request)
    {
        return $this->service->store($request);
    }

    public function update(TicketFoodRequest $request, $id)
    {
        return $this->service->update($request, $id);
    }

    public function show($id)
    {
        return $this->service->show($id);
    }
}