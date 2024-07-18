<?php

namespace App\Http\Services;

use App\Enums\StatusCode;
use App\Http\Services\BaseService;
use App\Models\Schedule;
use App\Repositories\Interfaces\ScheduleInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleService extends BaseService
{
    protected $schedule;

    public function __construct(ScheduleInterface $schedule)
    {
        $this->schedule = $schedule;
        parent::__construct();
    }

    public function setModel()
    {
        $this->model = new Schedule();
    }

    protected function setQuery()
    {
        $this->query = $this->model->query();
    }

    public function applyFilter()
    {
        $name = $this->request->get('name');

        if ($name) {
            $this->query->where(['name' => $name]);
        }
    }

    public function store(Request $request)
    {
        $data = $request->only($this->model->getFillable());

        try {
            DB::beginTransaction();
            $schedule = $this->schedule->store($data);
            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $schedule,
                'message' => 'Schedule created successfully'
            ], StatusCode::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to create schedule',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->only($this->model->getFillable());

        try {
            DB::beginTransaction();
            $schedule = $this->schedule->update($data, $id);
            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $schedule,
                'message' => 'Schedule updated successfully'
            ], StatusCode::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to update schedule',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $schedule = $this->schedule->show($id);

            return response()->json([
                'success' => true,
                'data' => $schedule,
                'message' => 'Schedule retrieved successfully'
            ], StatusCode::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Schedule not found',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_NOT_FOUND);
        }
    }
}