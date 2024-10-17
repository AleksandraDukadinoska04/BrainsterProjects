<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Speaker;
use App\Models\EventSpeaker;
use Illuminate\Support\Facades\Validator;



class SpeakerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $speakers = Speaker::orderBy('id', 'desc')->paginate(10);
        return view('AdminPanel.Speakers.speakers', compact('speakers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('AdminPanel.Speakers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'img' => 'nullable|url|max:255',
            'profession' => 'required|string|max:255',
            'linkedin' => 'nullable|url|max:255',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255'

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }
        $storeData = [
            'name' => $request->name,
            'surname' => $request->surname,
            'img' => $request->img,
            'profession' => $request->profession,
            'linkedin' => $request->linkedin,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'twitter' => $request->twitter,

        ];
        if ($request->img === null) {
            $storeData['img'] = 'https://static.vecteezy.com/system/resources/previews/009/292/244/non_2x/default-avatar-icon-of-social-media-user-vector.jpg';
        }

        $speaker = Speaker::create($storeData);

        return response()->json([
            'success' => true,
            'message' => 'Speaker created successfully!',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $speaker = Speaker::find($id);
        if (!$speaker) {
            return redirect()->back();
        }
        $events = EventSpeaker::where('speaker_id', $id)->get();
        return view('AdminPanel.Speakers.show', compact('speaker', 'events'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $speaker = Speaker::find($id);
        if (!$speaker) {
            return redirect()->back();
        }
        return view('AdminPanel.Speakers.edit', compact('speaker'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'img' => 'nullable|url|max:255',
            'profession' => 'required|string|max:255',
            'linkedin' => 'nullable|url|max:255',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $speaker = Speaker::find($id);

        if (!$speaker) {
            return response()->json(['success' => false, 'message' => 'Speaker not found'], 404);
        }

        $updateData = [
            'name' => $request->name,
            'surname' => $request->surname,
            'img' => $request->img,
            'profession' => $request->profession,
            'linkedin' => $request->linkedin,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'twitter' => $request->twitter,

        ];
        if ($request->img === null) {
            $updateData['img'] = 'https://static.vecteezy.com/system/resources/previews/009/292/244/non_2x/default-avatar-icon-of-social-media-user-vector.jpg';
        }

        $speaker->update($updateData);


        return response()->json([
            'success' => true,
            'message' => 'Speaker updated successfully!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $speaker = Speaker::find($id);

        if (!$speaker) {
            return response()->json(['success' => false, 'message' => 'Speaker not found'], 404);
        }

        $speaker->delete();

        return response()->json(['success' => true, 'message' => 'Speaker deleted successfully']);
    }

    public function search(Request $request)
    {

        $search = strtolower(trim($request->input('search')));

        $speakers = Speaker::where('name', 'LIKE', "%{$search}%")
            ->orWhere('surname', 'LIKE', "%{$search}%")
            ->orWhere('profession', 'LIKE', "%{$search}%")
            ->paginate(10);


        return view('AdminPanel.Speakers.partials.speakers_table', compact('speakers'))->render();
    }
}
