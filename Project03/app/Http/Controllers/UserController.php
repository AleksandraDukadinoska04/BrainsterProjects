<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\Recommendation;
use App\Models\User;
use App\Models\UsersActivityLog;
use App\Models\Point;
use App\Models\Badge;
use App\Models\BroughtTicket;
use App\Models\Ticket;
use App\Models\Connection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(10);
        return view('AdminPanel.Users.users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('AdminPanel.Users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'bio' => 'nullable|string|max:1500',
            'profession' => 'required|string|max:255',
            'phone' => 'nullable|integer',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:6144',
            'CV' => 'nullable|file|mimes:pdf,doc,docx|max:6144',
            'not_target_pref' => 'nullable',
            'not_topic_pref' => 'nullable',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|max:255|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('images', 'public');
        } else {
            $data['photo'] = 'images/default.jpg';
        }

        if ($request->hasFile('CV')) {
            $data['CV'] = $request->file('CV')->store('cvs', 'public');
        }

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'bio' => $request->bio,
            'profession' => $request->profession,
            'phone' => $request->phone,
            'city' => $request->city,
            'country' => $request->country,
            'photo' => $data['photo'] ?? null,
            'CV' => $data['CV'] ?? null,
            'not_target_pref' => $request->not_target_pref,
            'not_topic_pref' =>  $request->not_topic_pref,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User created successfully!',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back();
        }
        $topics = json_decode($user->not_topic_pref, true);
        $targets = json_decode($user->not_target_pref, true);
        $receivedRecomendations = Recommendation::where('for_user_id', $id)->get();
        $givenRecomendations = Recommendation::where('from_user_id', $id)->get();
        $tickets = BroughtTicket::where('user_id', $id)->get();
        $friends = Connection::where('user_id', $id)->orWhere('friend_id', $id)->where('status', 'accepted')->get();

        return view('AdminPanel.Users.show', compact('user', 'topics', 'targets', 'receivedRecomendations', 'givenRecomendations', 'tickets', 'friends'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back();
        }
        $topics = json_decode($user->not_topic_pref, true);
        $targets = json_decode($user->not_target_pref, true);
        return view('AdminPanel.Users.edit', compact('user', 'topics', 'targets'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'bio' => 'nullable|string|max:1500',
            'profession' => 'required|string|max:255',
            'phone' => 'nullable|integer',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:6144',
            'CV' => 'nullable|file|mimes:pdf,doc,docx|max:6144',
            'not_target_pref' => 'nullable',
            'not_topic_pref' => 'nullable',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|max:255|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('images', 'public');
        } else {
            $data['photo'] = 'images/default.jpg';
        }

        if ($request->hasFile('CV')) {
            $data['CV'] = $request->file('CV')->store('cvs', 'public');
        }


        $user = User::find($id);

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }

        if (Auth::user()->role->name !== 'admin') {
            if ($user->id !== Auth::id()) {
                return response()->json(['success' => false, 'message' => 'You cannot update this user!'], 404);
            }
        }

        $updateData = [
            'name' => $request->name,
            'surname' => $request->surname,
            'bio' => $request->bio,
            'profession' => $request->profession,
            'phone' => $request->phone,
            'city' => $request->city,
            'country' => $request->country,
            'not_topic_pref' => $request->not_topic_pref,
            'not_target_pref' => $request->not_target_pref,
            'email' => $request->email,
        ];

        $updateData['photo'] = $data['photo'];

        if ($request->CV !== null) {
            $updateData['CV'] = $data['CV'];
        }
        if (!empty($request->password)) {
            $updateData['password'] = Hash::make($data['password']);
        }

        $user->update($updateData);

        return response()->json([
            'success' => true,
            'message' => 'User updated successfully!',
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }
        if (Auth::user()->role->name !== 'admin') {
            if ($user->id !== Auth::id()) {
                return response()->json(['success' => false, 'message' => 'You cannot delete this user!'], 404);
            }
        }

        $user->delete();

        return response()->json(['success' => true, 'message' => 'User deleted successfully']);
    }

    public function search(Request $request)
    {
        $search = strtolower(trim($request->input('search')));

        $users = User::where('name', 'LIKE', "%{$search}%")
            ->orWhere('surname', 'LIKE', "%{$search}%")
            ->paginate(10);

        return view('AdminPanel.Users.partials.users_table', compact('users'))->render();
    }
}
