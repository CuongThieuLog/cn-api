<?php

namespace App\Http\Services;

use App\Enums\StatusCode;
use App\Http\Services\BaseService;
use App\Models\Comment;
use App\Repositories\Interfaces\CommentInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentService extends BaseService
{
    protected $comment;

    public function __construct(CommentInterface $comment)
    {
        $this->comment = $comment;
        parent::__construct();
    }

    public function setModel()
    {
        $this->model = new Comment();
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
            $comment = $this->comment->store($data);
            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $comment,
                'message' => 'Comment created successfully'
            ], StatusCode::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to create comment',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->only($this->model->getFillable());

        try {
            DB::beginTransaction();
            $comment = $this->comment->update($data, $id);
            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $comment,
                'message' => 'Comment updated successfully'
            ], StatusCode::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to update comment',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $comment = $this->comment->show($id);

            return response()->json([
                'success' => true,
                'data' => $comment,
                'message' => 'Comment retrieved successfully'
            ], StatusCode::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Comment not found',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_NOT_FOUND);
        }
    }
}