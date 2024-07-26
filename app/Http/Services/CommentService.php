<?php

namespace App\Http\Services;

use App\Enums\StatusCode;
use App\Http\Services\BaseService;
use App\Models\Comment;
use App\Repositories\Interfaces\CommentInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $user = Auth::user();
        $data = $request->only($this->model->getFillable());

        try {
            DB::beginTransaction();
            $data['user_id'] = $user->id;

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
        $user = Auth::user();
        $data = $request->only($this->model->getFillable());

        try {
            DB::beginTransaction();
            $data['user_id'] = $user->id;
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

    public function storeReply(Request $request, $commentId)
    {
        $user = Auth::user();
        $data = $request->only([
            'content', 
            'star', 
            'feeling', 
            'image'
        ]);

        try {
            DB::beginTransaction();
            $data['user_id'] = $user->id;
            $reply = $this->comment->storeReply($data, $commentId);
            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $reply,
                'message' => 'Reply created successfully'
            ], StatusCode::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to create reply',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function showReplies($commentId)
    {
        try {
            $replies = $this->comment->getReplies($commentId);

            return response()->json([
                'success' => true,
                'data' => $replies,
                'message' => 'Replies retrieved successfully'
            ], StatusCode::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Replies not found',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_NOT_FOUND);
        }
    }
}