<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recommendation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class RecomendationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recommendations = Recommendation::orderBy('created_at', 'desc')->paginate(10);
        return view('AdminPanel.Recommendations.recommendations', compact('recommendations'));
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
            'recommendation' => 'required|string|max:1500',
            'for_user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $recommendation = Recommendation::create([
            'from_user_id' => Auth::id(),
            'for_user_id' => $request->for_user_id,
            'content' => $request->recommendation
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Comment created successfully!',
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
            'recommendation' => 'required|string|max:1500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $recommendation = Recommendation::find($id);

        if (!$recommendation) {
            return response()->json(['success' => false, 'message' => 'Recommendation not found'], 404);
        }
        if ($recommendation->from_user_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'You cannot update this recommendation!'], 404);
        }

        $recommendation->update($request->except('_token'));

        return response()->json([
            'success' => true,
            'message' => 'Event updated successfully!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $recommendation = Recommendation::find($id);

        if (!$recommendation) {
            return response()->json(['success' => false, 'message' => 'Recommendation not found'], 404);
        }
        if (Auth::user()->role->name !== 'admin') {
            if ($recommendation->from_user_id !== Auth::id() || $recommendation->for_user_id !== Auth::id()) {
                return response()->json(['success' => false, 'message' => 'You cannot delete this feedback!'], 404);
            }
        }
        $recommendation->delete();

        return response()->json(['success' => true, 'message' => 'Recommendation deleted successfully']);
    }

    public function search(Request $request)
    {

        $search = strtolower(trim($request->input('search')));

        $recommendations = Recommendation::where('content', 'LIKE', "%{$search}%")
            ->orWhereHas('fromUser', function ($query) use ($search) {
                $query->whereRaw("CONCAT(name, ' ', surname) LIKE ?", ["%{$search}%"]);
            })
            ->orWhereHas('forUser', function ($query) use ($search) {
                $query->whereRaw("CONCAT(name, ' ', surname) LIKE ?", ["%{$search}%"]);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('AdminPanel.Recommendations.partials.recommendations_table', compact('recommendations'))->render();
    }
}
