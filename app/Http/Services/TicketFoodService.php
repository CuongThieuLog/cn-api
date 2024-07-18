<?php

namespace App\Http\Services;

use App\Enums\StatusCode;
use App\Http\Services\BaseService;
use App\Models\TicketFood;
use App\Repositories\Interfaces\TicketFoodInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketFoodService extends BaseService
{
    protected $ticketFood;

    public function __construct(TicketFoodInterface $ticketFood)
    {
        $this->ticketFood = $ticketFood;
        parent::__construct();
    }

    public function setModel()
    {
        $this->model = new TicketFood();
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
            $ticketFood = $this->ticketFood->store($data);
            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $ticketFood,
                'message' => 'Ticket food created successfully'
            ], StatusCode::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to create ticket food',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->only($this->model->getFillable());

        try {
            DB::beginTransaction();
            $ticketFood = $this->ticketFood->update($data, $id);
            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $ticketFood,
                'message' => 'Ticket food updated successfully'
            ], StatusCode::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to update ticket food',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $ticketFood = $this->ticketFood->show($id);

            return response()->json([
                'success' => true,
                'data' => $ticketFood,
                'message' => 'Ticket food retrieved successfully'
            ], StatusCode::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ticket food not found',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_NOT_FOUND);
        }
    }
}