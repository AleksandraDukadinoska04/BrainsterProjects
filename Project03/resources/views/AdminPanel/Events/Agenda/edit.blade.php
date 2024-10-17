@extends('AdminPanel.layout.app')

@section('events')

<div class="container">

    <div class="head mx-auto mb-2">
        <a href="{{ route('event.show', $agenda->event->id) }}" class="back mt-auto w-25"><i class="fa-solid fa-arrow-left"></i> Go Back</a>
        <h1 class="text-secondary text-end fst-italic m-0 mt-auto w-75">Edit Agenda Row</h1>
    </div>
    <hr>


    <form id="edit-agenda-form" data-id="{{ $agenda->id }}" class="form-column d-flex align-itemns-start justify-content-between flex-wrap mx-auto">
        @csrf
        @METHOD('PUT')

        <input type="hidden" id="agenda-id" value="{{ $agenda->id }}">

        <div class="coolinput">
            <label for="day" class="text">Day</label>
            <input type="text" name="day" id="day" class="input" placeholder="Day" value="{{ $agenda->day }}">
            <small id="day-error" class="error-message text-danger fw-bold d-block"></small>
        </div>


        <div class="coolinput">
            <label for="hour" class="text">Hour</label>
            <input type="time" name="hour" id="hour" class="input" placeholder="Hour" value="{{ $agenda->hour }}">
            <small id="hour-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="title" class="text">Title</label>
            <input type="text" name="title" id="title" class="input" placeholder="Title" value="{{$agenda->title}}">
            <small id="title-error" class="error-message text-danger fw-bold d-block"></small>
        </div>


        <div id="edit-descriptions-wrapper" class="coolinput">
            @foreach($agenda->descriptions as $description)
            <div class="description coolinput w-100 p-0">
                <label for="description" class="text">Description</label>
                <input type="text" name="descriptions[]" value="{{ $description->description }}" class="input">

                <div class="">
                    <button type="button" class="remove-edit-description my-2 fst-italic fw-bold">Remove Description<i class="fa-solid fa-trash ms-2"></i></button>
                </div>
            </div>
            @endforeach
        </div>


        <div class="coolinput">
            <button type="button" id="edit-add-description-btn" class=" my-auto fst-italic fw-bold"><i class="fa-solid fa-plus me-1 "></i>Add Description</button>
        </div>

        <div class="coolinput">
            <button class="btn-create my-auto fst-italic fw-bold" type="submit">Update</button>
        </div>



    </form>

</div>

@endsection