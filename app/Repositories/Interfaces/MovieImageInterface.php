<?php

namespace App\Repositories\Interfaces;

interface MovieImageInterface
{
    public function storeMultiple($data);

    public function updateMultiple($data, $id);
}