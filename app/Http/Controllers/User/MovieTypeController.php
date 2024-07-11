<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Requests\MovieTypeRequest;
use App\Http\Services\MovieTypeService;

class MovieTypeController extends BaseController
{
    public function __construct(MovieTypeService $movieTypeService)
    {
        $this->service = $movieTypeService;
    }

    public function store(MovieTypeRequest $request)
    {
        return $this->service->store($request);
    }

    public function update(MovieTypeRequest $request, $id)
    {
        return $this->service->update($request, $id);
    }

    public function show($id)
    {
        return $this->service->show($id);
    }
}