<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected $service;

    public function index(Request $request)
    {
        return $this->service->index($request);
    }

    public function destroy(Request $request, $id)
    {
        return $this->service->destroy($request, $id);
    }
}