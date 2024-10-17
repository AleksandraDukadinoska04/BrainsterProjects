@extends('AdminPanel.layout.app')

@section('speakers')

<div class="container-md">
    <div class="d-flex align-items-center justify-content-between form-column mx-auto mb-3">
        <a href="{{ route('speakers') }}" class="back mt-auto"><i class="fa-solid fa-arrow-left"></i> Go Back</a>
        <div class="">
            <a href="{{ route('speaker.edit' , $speaker) }}" class="text-decoration-none text-success mx-3"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
            <button class="delete_speaker delete" data-id="{{ $speaker->id }}"><i class="fa-solid fa-trash"></i>Delete</button>
        </div>
    </div>

    <div class=" form-column user-profile mx-auto">
        <div class="responsive-width image">
            <h3 class="text-center color-darkorange fst-italic text-decoration-underline">{{ $speaker->name }} {{ $speaker->surname }}</h3>
            <div class="w-50 mx-auto border-top pt-2">
                <img src="{{ $speaker->img }}" alt="" class="w-100">
            </div>
        </div>
        <div class="responsive-width info ">
            <p class="fst-italic color-gray"><i class="fa-solid fa-user color-darkorange"></i> | {{ $speaker->profession }}</p>
            <a href="{{ $speaker->facebook }}" class="color-gray hover-darkorange text-decoration-none fst-italic d-block mb-3" target="_blank"><i class="fa-brands fa-square-facebook color-darkorange"></i> | {{ $speaker->facebook }}</a>
            <a href="{{ $speaker->twitter }}" class="color-gray hover-darkorange text-decoration-none fst-italic d-block mb-3" target="_blank"><i class="fa-brands fa-square-instagram color-darkorange"></i> | {{ $speaker->instagram }}</a>
            <a href="{{ $speaker->instagram }}" class="color-gray hover-darkorange text-decoration-none fst-italic d-block mb-3" target="_blank"><i class="fa-brands fa-square-twitter color-darkorange"></i> | {{ $speaker->twitter }}</a>
            <a href="{{ $speaker->linkedin}}" class="color-gray hover-darkorange text-decoration-none fst-italic d-block mb-3" target="_blank"><i class="fa-brands fa-linkedin color-darkorange"></i> | {{ $speaker->linkedin }}</a>

        </div>
    </div>

    <div class="my-5">
        <h2 class="text-center color-grey fw-bold fst-italic border-bottom pb-2">Аttendance at Еvents</h2>

        <div class="d-flex align-items-strech justify-content-center flex-wrap mt-4 ">
            @forelse($events as $event)
            <a href="{{ route('event.show', $event->event->id) }}" target="_blank" class="text-decoration-none d-block border border-2 rounded shadow cart me-3 mb-3 ">
                <h4 class="fw-bold fst-italic color-darkorange text-center p-2">{{ $event->event->eventTitle->title }}</h4>
                <img src="{{ $event->event->img }}" alt="" class="w-100">
                <div class="p-2">
                    <p class="fw-bold color-darkorange">Theme: <span class="fw-normal color-gray">{{ $event->event->theme }}</span></p>
                    <p class="fw-bold color-darkorange">Invitation: <span class="fw-normal color-gray">{{ $event->speaker_invitation }}</span></p>
                    <p class="fw-bold color-darkorange">Guested As: <span class="text-capitalize fw-normal color-gray">{{ $event->speaker_type }} Speaker</span></p>
                </div>
            </a>

            @empty
            <p class="text-muted fst-italic m-0">No events yet....</p>

            @endforelse
        </div>
    </div>





    @endsection