@extends('AdminPanel.layout.app')

@section('events')

<div class="container">

    <div class="head mx-auto mb-2">
        <a href="{{ route('event.show', $event_id) }}" class="back mt-auto w-25"><i class="fa-solid fa-arrow-left"></i> Go Back</a>
        <h1 class="text-secondary text-end fst-italic m-0 mt-auto w-75">Create Agenda Row</h1>
    </div>
    <hr>

    <form id="agenda-form" method="POST" class="form-column d-flex align-itemns-start justify-content-between flex-wrap mx-auto">
        @csrf

        <input type="hidden" name="event_id" id="event_id" value="{{ $event_id }}">

        <div class="coolinput">
            <label for="day" class="text">Day</label>
            <input type="number" name="day" id="day" class="input" placeholder="Write day..." value="{{ old('day') }}">
            <small id="day-error" class="error-message text-danger fw-bold d-block"></small>
        </div>
        <div class="coolinput">
            <label for="hour" class="text">Hour</label>
            <input type="time" name="hour" id="hour" class="input" placeholder="Write hour..." value="{{ old('hour') }}">
            <small id="hour-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="title" class="text">Title</label>
            <input type="text" name="title" id="title" class="input" placeholder="Write title..." value="{{old('title')}}">
            <small id="title-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div id="descriptions-wrapper" class="coolinput">
            <div class="description coolinput w-100 p-0">
                <label for="description" class="text">Description</label>
                <input type="text" id="description" name="descriptions[]" class="input " placeholder="Write description...">
                <div class="">
                    <button type="button" class="remove-description  my-2 fst-italic fw-bold">Remove Description<i class="fa-solid fa-trash ms-2"></i></button>
                </div>

            </div>
        </div>



        <div class="coolinput">
            <button type="button" id="add-description-btn" class=" my-auto fst-italic fw-bold"><i class="fa-solid fa-plus me-1 "></i>Add Description</button>
        </div>
        <div class="coolinput">
            <button class="btn-create my-auto fst-italic fw-bold" type="submit">Create</button>
        </div>

    </form>

</div>

@endsection