<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;



class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feedbacks = Feedback::orderBy('created_at', 'desc')->paginate(10);
        return view('AdminPanel.Feedbacks.feedbacks', compact('feedbacks'));
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
            'feedback' => 'required|string|max:1500',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $feedback = Feedback::create([
            'user_id' => Auth::id(),
            'content' => $request->feedback,

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
            'feedback' => 'required|string|max:1500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $feedback = Feedback::find($id);

        if (!$feedback) {
            return response()->json(['success' => false, 'message' => 'Feedback not found'], 404);
        }
        if ($feedback->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'You cannot update this feedback!'], 404);
        }

        $feedback->update($request->except('_token'));

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

        $feedback = Feedback::find($id);

        if (!$feedback) {
            return response()->json(['success' => false, 'message' => 'Feedback not found'], 404);
        }

        if (Auth::user()->role->name !== 'admin') {
            if ($feedback->user_id !== Auth::id()) {
                return response()->json(['success' => false, 'message' => 'You cannot delete this feedback!'], 404);
            }
        }

        $feedback->delete();

        return response()->json(['success' => true, 'message' => 'Feedback deleted successfully']);
    }

    public function search(Request $request)
    {

        $search = strtolower(trim($request->input('search')));

        $feedbacks = Feedback::join('users', 'feedback.user_id', '=', 'users.id')
            ->where('feedback.content', 'LIKE', "%{$search}%")
            ->orWhere(DB::raw("CONCAT(users.name, ' ', users.surname)"), 'LIKE', "%{$search}%")
            ->select('feedback.*')
            ->with('user')
            ->paginate(10);


        return view('AdminPanel.Feedbacks.partials.feedbacks_table', compact('feedbacks'))->render();
    }
}
