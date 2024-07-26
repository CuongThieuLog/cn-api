<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Repositories\Interfaces\CommentInterface;

class CommentRepository implements CommentInterface
{
    protected $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function store($data)
    {
        return $this->comment->create($data);
    }

    public function update($data, $id)
    {
        $comment = $this->comment->findOrFail($id);
        $comment->fill($data);
        $comment->save();

        return $comment;
    }

    public function show($id)
    {
        return $this->comment->findOrFail($id);
    }

    public function storeReply($data, $parentId)
    {
        $parentComment = $this->comment->findOrFail($parentId);
        $reply = $parentComment->replies()->create($data);

        return $reply;
    }

    public function getReplies($parentId)
    {
        $parentComment = $this->comment->findOrFail($parentId);

        return $parentComment->replies;
    }
}