@extends('AdminPanel.layout.app')

@section('events')

<div class="container-md">
    <div class="d-flex align-items-center justify-content-between form-column mx-auto mb-2 ">
        <a href="{{ route('events') }}" class="back mt-auto "><i class="fa-solid fa-arrow-left"></i> Go Back</a>
        <div class="">
            <a href="{{ route('event.edit' , $event) }}" class="text-decoration-none text-success me-3"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
            <button class="delete_event delete" data-id="{{ $event->id }}"><i class="fa-solid fa-trash"></i>Delete</button>
        </div>
    </div>


    <div class="d-flex align-items-start justify-content-center rounded-pill vh-70 shadow" style='background-image: url("{{ $event->img }}") ; background-position: center; background-size: cover;'>
        <div class="overlay w-100 vh-70 d-flex flex-column align-items-start justify-content-center rounded-pill p-5">
            <small class="text-white fs-5">Event</small>
            <h1 class="text-white fw-bold fst-italic w-75 my-2">{{ $event->eventTitle->title }} </h1>
            <p class="text-white fst-italic"><i class="fa-solid fa-location-dot"></i> | <b class="color-darkorange">{{ $event->location }}</b> </p>
            <p class="text-white fst-italic"><i class="fa-regular fa-calendar-days"></i> | <b class="color-darkorange">{{ \Carbon\Carbon::parse($event->date)->format('d F, Y') }}</b> </p>

        </div>
    </div>


    <div class="my-5">
        <h2 class="color-darkorange fw-bold fst-italic text-center">{{ $event->eventTitle->title }}</h2>
        <hr class="w-100">
        <div class="d-flex align-items-start justify-content-between my-4">
            <div class="w-50">
                <h3 class="color-darkorange fw-bold fst-italic text-center"><i class="fa-solid fa-location-dot"></i></h3>
                <p class="color-gray text-center fw-bold">{{ $event->location }}</p>
            </div>
            <div class="w-50">
                <h3 class="color-darkorange fw-bold fst-italic text-center"><i class="fa-regular fa-calendar-days"></i></h3>
                <p class="color-gray text-center fw-bold">{{ \Carbon\Carbon::parse($event->date)->format('d F, Y') }}</p>
            </div>
        </div>
        <h3 class="color-darkorange fw-bold fst-italic my-4 text-center">THEME: <span class="color-gray"> {{ $event->theme }} </span></h3>
        <div class="d-flex align-items-start justify-content-between responsive-flex my-4">
            <div class="responsive-width">
                <h3 class="color-darkorange fw-bold fst-italic text-center">Description</h3>
                <p class="color-gray text-center">{{ $event->description }}</p>
            </div>
            <div class="responsive-width">
                <h3 class="color-darkorange fw-bold fst-italic text-center">Objective</h3>
                <p class="color-gray text-center">{{ $event->objective }}</p>
            </div>
        </div>
    </div>

    <hr class="w-100">


    <div class="my-5">
        <div class="border-bottom pb-2 d-flex align-items-end">
            <h2 class="me-3 mb-0 color-gray gw-bold fst-italic">Agenda</h2>
            <a href="{{ route('event.agenda.create', $event->id) }}" class="btn-create fw-bold"><i class="fa-solid fa-plus me-1"></i>Add new row</a>
        </div>


        <div class="filters my-3 d-flex flex-wrap align-items-end">
            @foreach($days as $day)
            <button class="filter-btn bg-light color-gray fw-bold fst-italic border-1 p-1 rounded me-2" data-day="{{ $day->day }}">Day {{ $day->day }}</button>
            @endforeach
        </div>

        <div id="agenda-items">
            @forelse($agendas as $agenda)

            <div class="agenda-item my-3 border-bottom" id="agenda-{{ $agenda->id }}" data-day="{{ $agenda->day }}" style="display: none;">
                <div class="hour">
                    <p class="color-grey fw-bold m-0">{{ $agenda->hour }}</p>
                </div>
                <div class="content text-start">
                    <h5 class="fw-bold color-darkorange fst-italic title">{{ $agenda->title}}</h5>
                    <ul>
                        @foreach($descriptions as $description)
                        @if($description->agenda_id === $agenda->id)
                        <li class="color-gray">{{ $description->description }}</li>
                        @endif
                        @endforeach
                    </ul>
                </div>
                <div class="action">
                    <a href="{{ route('event.agenda.edit', $agenda->id) }}" class="text-decoration-none text-success mb-1 d-flex align-items-center"><i class="me-1 fa-solid fa-pen-to-square"></i>Edit</a>
                    <button class="delete_agenda delete d-flex align-items-center p-0" data-id="{{ $agenda->id }}"><i class="fa-solid fa-trash me-1"></i>Delete</button>
                </div>
            </div>

            @empty
            <p class="text-muted fst-italic m-0">No rows yet....</p>

            @endforelse
        </div>
    </div>

    <hr class="w-100">

    <div class="my-5">
        <div class="border-bottom pb-2 d-flex align-items-end">
            <h2 class="me-3 mb-0 color-gray gw-bold fst-italic">Speakers</h2>
            <a href="{{ route('event.speaker.create', $event->id) }}" class=" btn-create fw-bold"><i class="fa-solid fa-plus me-1"></i>Add New Speaker</a>
        </div>


        <div class="filters my-2 text-center">
            <div class="form-check form-check-inline">
                <span class="custom-radio"></span>
                <input class="form-check-input" type="radio" name="speaker-filter" id="speakersAll" value="all" checked>
                <label class="form-check-label" for="speakersAll">Show All</label>
            </div>

            <div class="form-check form-check-inline mx-2">
                <span class="custom-radio"></span>
                <input class="form-check-input" type="radio" name="speaker-filter" id="ordinary" value="ordinary">
                <label class="form-check-label" for="ordinary">Ordinery</label>
            </div>

            <div class="form-check form-check-inline">
                <span class="custom-radio"></span>
                <input class="form-check-input" type="radio" name="speaker-filter" id="special" value="special">
                <label class="form-check-label" for="special">Special</label>
            </div>

        </div>

        <div id="speakers-list" class="d-flex flex-wrap align-items-strech justify-content-center my-3 g-3">
            @forelse($speakers as $speaker)
            <div class="speaker-item cart border-2 shadow me-3 mb-3" id="eventSpeaker-{{ $speaker->id }}" data-type="{{ $speaker->speaker_type }}">

                <h5 class=" fw-bold fst-italic text-center p-2"><a href="{{ route('speaker.show', $speaker->speaker->id) }}" class="text-decoration-none color-darkorange" target="_blank">{{ $speaker->speaker->name }} {{ $speaker->speaker->surname }}</a></h5>
                <div class="">
                    <img src="{{ $speaker->speaker->img }}" alt="Speaker Image" class="w-100">
                </div>
                <small class="color-gray text-center d-block text-capitalize">{{ $speaker->speaker_type}}</small>

                <div class="p-3">
                    <p class="color-darkorange fw-bold fst-italic mb-0">Speaker Invitation:</p>
                    <p class="color-gray">{{ $speaker->speaker_invitation  }}</b></p>
                    <a href="{{ route('event.speaker.edit', $speaker->id) }}" class="text-decoration-none text-success me-3"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                    <button class="delete_eventSpeaker delete" data-id="{{ $speaker->id }}"><i class="fa-solid fa-trash"></i>Delete</button>
                </div>

            </div>
            @empty
            <p class="text-muted fst-italic m-0">No speakers yet....</p>
            @endforelse
        </div>
    </div>

    <hr class="w-100">

    <div class="my-5">

        <div class="border-bottom pb-2 d-flex align-items-end mb-3">
            <h2 class="me-3 mb-0 color-gray gw-bold fst-italic">Tickets</h2>
            <a href="{{ route('event.ticket.create', $event->id) }}" class=" btn-create fw-bold"><i class="fa-solid fa-plus me-1"></i>Create Ticket</a>
        </div>
        <div class="tickets">

            @forelse($tickets as $ticket)

            <div class="ticket inner rounded-5 bg-white shadow p-4" id="ticket-{{ $ticket->id }}">
                <div class="ticket-img">
                    <div class="rounded-5 rounded-top-0" style='background-image: url("{{ $ticket->event->img }}") ; background-position: center; background-size: cover;'>
                        <div class="overlay w-100 h-100 rounded-5 rounded-top-0  d-flex flex-center align-items-start justify-content-center py-4 text-white">
                            <i class="fa-solid fa-ticket ticket-icon"></i>
                        </div>
                    </div>

                </div>
                <div class="ticket-text">
                    <h4 class="color-darkorange fw-bold fst-italic text-capitalize mb-2">{{ $ticket->ticket_type }}</h4>
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="w-50">
                            <p class="color-gray fw-bold mb-1">Price: <span class="color-darkorange">{{ $ticket->price }}$</span></p>
                            <p class="color-gray fw-bold mb-1">Quantity: <span class="color-darkorange">{{ $ticket->quantity }}</span></p>
                        </div>
                        <div class="w-50">
                            <p class="color-gray fw-bold mb-1">Seats: <span class="color-darkorange">{{ $ticket->seats }}</span></p>
                            <p class="color-gray fw-bold mb-1">WiFi: <span class="color-darkorange">{{ $ticket->wifi ? 'yes' : 'no' }}</span></p>
                        </div>

                    </div>
                    <p class="color-darkorange fw-bold mb-1">Pauses: <span class="color-gray fw-normal">{{ $ticket->pauses }}</p>

                    <small class="d-block text-muted">{{ $ticket->event->date}} | {{ $ticket->event->location}}</small>
                    <div class="text-end mt-2">
                        <a href="{{ route('event.ticket.edit', $ticket->id) }}" class="text-decoration-none text-success me-2"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                        <button class="delete_ticket delete" data-id="{{ $ticket->id }}"><i class="fa-solid fa-trash"></i>Delete</button>
                    </div>
                </div>
            </div>

            @empty
            <p class="text-muted fst-italic">No brought tickets yet....</p>
            @endforelse

        </div>

    </div>




    @endsection