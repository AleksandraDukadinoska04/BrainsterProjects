<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;



class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $event_id)
    {
        return view('AdminPanel.Tickets.create', compact('event_id'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_id' => 'required|exists:events,id',
            'ticket_type' => 'required|in:person,company',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'seats' => 'required|integer',
            'pauses' => 'nullable|string|max:1500',
            'wifi' => 'nullable|bool'

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $ticket = Ticket::create($request->except('_token'));

        return response()->json([
            'success' => true,
            'message' => 'Ticket created successfully!',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ticket = Ticket::find($id);
        if (!$ticket) {
            return redirect()->back();
        }
        return view('AdminPanel.Tickets.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'ticket_type' => 'required|in:person,company',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'seats' => 'required|integer',
            'pauses' => 'nullable|string|max:1500',
            'wifi' => 'nullable|bool'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $ticket = Ticket::find($id);

        if (!$ticket) {
            return response()->json(['success' => false, 'message' => 'Ticket not found'], 404);
        }

        $ticket->update($request->except('_token'));

        return response()->json([
            'success' => true,
            'message' => 'Ticket updated successfully!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ticket = Ticket::find($id);

        if (!$ticket) {
            return response()->json(['success' => false, 'message' => 'Ticket not found'], 404);
        }

        $ticket->delete();

        return response()->json(['success' => true, 'message' => 'Ticket deleted successfully']);
    }
}
