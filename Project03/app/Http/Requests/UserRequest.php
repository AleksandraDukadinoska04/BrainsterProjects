<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Illuminate\Validation\Rules;


class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' =>  ['required', 'string', 'max:255'],
            'surname' =>  ['required', 'string', 'max:255'],
            'bio' =>  ['required', 'string', 'max:500'],
            'profession' => ['required', 'string', 'max:255'],
            'phone' =>  ['required'],
            'city' =>  ['required', 'string', 'max:255'],
            'country' =>  ['required', 'string', 'max:255'],
            'CV' =>  ['required', 'string', 'max:255'],
            'photo' =>  ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()]

        ];

        // 'name' => 'required|string|max:255',
        //     'surname' => 'required|string|max:255',
        //     'bio' => 'nullable|string',
        //     'profession' => 'nullable|string|max:255',
        //     'phone' => 'required|string|max:15',
        //     'city' => 'nullable|string|max:255',
        //     'country' => 'nullable|string|max:255',
        //     'email' => 'required|email|unique:users,email',
        //     'password' => 'required|string|min:8',
        //     'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        //     'photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
    }
}
