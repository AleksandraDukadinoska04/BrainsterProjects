<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventTitle;
use Illuminate\Support\Facades\Validator;


class EventTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eventTitles = EventTitle::paginate(10);
        return view('AdminPanel.EventTitles.eventTitles', compact('eventTitles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('AdminPanel.EventTitles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $eventTitle = EventTitle::create($request->except('_token'));

        return response()->json([
            'success' => true,
            'message' => 'Event Title created successfully!',
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
        $eventTitle = EventTitle::find($id);
        if (!$eventTitle) {
            return redirect()->back();
        }
        return view('AdminPanel.EventTitles.edit', compact('eventTitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $eventTitle = EventTitle::find($id);

        if (!$eventTitle) {
            return response()->json(['success' => false, 'message' => 'Event Title not found'], 404);
        }


        $eventTitle->update($request->except('_token'));


        return response()->json([
            'success' => true,
            'message' => 'Event Title updated successfully!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $eventTitle = EventTitle::find($id);

        if (!$eventTitle) {
            return response()->json(['success' => false, 'message' => 'Event Title not found'], 404);
        }

        $eventTitle->delete();

        return response()->json(['success' => true, 'message' => 'Event Title deleted successfully']);
    }

    public function search(Request $request)
    {
        $search = strtolower(trim($request->input('search')));

        $eventTitles = EventTitle::where('title', 'LIKE', "%{$search}%")
            ->paginate(10);

        return view('AdminPanel.EventTitles.partials.eventTitles_table', compact('eventTitles'))->render();
    }
}
