<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\GeneralInfo;

class GeneralInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $generalInfos = GeneralInfo::all();
        return view('AdminPanel.GeneralInfo.generalInfo', compact('generalInfos'));
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
        //
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
        $generalInfo = GeneralInfo::find($id);
        if (!$generalInfo) {
            return redirect()->back();
        }
        return view('AdminPanel.GeneralInfo.edit', compact('generalInfo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'hero_title' => 'required|string|max:255',
            'hero_image' => 'required|url|max:255',
            'logo' => 'required|url|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'linkedin' => 'nullable|url|max:255',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $genralInfo = GeneralInfo::find($id);

        if (!$genralInfo) {
            return response()->json(['success' => false, 'message' => 'General Info not found'], 404);
        }

        $genralInfo->update($request->except('_token'));


        return response()->json([
            'success' => true,
            'message' => 'General Info updated successfully!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
