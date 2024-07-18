<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Services\UserService;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function __construct(UserService $user)
    {
        $this->service = $user;
    }

    public function store(Request $request)
    {
        return $this->service->store($request);
    }

    public function update(Request $request, $id)
    {
        return $this->service->update($request, $id);
    }

    public function show($id)
    {
        return $this->service->show($id);
    }
}