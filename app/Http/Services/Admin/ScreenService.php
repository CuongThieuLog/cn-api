<?php

namespace App\Http\Services\Admin;

use App\Enums\StatusCode;
use App\Http\Services\BaseService;
use App\Models\Screen;
use App\Repositories\Interfaces\ScreenInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScreenService extends BaseService
{
    protected $screen;

    public function __construct(ScreenInterface $screen)
    {
        $this->screen = $screen;
        parent::__construct();
    }

    public function setModel()
    {
        $this->model = new Screen();
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
            $screen = $this->screen->store($data);
            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $screen,
                'message' => 'Screen created successfully'
            ], StatusCode::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to create screen',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->only($this->model->getFillable());

        try {
            DB::beginTransaction();
            $screen = $this->screen->update($data, $id);
            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $screen,
                'message' => 'Screen updated successfully'
            ], StatusCode::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to update screen',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $screen = $this->screen->show($id);

            return response()->json([
                'success' => true,
                'data' => $screen,
                'message' => 'Screen retrieved successfully'
            ], StatusCode::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Screen not found',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_NOT_FOUND);
        }
    }
}