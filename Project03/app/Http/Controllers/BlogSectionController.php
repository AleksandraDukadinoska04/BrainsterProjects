<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogSection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;




class BlogSectionController extends Controller
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
    public function create(string $blog_id)
    {
        return view('AdminPanel.Blogs.BlogSections.create', compact('blog_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'blog_id' => 'required|exists:blogs,id',
            'order' => 'required|integer',
            'section_title' => 'nullable|string|max:255',
            'section_content' => 'required|string|max:1500'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $section = BlogSection::create($request->except('_token'));

        return response()->json([
            'success' => true,
            'message' => 'Blog Section created successfully!',
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
        $section = BlogSection::find($id);
        if (!$section) {
            return redirect()->back();
        }
        return view('AdminPanel.Blogs.BlogSections.edit', compact('section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validator = Validator::make($request->all(), [
            'order' => 'required|integer',
            'section_title' => 'nullable|string|max:255',
            'section_content' => 'required|string|max:1500'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $section = BlogSection::find($id);

        if (!$section) {
            return response()->json(['success' => false, 'message' => 'Blog section not found'], 404);
        }

        if (Auth::user()->role->name !== 'admin') {
            if ($section->blog->user->id !== Auth::id()) {
                return response()->json(['success' => false, 'message' => 'You cannot edit this blog section!'], 404);
            }
        }

        $section->update($request->except('_token'));


        return response()->json([
            'success' => true,
            'message' => 'Blog section updated successfully!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $section = BlogSection::find($id);

        if (!$section) {
            return response()->json(['success' => false, 'message' => 'Blog section not found'], 404);
        }
        if (Auth::user()->role->name !== 'admin') {
            if ($section->blog->user->id !== Auth::id()) {
                return response()->json(['success' => false, 'message' => 'You cannot delete this blog section!'], 404);
            }
        }

        $section->delete();

        return response()->json(['success' => true, 'message' => 'Blog section deleted successfully']);
    }
}
