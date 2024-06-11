<?php

namespace App\Http\Services\Admin;

use App\Enums\StatusCode;
use App\Http\Services\BaseService;
use App\Models\Food;
use App\Repositories\Interfaces\FoodInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FoodService extends BaseService
{
    protected $food;

    public function __construct(FoodInterface $food)
    {
        $this->food = $food;
        parent::__construct();
    }

    public function setModel()
    {
        $this->model = new Food();
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
            $food = $this->food->store($data);
            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $food,
                'message' => 'Food created successfully'
            ], StatusCode::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to create food',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->only($this->model->getFillable());

        try {
            DB::beginTransaction();
            $food = $this->food->update($data, $id);
            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $food,
                'message' => 'Food updated successfully'
            ], StatusCode::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to update food',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $food = $this->food->show($id);

            return response()->json([
                'success' => true,
                'data' => $food,
                'message' => 'Food retrieved successfully'
            ], StatusCode::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Food not found',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_NOT_FOUND);
        }
    }
}