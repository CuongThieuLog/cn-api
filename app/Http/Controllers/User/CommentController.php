<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Requests\CommentRequest;
use App\Http\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends BaseController
{
    public function __construct(CommentService $comment)
    {
        $this->service = $comment;
    }

    public function store(CommentRequest $request)
    {
        return $this->service->store($request);
    }

    public function update(CommentRequest $request, $id)
    {
        return $this->service->update($request, $id);
    }

    public function show($id)
    {
        return $this->service->show($id);
    }

    public function storeReply(Request $request, $commentId)
    {
        return $this->service->storeReply($request, $commentId);
    }

    public function showReplies($commentId)
    {
        return $this->service->showReplies($commentId);
    }
}