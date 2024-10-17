<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;
use App\Models\AgendaDescription;


use Illuminate\Support\Facades\Validator;


class AgendaController extends Controller
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
        return view('AdminPanel.Events.Agenda.create', compact('event_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_id' => 'required|exists:events,id',
            'day' => 'required|integer',
            'hour' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'descriptions' => 'nullable|array',
            'descriptions.*' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $agenda = Agenda::create([
            'event_id' => $request->event_id,
            'day' => $request->day,
            'hour' => $request->hour,
            'title' => $request->title,
        ]);

        if (!empty($request->descriptions)) {
            foreach ($request->descriptions as $description) {
                if (!empty($description)) {
                    AgendaDescription::create([
                        'agenda_id' => $agenda->id,
                        'description' => $description,
                    ]);
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Agenda Row created successfully!',
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
        $agenda = Agenda::find($id);
        if (!$agenda) {
            return redirect()->back();
        }
        return view('AdminPanel.Events.Agenda.edit', compact('agenda'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'day' => 'required|integer',
            'hour' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'descriptions' => 'nullable|array',
            'descriptions.*' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $agenda = Agenda::find($id);

        if (!$agenda) {
            return response()->json(['success' => false, 'message' => 'Agenda not found'], 404);
        }

        $agenda->update([
            'day' => $request->day,
            'hour' => $request->hour,
            'title' => $request->title,
        ]);

        $agenda->descriptions()->delete();

        if (!empty($request->descriptions)) {
            foreach ($request->descriptions as $description) {
                if (!empty($description)) {
                    AgendaDescription::create([
                        'agenda_id' => $agenda->id,
                        'description' => $description,
                    ]);
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Agenda updated successfully!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $agenda = Agenda::find($id);

        if (!$agenda) {
            return response()->json(['success' => false, 'message' => 'Agenda not found'], 404);
        }

        $agenda->delete();

        return response()->json(['success' => true, 'message' => 'Agenda deleted successfully']);
    }
}
