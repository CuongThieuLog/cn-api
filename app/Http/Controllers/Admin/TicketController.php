<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\TicketRequest;
use App\Http\Services\Admin\TicketService;

class TicketController extends BaseController
{
    public function __construct(TicketService $ticketController)
    {
        $this->service = $ticketController;
    }

    public function store(TicketRequest $request)
    {
        return $this->service->store($request);
    }

    public function update(TicketRequest $request, $id)
    {
        return $this->service->update($request, $id);
    }

    public function show($id)
    {
        return $this->service->show($id);
    }
}