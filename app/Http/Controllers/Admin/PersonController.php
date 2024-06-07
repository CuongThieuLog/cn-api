<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\PersonRequest;
use App\Http\Services\Admin\PersonService;

class PersonController extends BaseController
{
    public function __construct(PersonService $personService)
    {
        $this->service = $personService;
    }

    public function store(PersonRequest $request)
    {
        return $this->service->store($request);
    }

    public function update(PersonRequest $request, $id)
    {
        return $this->service->update($request, $id);
    }

    public function show($id)
    {
        return $this->service->show($id);
    }
}