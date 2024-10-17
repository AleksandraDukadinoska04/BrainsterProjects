@extends('AdminPanel.layout.app')

@section('users')

<div class="container">


    <div class="head mx-auto mb-2">
        <a href="{{ route('users') }}" class="back mt-auto"><i class="fa-solid fa-arrow-left"></i> Go Back</a>
        <h1 class="text-secondary text-end fst-italic m-0 mt-auto">Edit User</h1>
    </div>
    <hr>


    <form id="edit-user-form" data-id="{{ $user->id }}" enctype="multipart/form-data" class="form-column d-flex align-itemns-start justify-content-between flex-wrap mx-auto">
        @csrf
        @METHOD('PUT')

        <div class="coolinput">
            <label for="name" class="text">Name</label>
            <input type="text" name="name" id="name" class="input" placeholder="Write name..." value="{{ $user->name }}">
            <small id="name-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="surname" class="text">Surname</label>
            <input type="text" name="surname" id="surname" class="input" placeholder="Write surname..." value="{{ $user->surname }}">
            <small id="surname-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="bio" class="text">Bio</label>
            <textarea name="bio" id="bio" class="input" placeholder="Write bio...">{{ $user->bio }}</textarea>
            <small id="bio-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput ">
            <label for="profession" class="text">Profession</label>
            <input type="text" name="profession" id="profession" class="input" placeholder="Write profession..." value="{{ $user->profession }}">
            <small id="profession-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput ">
            <label for="phone" class="text">Phone</label>
            <input type="text" name="phone" id="phone" class="input" placeholder="Write phone number..." value="{{ $user->phone }}">
            <small id="phone-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="city" class="text">City</label>
            <input type="text" name="city" id="city" class="input" placeholder="Write city..." value="{{ $user->city }}">
            <small id="city-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="country" class="text">Country</label>
            <input type="text" name="country" id="country" class="input" placeholder="Write country..." value="{{ $user->country }}">
            <small id="country-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="CV" class="text">CV</label>
            <input type="file" name="CV" id="CV" class="input" placeholder="Upload CV...(.pdf,.doc,.docx)" value="{{ old('CV') }}" accept=".pdf,.doc,.docx">
            <small id="CV-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="photo" class="text">Photo</label>
            <input type="file" name="photo" id="photo" class="input" placeholder="Upload photo...(jpeg,png,jpg)" value="{{ old('photo') }}" accept="image/*">
            <small id="photo-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="email" class="text">Email</label>
            <input type="email" name="email" id="email" class="input" placeholder="Write email..." value="{{ $user->email }}">
            <small id="email-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput flex-row">

            <div class="w-50 d-flex flex-column">
                <p class="fst-italic fw-bold color-darkorange">Notification Target Preference:</p>
                <div class="d-flex justify-content-between pe-5">
                    <label for="platform" class="color-gray">Platform</label>
                    <input type="checkbox" id="platform" value="Platform" name="not_target_pref[]"
                        @if($targets !==null)
                        @foreach($targets as $target)
                        @if($target==='Platform' )
                        checked
                        @endif
                        @endforeach
                        @endif>
                </div>
                <div class="d-flex justify-content-between pe-5">

                    <label for="e-mail" class="color-gray">E-mail</label>
                    <input type="checkbox" id="e-mail" value="E-mail" name="not_target_pref[]"
                        @if($targets !==null)
                        @foreach($targets as $target)
                        @if($target==='E-mail' )
                        checked
                        @endif
                        @endforeach
                        @endif>
                </div>

                <div class="d-flex justify-content-between pe-5">

                    <label for="social_media" class="color-gray">Social Media</label>
                    <input type="checkbox" id="social_media" value="Social Media" name="not_target_pref[]"
                        @if($targets !==null)
                        @foreach($targets as $target)
                        @if($target==='Social Media' )
                        checked
                        @endif
                        @endforeach
                        @endif>
                </div>


                <small id="not_target_pref-error" class="error-message text-danger fw-bold d-block"></small>

            </div>


            <div class="w-50 d-flex flex-column">
                <p class="fst-italic fw-bold color-darkorange">Notification Topic Preference:</p>

                <div class="d-flex justify-content-between pe-4">
                    <label for="new_content" class="color-gray">New Content</label>
                    <input type="checkbox" id="new_content" value="New Content" name="not_topic_pref[]"
                        @if($topics !==null)
                        @foreach($topics as $topic)
                        @if($topic==='New Content' )
                        checked
                        @endif
                        @endforeach
                        @endif>
                </div>

                <div class="d-flex justify-content-between pe-4">
                    <label for="new_events" class="color-gray">New Events</label>
                    <input type="checkbox" id="new_events" value="New Events" name="not_topic_pref[]"
                        @if($topics !==null)

                        @foreach($topics as $topic)
                        @if($topic==='New Events' )
                        checked
                        @endif
                        @endforeach
                        @endif>
                </div>

                <div class="d-flex justify-content-between pe-4">
                    <label for="approaching_event" class="color-gray">Approaching Event Date</label>
                    <input type="checkbox" id="approaching_event" value="Approaching Event Date" name="not_topic_pref[]"
                        @if($topics !==null)

                        @foreach($topics as $topic)
                        @if($topic==='Approaching Event Date' )
                        checked
                        @endif
                        @endforeach
                        @endif>
                </div>

                <small id="not_topic_pref-error" class="error-message text-danger fw-bold d-block"></small>
            </div>
        </div>

        <div class="coolinput">

            <label for="password" class="text">Change Password</label>
            <input type="password" name="password" id="password" class="input" placeholder="Write password...">

            <div class="input-group-append">
                <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility1()">
                    <i id="toggle-icon1" class="fa fa-eye-slash"></i>
                </button>
            </div>

            <small id="password-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput"></div>

        <div class="coolinput">
            <button class="btn-create mt-auto fct-italic fw-bold" type="submit">Update</button>
        </div>


    </form>

</div>


@endsection