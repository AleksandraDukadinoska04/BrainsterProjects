@extends('AdminPanel.layout.app')


@section('register')


<x-guest-layout>

    <div class="form-column mx-auto">
        <h2 class="color-gray fst-italic ms-4">Register</h2>
        <hr class="w-100">


        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="form mx-auto">
            @csrf

            <!-- Name -->
            <div class="coolinput">
                <x-input-label for="name" class="text" :value="__('Name')" />
                <x-text-input id="name" class="input" type="text" name="name" :value="old('name')" autofocus autocomplete="name" />
                @error('name')
                <small class="text-danger fw-bold d-block mt-1">{{ $message }}</small>
                @enderror
            </div>

            <!-- Surname -->
            <div class="coolinput">
                <x-input-label for="surname" class="text" :value="__('Surname')" />
                <x-text-input id="surname" class="input" type="text" name="surname" :value="old('surname')" autofocus autocomplete="surname" />
                @error('surname')
                <small class="text-danger fw-bold d-block mt-1">{{ $message }}</small>
                @enderror
            </div>

            <!-- Bio -->
            <div class="coolinput">
                <x-input-label for="bio" class="text" :value="__('Bio')" />
                <textarea name="bio" id="bio" class="input" autofocus autocomplete="bio">{{ old('bio') }}</textarea>
                @error('bio')
                <small class="text-danger fw-bold d-block mt-1">{{ $message }}</small>
                @enderror
            </div>

            <!-- Profession -->
            <div class="coolinput">
                <x-input-label for="profession" class="text" :value="__('Profession')" />
                <x-text-input id="profession" class="input" type="text" name="profession" :value="old('profession')" autofocus autocomplete="profession" />
                @error('profession')
                <small class="text-danger fw-bold d-block mt-1">{{ $message }}</small>
                @enderror
            </div>

            <!-- Phone -->
            <div class="coolinput">
                <x-input-label for="phone" class="text" :value="__('Phone')" />
                <x-text-input id="phone" class="input" type="number" name="phone" :value="old('phone')" autofocus autocomplete="phone" />
                @error('phone')
                <small class="text-danger fw-bold d-block mt-1">{{ $message }}</small>
                @enderror
            </div>

            <!-- City -->
            <div class="coolinput">
                <x-input-label for="city" class="text" :value="__('City')" />
                <x-text-input id="city" class="input" type="text" name="city" :value="old('city')" autofocus autocomplete="city" />
                @error('city')
                <small class="text-danger fw-bold d-block mt-1">{{ $message }}</small>
                @enderror
            </div>

            <!-- Country -->
            <div class="coolinput">
                <x-input-label for="country" class="text" :value="__('Country')" />
                <x-text-input id="country" class="input" type="text" name="country" :value="old('country')" autofocus autocomplete="country" />
                @error('country')
                <small class="text-danger fw-bold d-block mt-1">{{ $message }}</small>
                @enderror
            </div>

            <!-- CV -->
            <div class="coolinput">
                <label for="CV" class="text">CV</label>
                <input type="file" name="CV" id="CV" class="input" placeholder="Upload CV...(.pdf,.doc,.docx)" value="{{ old('CV') }}" accept=".pdf,.doc,.docx">
                @error('CV')
                <small class="text-danger fw-bold d-block mt-1">{{ $message }}</small>
                @enderror
            </div>

            <!-- Photo -->
            <div class="coolinput">
                <label for="photo" class="text">Photo</label>
                <input type="file" name="photo" id="photo" class="input" placeholder="Upload photo...(jpeg,png,jpg)" value="{{ old('photo') }}" accept="image/*">
                @error('photo')
                <small class="text-danger fw-bold d-block mt-1">{{ $message }}</small>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="coolinput">
                <x-input-label for="email" class="text" :value="__('Email')" />
                <x-text-input id="email" class="input" type="email" name="email" :value="old('email')" autocomplete="username" />
                @error('email')
                <small class="text-danger fw-bold d-block mt-1">{{ $message }}</small>
                @enderror
            </div>

            <!-- Password -->
            <div class="coolinput">
                <x-input-label for="password" class="text" :value="__('Password')" />

                <x-text-input id="password" class="input"
                    type="password"
                    name="password"
                    autocomplete="new-password" />
                <div class="input-group-append">
                    <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility1()">
                        <i id="toggle-icon1" class="fa fa-eye-slash"></i>
                    </button>
                </div>

                @error('password')
                <small class="text-danger fw-bold d-block mt-1">{{ $message }}</small>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="coolinput">
                <x-input-label for="password_confirmation" class="text" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="password_confirmation input"
                    type="password"
                    name="password_confirmation" autocomplete="new-password" />

                <div class="input-group-append">
                    <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility2()">
                        <i id="toggle-icon2" class="fa fa-eye-slash"></i>
                    </button>
                </div>

                @error('password_confirmation')
                <small class="text-danger fw-bold d-block mt-1">{{ $message }}</small>
                @enderror
            </div>

            <div class="coolinput flex-md-row flex-sm-column">

                <!-- Notification Target Preference -->
                <div class=" d-flex flex-column my-2 my-md-0">
                    <p class="fst-italic fw-bold color-darkorange">Notification Target Preference:</p>
                    <div class="d-flex justify-content-between pe-5">
                        <label for="platform" class="color-gray">Platform</label>
                        <input type="checkbox" id="platform" value="Platform" name="not_target_pref[]">
                    </div>
                    <div class="d-flex justify-content-between pe-5">

                        <label for="e-mail" class="color-gray">E-mail</label>
                        <input type="checkbox" id="e-mail" value="E-mail" name="not_target_pref[]">
                    </div>

                    <div class="d-flex justify-content-between pe-5">

                        <label for="social_media" class="color-gray">Social Media</label>
                        <input type="checkbox" id="social_media" value="Social Media" name="not_target_pref[]">
                    </div>


                    @error('not_target_pref')
                    <small class="text-danger fw-bold d-block mt-1">{{ $message }}</small>
                    @enderror
                </div>


                <!-- Notification Topic Preference -->
                <div class=" d-flex flex-column ">
                    <p class="fst-italic fw-bold color-darkorange">Notification Topic Preference:</p>

                    <div class="d-flex justify-content-between pe-4">
                        <label for="new_content" class="color-gray">New Content</label>
                        <input type="checkbox" id="new_content" value="New Content" name="not_topic_pref[]">
                    </div>

                    <div class="d-flex justify-content-between pe-4">
                        <label for="new_events" class="color-gray">New Events</label>
                        <input type="checkbox" id="new_events" value="New Events" name="not_topic_pref[]">
                    </div>

                    <div class="d-flex justify-content-between pe-4">
                        <label for="approaching_event" class="color-gray">Approaching Event Date</label>
                        <input type="checkbox" id="approaching_event" value="Approaching Event Date" name="not_topic_pref[]">
                    </div>

                    @error('not_topic_pref')
                    <small class="text-danger fw-bold d-block mt-1">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="coolinput">
                <a class="hover-darkorange ms-auto my-2" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
                <button type="submit" class="btn-create">Register</button>
            </div>
        </form>
    </div>
</x-guest-layout>

@endsection