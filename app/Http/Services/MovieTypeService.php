<?php

namespace App\Http\Services;

use App\Enums\StatusCode;
use App\Http\Services\BaseService;
use App\Models\MovieType;
use App\Repositories\Interfaces\MovieTypeInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieTypeService extends BaseService
{
    protected $movieType;

    public function __construct(MovieTypeInterface $movieType)
    {
        $this->movieType = $movieType;
        parent::__construct();
    }

    public function setModel()
    {
        $this->model = new MovieType();
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
            $movieType = $this->movieType->store($data);
            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $movieType,
                'message' => 'Movie type created successfully'
            ], StatusCode::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to create movie type',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->only($this->model->getFillable());

        try {
            DB::beginTransaction();
            $movieType = $this->movieType->update($data, $id);
            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $movieType,
                'message' => 'Movie type updated successfully'
            ], StatusCode::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to update movie type',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $movieType = $this->movieType->show($id);

            return response()->json([
                'success' => true,
                'data' => $movieType,
                'message' => 'Movie type retrieved successfully'
            ], StatusCode::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Movie type not found',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_NOT_FOUND);
        }
    }
}