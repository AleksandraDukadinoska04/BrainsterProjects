<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
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

        $data = $request->all();

        if (!empty($request->photo)) {

            if ($request->hasFile('photo')) {
                $data['photo'] = $request->file('photo')->store('images', 'public');
            } else {
                $data['photo'] = 'images/default.jpg';
            }
        }

        if (!empty($request->CV)) {

            if ($request->hasFile('CV')) {
                $data['CV'] = $request->file('CV')->store('cvs', 'public');
            }
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
            'not_target_pref' => json_encode($request->not_target_pref),
            'not_topic_pref' =>  json_encode($request->not_topic_pref),
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        event(new Registered($user));

        Auth::login($user);

        return redirect(route('admin.welcome', absolute: false));
    }
}
