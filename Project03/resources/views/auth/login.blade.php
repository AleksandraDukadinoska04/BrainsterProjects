@extends('AdminPanel.layout.app')


@section('login')

<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="login-form mx-auto">
        <h2 class="color-gray fst-italic ms-4">Login</h2>
        <hr class="w-100">

        <div class="form-column mx-auto">
            <form method="POST" action="{{ route('login') }} " class="">
                @csrf

                <!-- Email Address -->
                <div class="coolinput w-100">
                    <x-input-label for="email" :value="__('Email')" class="text" />
                    <x-text-input id="email" class="input" type="email" name="email" :value="old('email')" autofocus autocomplete="username" />

                    @error('email')
                    <small class="text-danger fw-bold d-block mt-1">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Password -->
                <div class="coolinput w-100">
                    <x-input-label for="password" :value="__('Password')" class="text" />

                    <x-text-input id="password" class="input"
                        type="password"
                        name="password"
                        autocomplete="current-password" />

                    <div class="input-group-append">
                        <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility1()">
                            <i id="toggle-icon1" class="fa fa-eye-slash"></i>
                        </button>
                    </div>


                    @error('password')
                    <small class="text-danger fw-bold d-block mt-1">{{ $message }}</small>
                    @enderror

                </div>

                <!-- Remember Me -->

                <div class="my-4 remember px-3">
                    <div class=" me-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ms-1 color-gray">{{ __('Remember me') }}</span>
                        </label>
                    </div>
                    @if (Route::has('password.request'))
                    <a class="hover-darkorange underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                    @endif

                </div>
                <button type="submit" class="btn-create px-4 mx-3">Login</button>
            </form>
        </div>
    </div>
</x-guest-layout>

@endsection