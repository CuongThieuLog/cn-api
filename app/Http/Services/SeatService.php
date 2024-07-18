<?php

namespace App\Http\Services;

use App\Enums\StatusCode;
use App\Http\Services\BaseService;
use App\Models\Seat;
use App\Repositories\Interfaces\SeatInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeatService extends BaseService
{
    protected $seat;

    public function __construct(SeatInterface $seat)
    {
        $this->seat = $seat;
        parent::__construct();
    }

    public function setModel()
    {
        $this->model = new Seat();
    }

    protected function setQuery()
    {
        $this->query = $this->model->query();
    }

    public function store(Request $request)
    {
        $data = $request->only($this->model->getFillable());

        try {
            DB::beginTransaction();
            $seat = $this->seat->store($data);
            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $seat,
                'message' => 'Seat created successfully'
            ], StatusCode::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to create seat',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->only($this->model->getFillable());

        try {
            DB::beginTransaction();
            $seat = $this->seat->update($data, $id);
            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $seat,
                'message' => 'Seat updated successfully'
            ], StatusCode::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to update seat',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $seat = $this->seat->show($id);

            return response()->json([
                'success' => true,
                'data' => $seat,
                'message' => 'Seat retrieved successfully'
            ], StatusCode::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Seat not found',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_NOT_FOUND);
        }
    }
}