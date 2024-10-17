<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogComment;
use App\Models\BlogLike;
use App\Models\CommentLike;
use App\Models\Favourite;
use App\Models\BlogSection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::orderBy('id', 'desc')->paginate(10);
        return view('AdminPanel.Blogs.blogs', compact('blogs'));
    }

    public function show(string $id)
    {
        $blog = Blog::find($id);
        if (!$blog) {
            return redirect()->back();
        }
        $sections = BlogSection::where('blog_id', $id)
            ->orderBy('order', 'asc')
            ->get();
        $comments = BlogComment::where('blog_id', $id)->where('parent_id', null)->orderBy('created_at', 'desc')->get();
        $replies = BlogComment::where('blog_id', $id)->where('parent_id', '!=', null)->orderBy('created_at', 'desc')->get();
        $likes = BlogLike::where('blog_id', $id)->get();
        $favourited = Favourite::where('blog_id', $id)->get();
        $commentLikes = CommentLike::all();

        return view('AdminPanel.Blogs.show', compact('blog', 'sections', 'comments', 'replies', 'likes', 'favourited', 'commentLikes'));
    }

    public function create()
    {
        return view('AdminPanel.Blogs.create');
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'img' => 'nullable|url|max:255',
            'order.*' => 'required|integer',
            'section_title.*' => 'nullable|string|max:255',
            'section_body.*' => 'required|string|max:1500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }
        $storeData = [
            'title' => $request->title,
            'img' => $request->img,
            'created_by' => Auth::id()
        ];

        if ($request->img === null) {
            $storeData['img'] = 'https://i0.wp.com/www.inspiredpharma.com/wp-content/uploads/2019/06/GDP_symposium-2018-620x349.jpg?resize=620%2C349&ssl=1';
        }

        $blog = Blog::create($storeData);

        foreach ($request->section_title as $index => $section_title) {
            BlogSection::create([
                'blog_id' => $blog->id,
                'order' => $request->order[$index],
                'section_title' => $section_title,
                'section_content' => $request->section_body[$index],
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Blog created successfully!',
        ]);
    }

    public function edit(string $id)
    {
        $blog = Blog::find($id);
        if (!$blog) {
            return redirect()->back();
        }
        return view('AdminPanel.Blogs.edit', compact('blog'));
    }

    public function update(Request $request, string $id)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'img' => 'nullable|url|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json(['success' => false, 'message' => 'Blog not found'], 404);
        }
        if (Auth::user()->role->name !== 'admin') {
            if ($blog->created_by !== Auth::id()) {
                return response()->json(['success' => false, 'message' => 'You cannot edit this blog!'], 404);
            }
        }

        $updateData = [
            'title' => $request->title,
            'img' => $request->img,
        ];

        if ($request->img === null) {
            $updateData['img'] = 'https://i0.wp.com/www.inspiredpharma.com/wp-content/uploads/2019/06/GDP_symposium-2018-620x349.jpg?resize=620%2C349&ssl=1';
        }


        $blog->update($updateData);

        return response()->json([
            'success' => true,
            'message' => 'Blog updated successfully!',
        ]);
    }


    public function destroy(string $id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json(['success' => false, 'message' => 'Blog not found'], 404);
        }
        if (Auth::user()->role->name !== 'admin') {
            if ($blog->created_by !== Auth::id()) {
                return response()->json(['success' => false, 'message' => 'You cannot delete this blog!'], 404);
            }
        }

        $blog->delete();

        return response()->json(['success' => true, 'message' => 'Blog deleted successfully']);
    }


    public function search(Request $request)
    {
        $search = strtolower(trim($request->input('search')));

        $blogs = Blog::join('users', 'blogs.created_by', '=', 'users.id')
            ->where('blogs.title', 'LIKE', "%{$search}%")
            ->orWhere(DB::raw("CONCAT(users.name, ' ', users.surname)"), 'LIKE', "%{$search}%")
            ->select('blogs.*')
            ->with('user')
            ->paginate(10);

        return view('AdminPanel.Blogs.partials.blogs_table', compact('blogs'))->render();
    }
}
