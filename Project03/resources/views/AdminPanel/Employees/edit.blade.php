@extends('AdminPanel.layout.app')

@section('employees')

<div class="container">


    <div class="head mx-auto mb-2">
        <a href="{{ route('employees') }}" class="back mt-auto "><i class="fa-solid fa-arrow-left"></i> Go Back</a>
        <h1 class="text-secondary text-end fst-italic m-0 mt-auto ">Edit Employee</h1>
    </div>
    <hr>

    <form id="edit-employee-form" data-id="{{ $employee->id }}" class="form-column d-flex align-itemns-start justify-content-between flex-wrap mx-auto">
        @csrf
        @METHOD('PUT')

        <div class="coolinput">
            <label for="name" class="text">Name</label>
            <input type="text" name="name" id="name" class="input" placeholder="Write name..." value="{{ $employee->name }}">
            <small id="name-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="surname" class="text">Surname</label>
            <input type="text" name="surname" id="surname" class="input" placeholder="Write surname..." value="{{ $employee->surname }}">
            <small id="surname-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="img" class="text">Image URL</label>
            <input type="url" name="img" id="img" class="input" placeholder="Enter Image URL..." value="{{ $employee->img }}">
            <small id="img-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="profession" class="text">Profession</label>
            <input type="text" name="profession" id="profession" class="input" placeholder="Write profession..." value="{{ $employee->profession }}">
            <small id="profession-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="bio" class="text">Bio</label>
            <textarea name="bio" id="bio" class="input" placeholder="Write bio...">{{ $employee->bio }}</textarea>
            <small id="bio-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="facebook" class="text">Facebook URL</label>
            <input type="url" name="facebook" id="facebook" class="input" placeholder="Enter Facebook URL..." value="{{ $employee->facebook }}">
            <small id="facebook-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="instagram" class="text">Instagram URL</label>
            <input type="url" name="instagram" id="instagram" class="input" placeholder="Enter Instagram URL..." value="{{ $employee->instagram }}">
            <small id="instagram-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="linkedin" class="text">Linkedin URL</label>
            <input type="url" name="linkedin" id="linkedin" class="input" placeholder="Enter Linkedin URL..." value="{{ $employee->linkedin }}">
            <small id="linkedin-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="twitter" class="text">Twitter URL</label>
            <input type="url" name="twitter" id="twitter" class="input" placeholder="Enter Twitter URL..." value="{{ $employee->twitter }}">
            <small id="twitter-error" class="error-message text-danger fw-bold d-block"></small>
        </div>


        <div class="coolinput">
            <button class="btn-create my-auto fst-italic fw-bold" type="submit">Update</button>
        </div>



    </form>

</div>

@endsection