<?php

namespace App\Repositories;

use App\Models\Schedule;
use App\Repositories\Interfaces\ScheduleInterface;

class ScheduleRepository implements ScheduleInterface
{
    protected $schedule;

    public function __construct(Schedule $schedule)
    {
        $this->schedule = $schedule;
    }

    public function store($data)
    {
        return $this->schedule->create($data);
    }

    public function update($data, $id)
    {
        $schedule = $this->schedule->findOrFail($id);
        $schedule->fill($data);
        $schedule->save();

        return $schedule;
    }

    public function show($id)
    {
        return $this->schedule->findOrFail($id);
    }
}