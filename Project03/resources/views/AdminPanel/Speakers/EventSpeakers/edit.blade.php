@extends('AdminPanel.layout.app')

@section('events')

<div class="container">

    <div class="head mx-auto mb-2">
        <a href="{{ route('event.show', $eventSpeaker->event->id) }}" class="back mt-auto w-25"><i class="fa-solid fa-arrow-left"></i> Go Back</a>
        <h1 class="text-secondary text-end fst-italic m-0 mt-auto w-75">Edit Event Speaker</h1>
    </div>
    <hr>


    <form id="edit-eventSpeaker-form" data-id="{{ $eventSpeaker->id }}" class="form-column d-flex align-itemns-start justify-content-between flex-wrap mx-auto">
        @csrf
        @METHOD('PUT')


        <div class="coolinput">
            <label for="speaker_id" class="text">Speaker</label>
            <select name="speaker_id" id="speaker_id" class="input">
                <option value="" selected disabled>Choose a Speaker</option>
                @foreach($speakers as $speaker)
                <option value="{{ $speaker->id }}" {{ $speaker->id === $eventSpeaker->speaker_id ? 'selected' : ''}}>{{ $speaker->name }} {{ $speaker->surname }}</option>
                @endforeach
            </select>
            <small id="speaker_id-error" class="error-message text-danger fw-bold d-block"></small>

        </div>

        <div class="coolinput">
            <label for="speaker_type" class="text">Speaker Type</label>
            <select name="speaker_type" id="speaker_type" class="input">
                <option value="" selected disabled>Choose the Speaker Type</option>
                <option value="ordinary" {{ 'ordinary' === $eventSpeaker->speaker_type ? 'selected' : ''}}>Ordinary</option>
                <option value="special" {{ 'special' ===  $eventSpeaker->speaker_type ? 'selected' : ''}}>Special</option>
            </select>

            <small id="speaker_type-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="speaker_invitation" class="text">Speaker Invitation</label>
            <textarea name="speaker_invitation" class="input" id="speaker_invitation">{{ $eventSpeaker->speaker_invitation }}</textarea>
            <small id="speaker_invitation-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <button class="btn-create my-auto fst-italic fw-bold" type="submit">Update</button>
        </div>


    </form>

</div>

@endsection