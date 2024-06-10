<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\CinemaRequest;
use App\Http\Services\Admin\CinemaService;

class CinemaController extends BaseController
{
    public function __construct(CinemaService $cinema)
    {
        $this->service = $cinema;
    }

    public function store(CinemaRequest $request)
    {
        return $this->service->store($request);
    }

    public function update(CinemaRequest $request, $id)
    {
        return $this->service->update($request, $id);
    }

    public function show($id)
    {
        return $this->service->show($id);
    }
}