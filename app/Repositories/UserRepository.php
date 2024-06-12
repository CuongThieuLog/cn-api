<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserInterface;

class UserRepository implements UserInterface
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function store($data)
    {
        return $this->user->create($data);
    }

    public function update($data, $id)
    {
        $user = $this->user->findOrFail($id);
        $user->fill($data);
        $user->save();

        return $user;
    }

    public function show($id)
    {
        return $this->user->findOrFail($id);
    }
}