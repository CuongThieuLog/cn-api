<?php

namespace App\Repositories\Interfaces;

interface CommentInterface
{
    public function store($data);

    public function update($data, $id);

    public function show($id);

    public function storeReply($data, $parentId);

    public function getReplies($parentId);
}