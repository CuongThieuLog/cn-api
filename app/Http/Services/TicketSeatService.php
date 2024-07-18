<?php

namespace App\Http\Services;

use App\Enums\StatusCode;
use App\Http\Services\BaseService;
use App\Models\TicketSeat;
use App\Repositories\Interfaces\TicketSeatInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketSeatService extends BaseService
{
    protected $ticketSeat;

    public function __construct(TicketSeatInterface $ticketSeat)
    {
        $this->ticketSeat = $ticketSeat;
        parent::__construct();
    }

    public function setModel()
    {
        $this->model = new TicketSeat();
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
            $ticketSeat = $this->ticketSeat->store($data);
            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $ticketSeat,
                'message' => 'Ticket seat created successfully'
            ], StatusCode::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to create ticket seat',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->only($this->model->getFillable());

        try {
            DB::beginTransaction();
            $ticketSeat = $this->ticketSeat->update($data, $id);
            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $ticketSeat,
                'message' => 'Ticket seat updated successfully'
            ], StatusCode::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to update ticket seat',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $ticketSeat = $this->ticketSeat->show($id);

            return response()->json([
                'success' => true,
                'data' => $ticketSeat,
                'message' => 'Ticket seat retrieved successfully'
            ], StatusCode::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ticket seat not found',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_NOT_FOUND);
        }
    }
}