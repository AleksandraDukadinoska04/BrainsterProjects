<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Connection;

class ConnectionsController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $connection = Connection::create([
            'user_id' => Auth::id(),
            'friend_id' => $request->user_id,
            'status' => 'pending'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Connection created successfully!',
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id',
            'status' => 'required|in:accepted,declined'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $connection = Connection::find($id);

        if (!$connection) {
            return response()->json(['success' => false, 'message' => 'Connection not found'], 404);
        }
        if ($connection->friend_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'You cannot update this connection!'], 404);
        }

        $connection->update([
            'status' => $request->status
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Connection updated successfully!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $connection = Connection::find($id);

        if (!$connection) {
            return response()->json(['success' => false, 'message' => 'Connection not found'], 404);
        }

        if ($connection->user_id !== Auth::id() && $connection->friend_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'You cannot remove this connection!'], 404);
        }

        $connection->delete();

        return response()->json(['success' => true, 'message' => 'Connection removed successfully']);
    }
}
