<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TicketController extends Controller
{
    // Read all: GET /api/tickets
    public function index()
    {
        $tickets = Ticket::latest()->get();
        return response()->json(['data' => $tickets]);
    }

    // Create: POST /api/tickets
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject'         => 'required|string|max:255',
            'requester_name'  => 'required|string|max:255',
            'requester_email' => 'required|email|max:255',
            'status'          => ['required', Rule::in(['open', 'in_progress', 'resolved', 'closed'])],
            'priority'        => ['required', Rule::in(['low', 'medium', 'high', 'urgent'])],
            'description'     => 'required|string',
        ]);

        $ticket = Ticket::create($validated);
        return response()->json(['data' => $ticket], 201);
    }

    // Read one/specific ID: GET /api/tickets/{id}
    public function show(Ticket $ticket)
    {
        return response()->json(['data' => $ticket]);
    }

    // Update: PUT /api/tickets/{id}
    public function update(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'subject'         => 'sometimes|required|string|max:255',
            'requester_name'  => 'sometimes|required|string|max:255',
            'requester_email' => 'sometimes|required|email|max:255',
            'status'          => ['sometimes', Rule::in(['open', 'in_progress', 'resolved', 'closed'])],
            'priority'        => ['sometimes', Rule::in(['low', 'medium', 'high', 'urgent'])],
            'description'     => 'sometimes|required|string',
        ]);

        $ticket->update($validated);
        return response()->json(['data' => $ticket]);
    }

    // Delete: DELETE /api/tickets/{id}
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}