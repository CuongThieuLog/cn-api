<?php

namespace App\Http\Services;

use App\Enums\StatusCode;
use App\Http\Services\BaseService;
use App\Models\Movie;
use App\Repositories\Interfaces\MovieInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieService extends BaseService
{
    protected $movie;
    protected $cloudinary;

    public function __construct(MovieInterface $movie, CloudinaryService $cloudinary)
    {
        $this->movie = $movie;
        $this->cloudinary = $cloudinary;
        parent::__construct();
    }

    public function setModel()
    {
        $this->model = new Movie();
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
            $fileResponse = $this->cloudinary->uploadFile($request, 'Trailer movie');
            $fileResponseData = $fileResponse->getData(true);

            $data['trailer_movie'] = $fileResponseData['url'];

            $movie = $this->movie->store($data);
            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $movie,
                'message' => 'Movie created successfully'
            ], StatusCode::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to create movie',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->only($this->model->getFillable());

        try {
            DB::beginTransaction();
            $movie = $this->movie->update($data, $id);
            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $movie,
                'message' => 'Movie updated successfully'
            ], StatusCode::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to update movie',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $movie = $this->movie->show($id);

            return response()->json([
                'success' => true,
                'data' => $movie,
                'message' => 'Movie retrieved successfully'
            ], StatusCode::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Movie not found',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_NOT_FOUND);
        }
    }
}