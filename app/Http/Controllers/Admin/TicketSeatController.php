<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\TicketSeatRequest;
use App\Http\Services\Admin\TicketSeatService;

class TicketSeatController extends BaseController
{
    public function __construct(TicketSeatService $ticketSeatService)
    {
        $this->service = $ticketSeatService;
    }

    public function store(TicketSeatRequest $request)
    {
        return $this->service->store($request);
    }

    public function update(TicketSeatRequest $request, $id)
    {
        return $this->service->update($request, $id);
    }

    public function show($id)
    {
        return $this->service->show($id);
    }
}