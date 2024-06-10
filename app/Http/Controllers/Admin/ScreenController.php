<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\ScreenRequest;
use App\Http\Services\Admin\ScreenService;

class ScreenController extends BaseController
{
    public function __construct(ScreenService $screenService)
    {
        $this->service = $screenService;
    }

    public function store(ScreenRequest $request)
    {
        return $this->service->store($request);
    }

    public function update(ScreenRequest $request, $id)
    {
        return $this->service->update($request, $id);
    }

    public function show($id)
    {
        return $this->service->show($id);
    }
}