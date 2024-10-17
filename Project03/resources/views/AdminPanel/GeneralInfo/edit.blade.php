@extends('AdminPanel.layout.app')

@section('generalInfo')

<div class="container">

    <div class="head mx-auto mb-2">
        <a href="{{ route('generalInfo') }}" class="back mt-auto w-25"><i class="fa-solid fa-arrow-left"></i> Go Back</a>
        <h1 class="text-secondary text-end fst-italic m-0 mt-auto w-75">Edit General Info</h1>
    </div>
    <hr>

    <form id="edit-generalInfo-form" data-id="{{ $generalInfo->id }}" class="form-column d-flex align-itemns-start justify-content-between flex-wrap mx-auto">
        @csrf
        @METHOD('PUT')

        <div class="coolinput">
            <label for="hero_title" class="text">Hero Title</label>
            <input type="text" name="hero_title" id="hero_title" class="input" placeholder="Write Hero Title..." value="{{ $generalInfo->hero_title }}">
            <small id="hero_title-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="hero_image" class="text">Hero Image URL</label>
            <input type="url" name="hero_image" id="hero_image" class="input" placeholder="Enter Hero Image URL..." value="{{ $generalInfo->hero_image }}">
            <small id="hero_image-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="logo" class="text">Logo URL</label>
            <input type="url" name="logo" id="logo" class="input" placeholder="Enter Logo URL..." value="{{ $generalInfo->logo }}">
            <small id="logo-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="email" class="text">Email</label>
            <input type="email" name="email" id="email" class="input" placeholder="Write email..." value="{{ $generalInfo->email }}">
            <small id="email-error" class="error-message text-danger fw-bold d-block"></small>
        </div>


        <div class="coolinput">
            <label for="address" class="text">Address</label>
            <input type="text" name="address" id="address" class="input" placeholder="Write address..." value="{{$generalInfo->address}}">
            <small id="address-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="facebook" class="text">Facebook URL</label>
            <input type="url" name="facebook" id="facebook" class="input" placeholder="Enter Facebook URL..." value="{{$generalInfo->facebook}}">
            <small id="facebook-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="instagram" class="text">Instagram URL</label>
            <input type="url" name="instagram" id="instagram" class="input" placeholder="Enter Instagram URL..." value="{{$generalInfo->instagram}}">
            <small id="instagram-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="youtube" class="text">Youtube URL</label>
            <input type="url" name="youtube" id="youtube" class="input" placeholder="Enter Youtube URL..." value="{{$generalInfo->youtube}}">
            <small id="youtube-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="linkedin" class="text">Linkedin URL</label>
            <input type="url" name="linkedin" id="linkedin" class="input" placeholder="Enter Linkedin URL..." value="{{$generalInfo->linkedin}}">
            <small id="linkedin-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput mt-2">
            <button class="btn-create my-auto fst-italic fw-bold" type="submit">Update</button>
        </div>



    </form>

</div>

@endsection