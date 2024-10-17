@extends('AdminPanel.layout.app')

@section('speakers')

<div class="container">

    <div class="head mx-auto mb-2">
        <a href="{{ route('speakers') }}" class="back mt-auto"><i class="fa-solid fa-arrow-left"></i> Go Back</a>
        <h1 class="text-secondary text-end fst-italic m-0 mt-auto">Edit Speaker</h1>
    </div>
    <hr>

    <form id="edit-speaker-form" data-id="{{ $speaker->id }}" class="form-column d-flex align-itemns-start justify-content-between flex-wrap mx-auto">
        @csrf
        @METHOD('PUT')


        <div class="coolinput">
            <label for="name" class="text">Name</label>
            <input type="text" name="name" id="name" class="input" placeholder="Write name..." value="{{ $speaker->name }}">
            <small id="name-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="surname" class="text">Surname</label>
            <input type="text" name="surname" id="surname" class="input" placeholder="Write surname..." value="{{ $speaker->surname }}">
            <small id="surname-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="img" class="text">Image URL</label>
            <input type="url" name="img" id="img" class="input" placeholder="Enter Image URL..." value="{{$speaker->img}}">
            <small id="img-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="profession" class="text">Profession</label>
            <input type="text" name="profession" id="profession" class="input" placeholder="Write profession..." value="{{$speaker->profession}}">
            <small id="profession-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="facebook" class="text">Facebook URL</label>
            <input type="url" name="facebook" id="facebook" class="input" placeholder="Enter Facebook URL..." value="{{$speaker->facebook}}">
            <small id="facebook-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="instagram" class="text">Instagram URL</label>
            <input type="url" name="instagram" id="instagram" class="input" placeholder="Enter Instagram URL..." value="{{$speaker->instagram}}">
            <small id="instagram-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="linkedin" class="text">Linkedin URL</label>
            <input type="url" name="linkedin" id="linkedin" class="input" placeholder="Enter Linkedin URL..." value="{{$speaker->linkedin}}">
            <small id="linkedin-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="twitter" class="text">Twitter URL</label>
            <input type="url" name="twitter" id="twitter" class="input" placeholder="Enter Twitter URL..." value="{{$speaker->twitter}}">
            <small id="twitter-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput"></div>

        <div class="coolinput mt-3">
            <button class="btn-create my-auto fst-italic fw-bold" type="submit">Update</button>
        </div>



    </form>

</div>

@endsection