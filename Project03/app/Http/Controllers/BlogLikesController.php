<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\BlogLike;

class BlogLikesController extends Controller
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
            'blog_id' => 'required|integer|exists:blogs,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $like = BlogLike::create([
            'user_id' => Auth::id(),
            'blog_id' => $request->blog_id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Blog liked successfully!',
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $like = BlogLike::find($id);

        if (!$like) {
            return response()->json(['success' => false, 'message' => 'Blog like not found'], 404);
        }

        if ($like->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'You cannot remove this blog like!'], 404);
        }


        $like->delete();

        return response()->json(['success' => true, 'message' => 'Blog like removed successfully']);
    }
}
