@extends('AdminPanel.layout.app')

@section('events')

<div class="container">

    <div class="head mx-auto mb-2">
        <a href="{{ route('event.titles') }}" class="back mt-auto w-25"><i class="fa-solid fa-arrow-left"></i> Go Back</a>
        <h1 class="text-secondary text-end fst-italic m-0 mt-auto w-75">Create Event Title</h1>
    </div>
    <hr>


    <form id="eventTitle-form" method="POST" class="form-column d-flex flex-column align-itemns-center justify-content-center mx-auto mt-3">
        @csrf

        <div class="coolinput mx-auto">
            <label for="title" class="text">Title</label>
            <input type="text" name="title" id="title" class="input" placeholder="Title" value="{{ old('title') }}">
            <small id="title-error" class="error-message text-danger fw-bold d-block"></small>
        </div>


        <div class="coolinput mx-auto">
            <button class="btn-create fst-italic w-25" type="submit">Create</button>
        </div>

    </form>

</div>

@endsection