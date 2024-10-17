@extends('AdminPanel.layout.app')

@section('events')

<div class="container">

    <div class="head mx-auto mb-2">
        <a href="{{ route('events') }}" class="back mt-auto"><i class="fa-solid fa-arrow-left"></i> Go Back</a>
        <h1 class="text-secondary text-end fst-italic m-0 mt-auto">Edit Event</h1>
    </div>
    <hr>

    <form id="edit-event-form" data-id="{{ $event->id }}" class="form-column d-flex align-itemns-start justify-content-between flex-wrap mx-auto">
        @csrf
        @METHOD('PUT')

        <div class="coolinput">
            <label for="title_id" class="text">Title</label>
            <select name="title_id" id="title_id" class="input">
                <option value="" selected disabled>Choose Event Title</option>
                @foreach($eventTitles as $title)
                <option value="{{$title->id}}" {{ $title->id === $event->title_id ? 'selected' : ''}}>{{ $title->title }}</option>
                @endforeach
            </select>
            <small id="title_id-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="img" class="text">Image URL</label>
            <input type="url" name="img" id="img" class="input" placeholder="Image URL" value="{{ $event->img }}">
            <small id="img-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="theme" class="text">Theme</label>
            <input type="text" name="theme" id="theme" class="input" placeholder="Theme" value="{{ $event->theme }}">
            <small id="theme-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="description" class="text">Description</label>
            <textarea name="description" id="description" class="input" placeholder="Description">{{$event->description}}</textarea>
            <small id="description-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="objective" class="text">Objective</label>
            <textarea name="objective" id="objective" class="input" placeholder="Objective">{{$event->objective}}</textarea>
            <small id="objective-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="location" class="text">Location</label>
            <input type="text" name="location" id="location" class="input" placeholder="Location" value="{{$event->location}}">
            <small id="location-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="date" class="text">Date</label>
            <input type="date" name="date" id="date" class="input" value="{{$event->date}}">
            <small id="date-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="status" class="text">Status</label>
            <select name="status" id="status" class="input">
                <option value="active" {{ $event->status === 'active' ? 'selected' : ''}}>Active</option>
                <option value="completed" {{ $event->status === 'completed' ? 'selected' : ''}}>Completed</option>
            </select>
            <small id="status-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput"></div>

        <div class="coolinput mt-2">
            <button class="btn-create my-auto fst-italic fw-bold" type="submit">Update</button>
        </div>



    </form>

</div>

@endsection