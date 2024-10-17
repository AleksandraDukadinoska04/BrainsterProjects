<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Speaker;
use App\Models\EventSpeaker;
use Illuminate\Support\Facades\Validator;



class EventSpeakerController extends Controller
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
        $speakers = Speaker::all();
        return view('AdminPanel.Speakers.EventSpeakers.create', compact('speakers', 'event_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_id' => 'required|exists:events,id',
            'speaker_id' => 'required|exists:speakers,id',
            'speaker_type' => 'required|in:ordinary,special',
            'speaker_invitation' => 'nullable|string|max:1500'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $eventSpeaker = EventSpeaker::create($request->except('_token'));

        return response()->json([
            'success' => true,
            'message' => 'Event Speaker created successfully!',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $eventSpeaker = EventSpeaker::find($id);
        if (!$eventSpeaker) {
            return redirect()->back();
        }
        $speakers = Speaker::all();
        return view('AdminPanel.Speakers.EventSpeakers.edit', compact('eventSpeaker', 'speakers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'speaker_id' => 'required|exists:speakers,id',
            'speaker_type' => 'required|in:ordinary,special',
            'speaker_invitation' => 'nullable|string|max:1500'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $eventSpeaker = EventSpeaker::find($id);

        if (!$eventSpeaker) {
            return response()->json(['success' => false, 'message' => 'Event Speaker not found'], 404);
        }

        $eventSpeaker->update($request->except('_token'));

        return response()->json([
            'success' => true,
            'message' => 'Event Speaker updated successfully!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $eventSpeaker = EventSpeaker::find($id);

        if (!$eventSpeaker) {
            return response()->json(['success' => false, 'message' => 'Event Speaker not found'], 404);
        }

        $eventSpeaker->delete();

        return response()->json(['success' => true, 'message' => 'Event Speaker deleted successfully']);
    }
}
