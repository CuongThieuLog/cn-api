<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\InformationRequest;
use App\Http\Services\InformationService;

class MovieFormatController extends BaseController
{
    public function __construct(InformationService $informationService)
    {
        $this->service = $informationService;
    }

    public function store(InformationRequest $request)
    {
        return $this->service->store($request);
    }

    public function update(InformationRequest $request, $id)
    {
        return $this->service->update($request, $id);
    }

    public function show($id)
    {
        return $this->service->show($id);
    }
}