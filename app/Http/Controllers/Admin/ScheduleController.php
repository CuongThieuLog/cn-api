<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\ScheduleRequest;
use App\Http\Services\Admin\ScheduleService;

class ScheduleController extends BaseController
{
    public function __construct(ScheduleService $scheduleService)
    {
        $this->service = $scheduleService;
    }

    public function store(ScheduleRequest $request)
    {
        return $this->service->store($request);
    }

    public function update(ScheduleRequest $request, $id)
    {
        return $this->service->update($request, $id);
    }

    public function show($id)
    {
        return $this->service->show($id);
    }
}