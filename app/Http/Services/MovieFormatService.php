<?php

namespace App\Http\Services;

use App\Enums\StatusCode;
use App\Http\Services\BaseService;
use App\Models\MovieFormat;
use App\Repositories\Interfaces\MovieFormatInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieFormatService extends BaseService
{
    protected $movieFormat;

    public function __construct(MovieFormatInterface $movieFormat)
    {
        $this->movieFormat = $movieFormat;
        parent::__construct();
    }

    public function setModel()
    {
        $this->model = new MovieFormat();
    }

    protected function setQuery()
    {
        $this->query = $this->model->query();
    }

    public function applyFilter()
    {
        $search = trim($this->request->get('search'));

        if ($search) {
            $this->query->where('name', 'like', '%' . $search . '%');
        }

        $this->applySorting();
    }

    public function applySorting()
    {
        $column = $this->request->get('column');
        $sortBy = $this->request->get('sort_by') ?? 'DESC';

        $allowedColumns = ['id', 'name'];

        if ($column && in_array($column, $allowedColumns)) {
            $this->query->orderBy($column, $sortBy);
        }
    }

    public function store(Request $request)
    {
        $data = $request->only($this->model->getFillable());

        try {
            DB::beginTransaction();
            $movieFormat = $this->movieFormat->store($data);
            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $movieFormat,
                'message' => 'Movie format created successfully'
            ], StatusCode::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to create movie format',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->only($this->model->getFillable());

        try {
            DB::beginTransaction();
            $movieFormat = $this->movieFormat->update($data, $id);
            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $movieFormat,
                'message' => 'Movie format updated successfully'
            ], StatusCode::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to update movie format',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $movieFormat = $this->movieFormat->show($id);

            return response()->json([
                'success' => true,
                'data' => $movieFormat,
                'message' => 'Movie format retrieved successfully'
            ], StatusCode::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Movie format not found',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_NOT_FOUND);
        }
    }
}