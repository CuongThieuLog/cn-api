<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Requests\PersonMovieRequest;
use App\Http\Services\PersonMovieService;

class PersonMovieController extends BaseController
{
    public function __construct(PersonMovieService $personMovieService)
    {
        $this->service = $personMovieService;
    }

    public function store(PersonMovieRequest $request)
    {
        return $this->service->store($request);
    }

    public function update(PersonMovieRequest $request, $id)
    {
        return $this->service->update($request, $id);
    }

    public function show($id)
    {
        return $this->service->show($id);
    }
}