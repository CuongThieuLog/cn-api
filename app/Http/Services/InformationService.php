<?php

namespace App\Http\Services;

use App\Enums\StatusCode;
use App\Http\Services\BaseService;
use App\Models\Information;
use App\Repositories\Interfaces\InformationInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InformationService extends BaseService
{
    protected $information;

    public function __construct(InformationInterface $information)
    {
        $this->information = $information;
        parent::__construct();
    }

    public function setModel()
    {
        $this->model = new Information();
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
            $information = $this->information->store($data);
            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $information,
                'message' => 'Information created successfully'
            ], StatusCode::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to create information',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->only($this->model->getFillable());

        try {
            DB::beginTransaction();
            $information = $this->information->update($data, $id);
            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $information,
                'message' => 'Information updated successfully'
            ], StatusCode::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to update information',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $information = $this->information->show($id);

            return response()->json([
                'success' => true,
                'data' => $information,
                'message' => 'Information retrieved successfully'
            ], StatusCode::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Information not found',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_NOT_FOUND);
        }
    }
}