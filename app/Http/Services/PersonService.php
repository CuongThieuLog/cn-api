<?php

namespace App\Http\Services;

use App\Enums\StatusCode;
use App\Http\Services\BaseService;
use App\Models\Person;
use App\Repositories\Interfaces\PersonInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonService extends BaseService
{
    protected $person;

    public function __construct(PersonInterface $person)
    {
        $this->person = $person;
        parent::__construct();
    }

    public function setModel()
    {
        $this->model = new Person();
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
            $person = $this->person->store($data);
            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $person,
                'message' => 'Person created successfully'
            ], StatusCode::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to create person',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->only($this->model->getFillable());

        try {
            DB::beginTransaction();
            $person = $this->person->update($data, $id);
            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $person,
                'message' => 'Person updated successfully'
            ], StatusCode::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to update person',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $person = $this->person->show($id);

            return response()->json([
                'success' => true,
                'data' => $person,
                'message' => 'Person retrieved successfully'
            ], StatusCode::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Person not found',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_NOT_FOUND);
        }
    }
}