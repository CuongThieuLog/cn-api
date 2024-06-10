<?php

namespace App\Repositories\Interfaces;

interface ScreenInterface
{
    public function store($data);

    public function update($data, $id);

    public function show($id);
}