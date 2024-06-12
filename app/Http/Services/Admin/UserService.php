<?php

namespace App\Http\Services\Admin;

use App\Enums\StatusCode;
use App\Http\Services\BaseService;
use App\Models\User;
use App\Repositories\Interfaces\UserInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserService extends BaseService
{
    protected $user;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
        parent::__construct();
    }

    public function setModel()
    {
        $this->model = new User();
    }

    protected function setQuery()
    {
        $this->query = $this->model->query();
    }

    public function applyFilter()
    {
        $search = $this->request->get('search');

        if ($search) {
            $this->query->where(['name' => $search]);
        }
    }

    public function store(Request $request)
    {
        $data = $request->only($this->model->getFillable());

        try {
            DB::beginTransaction();
            $user = $this->user->store($data);
            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $user,
                'message' => 'User created successfully'
            ], StatusCode::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to create user',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->only($this->model->getFillable());

        try {
            DB::beginTransaction();
            $user = $this->user->update($data, $id);
            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $user,
                'message' => 'User updated successfully'
            ], StatusCode::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to update user',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $user = $this->user->show($id);

            return response()->json([
                'success' => true,
                'data' => $user,
                'message' => 'User retrieved successfully'
            ], StatusCode::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_NOT_FOUND);
        }
    }
}