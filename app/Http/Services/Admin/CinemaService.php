<?php

namespace App\Http\Services\Admin;

use App\Enums\StatusCode;
use App\Http\Services\BaseService;
use App\Models\Cinema;
use App\Repositories\Interfaces\CinemaInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CinemaService extends BaseService
{
    protected $cinema;

    public function __construct(CinemaInterface $cinema)
    {
        $this->cinema = $cinema;
        parent::__construct();
    }

    public function setModel()
    {
        $this->model = new Cinema();
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
            $cinema = $this->cinema->store($data);
            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $cinema,
                'message' => 'Cinema created successfully'
            ], StatusCode::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to create cinema',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->only($this->model->getFillable());

        try {
            DB::beginTransaction();
            $cinema = $this->cinema->update($data, $id);
            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $cinema,
                'message' => 'Cinema updated successfully'
            ], StatusCode::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to update cinema',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $cinema = $this->cinema->show($id);

            return response()->json([
                'success' => true,
                'data' => $cinema,
                'message' => 'Cinema retrieved successfully'
            ], StatusCode::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Cinema not found',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_NOT_FOUND);
        }
    }
}