<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogComment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = BlogComment::orderBy('created_at', 'desc')->paginate(10);
        return view('AdminPanel.Comments.comments', compact('comments'));
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
            'comment' => 'required|string|max:1500',
            'blog_id' => 'required|integer|exists:blogs,id',
            'parent_id' => 'nullable|integer|exists:blog_comments,id'

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $comment = BlogComment::create([
            'user_id' => Auth::id(),
            'blog_id' => $request->blog_id,
            'content' => $request->comment,
            'parent_id' => $request->parent_id,

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
            'comment' => 'required|string|max:1500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $comment = BlogComment::find($id);

        if (!$comment) {
            return response()->json(['success' => false, 'message' => 'Comment not found'], 404);
        }
        if ($comment->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'You cannot update this comment!'], 404);
        }

        $comment->update($request->except('_token'));

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
        $comment = BlogComment::find($id);

        if (!$comment) {
            return response()->json(['success' => false, 'message' => 'Comment not found'], 404);
        }
        if (Auth::user()->role->name !== 'admin') {
            if ($comment->user_id !== Auth::id()) {
                return response()->json(['success' => false, 'message' => 'You cannot delete this comment!'], 404);
            }
        }

        $comment->delete();

        return response()->json(['success' => true, 'message' => 'Comment deleted successfully']);
    }
    public function search(Request $request)
    {

        $search = strtolower(trim($request->input('search')));

        $comments = BlogComment::where('content', 'LIKE', "%{$search}%")
            ->orWhereHas('user', function ($query) use ($search) {

                $query->whereRaw("CONCAT(name, ' ', surname) LIKE ?", ["%{$search}%"]);
            })
            ->orWhereHas('blog', function ($query) use ($search) {
                $query->where('title', 'LIKE', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('AdminPanel.Comments.partials.comments_table', compact('comments'))->render();
    }
}
