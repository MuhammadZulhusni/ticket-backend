<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $tickets = Ticket::latest()->get();
        return response()->json(['data' => $tickets]);
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high,urgent',
            'status' => 'required|in:open,in_progress,resolved,closed',
            'requester_name' => 'required|string|max:255',
            'requester_email' => 'required|email|max:255',
        ]);

        $ticket = Ticket::create($validated);

        return response()->json(['data' => $ticket], 201);
    }

    // Display the specified resource.
    public function show(string $id)
    {
        $ticket = Ticket::findOrFail($id);
        return response()->json(['data' => $ticket]);
    }

    // Update the specified resource in storage.
    public function update(Request $request, string $id)
    {
        $ticket = Ticket::findOrFail($id);

        $validated = $request->validate([
            'subject' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'priority' => 'sometimes|in:low,medium,high,urgent',
            'status' => 'sometimes|in:open,in_progress,resolved,closed',
            'requester_name' => 'sometimes|string|max:255',
            'requester_email' => 'sometimes|email|max:255',
        ]);

        $ticket->update($validated);

        return response()->json(['data' => $ticket]);
    }

    // Remove the specified resource from storage.
    public function destroy(string $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return response()->json(['message' => 'Ticket deleted successfully']);
    }
}