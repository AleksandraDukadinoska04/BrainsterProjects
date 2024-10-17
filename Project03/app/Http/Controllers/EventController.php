<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventTitle;
use App\Models\Agenda;
use App\Models\AgendaDescription;
use App\Models\EventSpeaker;
use App\Models\Ticket;
use Illuminate\Support\Facades\Validator;



class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::orderBy('id', 'desc')->paginate(10);
        $eventTitles = EventTitle::all();
        return view('AdminPanel.Events.events', compact('events', 'eventTitles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $eventTitles = EventTitle::all();
        return view('AdminPanel.Events.create',  compact('eventTitles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title_id' => 'required|exists:event_titles,id',
            'img' => 'nullable|url|max:255',
            'theme' => 'required|string|max:255',
            'description' => 'nullable|string|max:1500',
            'objective' => 'nullable|string|max:1500',
            'location' => 'required|string|max:255',
            'date' => 'required|date'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }
        $storeData = [
            'title_id' => $request->title_id,
            'img' => $request->img,
            'theme' => $request->theme,
            'description' => $request->description,
            'objective' => $request->objective,
            'location' => $request->location,
            'date' => $request->date,
        ];
        if ($request->img === null) {
            $storeData['img'] = 'https://i0.wp.com/www.inspiredpharma.com/wp-content/uploads/2019/06/GDP_symposium-2018-620x349.jpg?resize=620%2C349&ssl=1';
        }

        $event = Event::create($storeData);

        return response()->json([
            'success' => true,
            'message' => 'Event created successfully!',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::find($id);
        if (!$event) {
            return redirect()->back();
        }
        $agendas = Agenda::where('event_id', $id)->orderBy('day', 'ASC')->orderBy('hour', 'ASC')->get();
        $descriptions = AgendaDescription::all();
        $speakers = EventSpeaker::where('event_id', $id)->get();
        $tickets = Ticket::where('event_id', $id)->get();
        $days = Agenda::where('event_id', $id)
            ->select('day')
            ->distinct()
            ->orderBy('day')
            ->get();

        return view('AdminPanel.Events.show', compact('event', 'agendas', 'descriptions', 'speakers', 'tickets', 'days'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = Event::find($id);
        if (!$event) {
            return redirect()->back();
        }
        $eventTitles = EventTitle::all();
        return view('AdminPanel.Events.edit', compact('event', 'eventTitles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title_id' => 'required|exists:event_titles,id',
            'img' => 'nullable|url|max:255',
            'theme' => 'required|string|max:255',
            'description' => 'nullable|string|max:1500',
            'objective' => 'nullable|string|max:1500',
            'location' => 'required|string|max:255',
            'date' => 'required|date',
            'status' => 'required|in:active,completed'

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $event = Event::find($id);

        if (!$event) {
            return response()->json(['success' => false, 'message' => 'Event not found'], 404);
        }

        $updateData = [
            'title_id' => $request->title_id,
            'img' => $request->img,
            'theme' => $request->theme,
            'description' => $request->description,
            'objective' => $request->objective,
            'location' => $request->location,
            'date' => $request->date,
            'status' => $request->status,

        ];
        if ($request->img === null) {
            $updateData['img'] = 'https://i0.wp.com/www.inspiredpharma.com/wp-content/uploads/2019/06/GDP_symposium-2018-620x349.jpg?resize=620%2C349&ssl=1';
        }

        $event->update($updateData);

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

        $event = Event::find($id);

        if (!$event) {
            return response()->json(['success' => false, 'message' => 'Event not found'], 404);
        }

        $event->delete();

        return response()->json(['success' => true, 'message' => 'Event deleted successfully']);
    }

    public function search(Request $request)
    {

        $search = strtolower(trim($request->input('search')));

        $events = Event::with('eventTitle')
            ->join('event_titles', 'events.title_id', '=', 'event_titles.id')
            ->where(function ($query) use ($search) {
                $query->whereRaw('LOWER(event_titles.title) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(events.theme) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(events.date) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(events.location) LIKE ?', ["%{$search}%"]);
            })
            ->select('events.*')
            ->orderBy('events.date', 'desc')
            ->paginate(10);


        return view('AdminPanel.Events.partials.events_table', compact('events'))->render();
    }
}
