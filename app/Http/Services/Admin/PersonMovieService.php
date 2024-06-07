<?php

namespace App\Http\Services\Admin;

use App\Enums\StatusCode;
use App\Http\Services\BaseService;
use App\Models\PersonMovie;
use App\Repositories\Interfaces\PersonMovieInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonMovieService extends BaseService
{
    protected $personMovie;

    public function __construct(PersonMovieInterface $personMovie)
    {
        $this->personMovie = $personMovie;
        parent::__construct();
    }

    public function setModel()
    {
        $this->model = new PersonMovie();
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
            $personMovie = $this->personMovie->store($data);
            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $personMovie,
                'message' => 'Person movie created successfully'
            ], StatusCode::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to create person movie',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->only($this->model->getFillable());

        try {
            DB::beginTransaction();
            $personMovie = $this->personMovie->update($data, $id);
            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $personMovie,
                'message' => 'Person movie updated successfully'
            ], StatusCode::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to update person movie',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $personMovie = $this->personMovie->show($id);

            return response()->json([
                'success' => true,
                'data' => $personMovie,
                'message' => 'Person movie retrieved successfully'
            ], StatusCode::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Person movie not found',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_NOT_FOUND);
        }
    }
}