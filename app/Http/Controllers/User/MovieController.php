<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Requests\MovieRequest;
use App\Http\Services\MovieService;

class MovieController extends BaseController
{
    public function __construct(MovieService $movieService)
    {
        $this->service = $movieService;
    }

    public function store(MovieRequest $request)
    {
        return $this->service->store($request);
    }

    public function update(MovieRequest $request, $id)
    {
        return $this->service->update($request, $id);
    }

    public function show($id)
    {
        return $this->service->show($id);
    }
}