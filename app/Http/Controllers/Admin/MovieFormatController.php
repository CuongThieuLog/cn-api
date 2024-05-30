<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\MovieFormatRequest;
use App\Http\Services\Admin\MovieFormatService;

class MovieFormatController extends BaseController
{
    public function __construct(MovieFormatService $movieFormatService)
    {
        $this->service = $movieFormatService;
    }

    public function store(MovieFormatRequest $request)
    {
        return $this->service->store($request);
    }

    public function update(MovieFormatRequest $request, $id)
    {
        return $this->service->update($request, $id);
    }

    public function show($id)
    {
        return $this->service->show($id);
    }
}