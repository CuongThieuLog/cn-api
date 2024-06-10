<?php

namespace App\Repositories;

use App\Models\Screen;
use App\Repositories\Interfaces\ScreenInterface;

class ScreenRepository implements ScreenInterface
{
    protected $screen;

    public function __construct(Screen $screen)
    {
        $this->screen = $screen;
    }

    public function store($data)
    {
        return $this->screen->create($data);
    }

    public function update($data, $id)
    {
        $screen = $this->screen->findOrFail($id);
        $screen->fill($data);
        $screen->save();

        return $screen;
    }

    public function show($id)
    {
        return $this->screen->findOrFail($id);
    }
}