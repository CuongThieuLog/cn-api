<?php

namespace App\Http\Services\Admin;

use App\Enums\StatusCode;
use App\Http\Services\BaseService;
use App\Models\Ticket;
use App\Repositories\Interfaces\TicketInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketService extends BaseService
{
    protected $ticket;

    public function __construct(TicketInterface $ticket)
    {
        $this->ticket = $ticket;
        parent::__construct();
    }

    public function setModel()
    {
        $this->model = new Ticket();
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
            $ticket = $this->ticket->store($data);
            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $ticket,
                'message' => 'Ticket created successfully'
            ], StatusCode::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to create ticket',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->only($this->model->getFillable());

        try {
            DB::beginTransaction();
            $ticket = $this->ticket->update($data, $id);
            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $ticket,
                'message' => 'Ticket updated successfully'
            ], StatusCode::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to update ticket',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $ticket = $this->ticket->show($id);

            return response()->json([
                'success' => true,
                'data' => $ticket,
                'message' => 'Ticket retrieved successfully'
            ], StatusCode::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ticket not found',
                'error' => $e->getMessage()
            ], StatusCode::HTTP_NOT_FOUND);
        }
    }
}