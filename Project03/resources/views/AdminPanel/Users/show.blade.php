@extends('AdminPanel.layout.app')

@section('users')

<div class="container-md ">
    <div class="d-flex align-items-center justify-content-between form-column mx-auto mb-3">
        <a href="{{ route('users') }}" class="back mt-auto"><i class="fa-solid fa-arrow-left"></i> Go Back</a>
        <div class="">
            <a href="{{ route('user.edit' , $user) }}" class="text-decoration-none text-success mx-3"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
            <button class="delete_user delete" data-id="{{ $user->id }}"><i class="fa-solid fa-trash"></i>Delete</button>
        </div>
    </div>

    <div class=" form-column user-profile mx-auto ">
        <div class="responsive-width image">
            <h3 class="text-center color-darkorange fst-italic text-decoration-underline">{{ $user->name }} {{ $user->surname }}</h3>
            <div class="w-50 mx-auto border-top pt-2">
                <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('images/default.jpg') }}" alt="User Photo" class="w-100">
            </div>
        </div>
        <div class="responsive-width info">
            <p class="fst-italic color-gray"><i class="fa-solid fa-user color-darkorange"></i> | {{ $user->profession }}</p>
            <p class="fst-italic color-gray"><i class="fa-solid fa-location-dot color-darkorange"></i> | {{ $user->city }}, {{ $user->country }}</p>
            <p class="fst-italic color-gray"><i class="fa-solid fa-phone color-darkorange"></i> | {{ $user->phone ? $user->phone : 'None' }}</p>
            <p class="fst-italic color-gray"><i class="fa-solid fa-envelope color-darkorange"></i> | {{ $user->email }}</p>
            <p class="fst-italic color-gray"><i class="fa-solid fa-file color-darkorange"></i> |
                @if ($user->CV)
                <a href="{{ asset('storage/' . $user->CV) }}" download target="_blank">Download CV</a>
                @else
                None
                @endif
            </p>
            <p class="fst-italic color-gray" data-bs-toggle="modal" data-bs-target="#friendsModal"><i class="fa-solid fa-user-group color-darkorange"></i> | <span class="cursor-pointer text-primary text-decoration-underline">See list of friends</span></p>

            <div class="d-flex flex-wrap align-items-start justify-content-between fst-italic ">
                <p class="responsive-width color-darkorange fw-bold">Notification target preference:
                    @if($targets !== null)
                    @foreach($targets as $target)
                    <small class="color-gray me-1">{{ $target }},</small>
                    @endforeach
                    @else
                    <small class="color-gray me-1">None</small>
                    @endif
                </p>
                <p class="responsive-width color-darkorange fw-bold">Notification topic preference:
                    @if($topics !== null)
                    @foreach($topics as $topic)
                    <small class="color-gray me-1">{{ $topic }}, </small>
                    @endforeach
                    @else
                    <small class="color-gray me-1">None</small>
                    @endif
                </p>
            </div>
        </div>
    </div>

    <div class="form-column mx-auto my-3">
        <h3 class="color-darkorange fw-bold fst-italic border-bottom pb-2 ">Bio:</h3>
        <p class="color-gray fst-italic">{{ $user->bio ? $user->bio : 'None' }}</p>
    </div>
    <br><br>
    <hr class="w-100">

    <div class="my-5">
        <h2 class="color-darkorange fw-bold fst-italic border-bottom pb-2 text-center">Recommendations</h2>
        <div class="responsive-flex">
            <div class="responsive-width">
                <h4 class="color-grey fw-bold fst-italic  text-center mb-3">Received</h4>
                <div class="scroll">
                    @forelse($receivedRecomendations as $receivedRecomendation)
                    <div id="recommendation-{{ $receivedRecomendation->id }}">
                        <div class="d-flex justify-content-between align-items-start">
                            <p class="color-darkorange fw-bold fst-italic">From: <a href="{{ route('user.show', $receivedRecomendation->fromUser->id) }}" target="_blank"> {{ $receivedRecomendation->fromUser->name}} {{ $receivedRecomendation->fromUser->surname}} </a>
                            </p>
                            <button class="delete_recommendation delete fst-italic" data-id="{{ $receivedRecomendation->id }}">Delete <i class="fa-solid fa-trash"></i></button>
                        </div>
                        <p class="color-gray fst-italic border-bottom pb-2">{{ $receivedRecomendation->content}}</p>
                    </div>
                    @empty
                    <p class="text-muted fst-italic text-center">No received recommendations yet...</p>
                    @endforelse
                </div>
            </div>
            <div class="responsive-width ">
                <h4 class="color-grey fw-bold fst-italic  text-center mb-3">Given</h4>
                <div class="scroll">
                    @forelse($givenRecomendations as $givenRecomendation)
                    <div id="recommendation-{{ $givenRecomendation->id }}">
                        <div class="d-flex justify-content-between align-items-start">
                            <p class="color-darkorange fw-bold fst-italic">For: <a href="{{ route('user.show', $givenRecomendation->forUser->id) }}" target="_blank"> {{ $givenRecomendation->forUser->name}} {{ $givenRecomendation->forUser->surname}}</a> </p>
                            <button class="delete_recommendation delete fst-italic" data-id="{{ $givenRecomendation->id }}">Delete <i class="fa-solid fa-trash"></i></button>
                        </div>
                        <p class="color-gray fst-italic border-bottom pb-2">{{ $givenRecomendation->content}}</p>
                    </div>
                    @empty
                    <p class="text-muted fst-italic text-center">No given recommendations yet...</p>
                    @endforelse
                </div>
            </div>


        </div>

    </div>

    <hr class="w-100">

    <div class="my-5">
        <h2 class="color-darkorange fw-bold fst-italic border-bottom pb-2 text-center mb-4">Brought tickets</h2>
        <div class="tickets">
            @forelse($tickets as $ticket)
            @if ($ticket->ticket->event && !$ticket->ticket->event->trashed() && $ticket->ticket->event->eventTitle->title)

            <div class="ticket inner rounded-5 bg-white shadow p-4">
                <div class="ticket-img">
                    <div class="rounded-5 rounded-top-0" style='background-image: url("{{ $ticket->ticket->event->img }}") ; background-position: center; background-size: cover;'>
                        <div class="overlay w-100 h-100 rounded-5 rounded-top-0  d-flex flex-center align-items-start justify-content-center py-4 text-white">
                            <i class="fa-solid fa-ticket ticket-icon"></i>
                        </div>
                    </div>

                </div>
                <div class="ticket-text">
                    <h4 class="color-darkorange fw-bold fst-italic d-inline">{{$ticket->ticket->event->eventTitle->title}} :</h4>
                    <p class="color-gray fw-bold d-inline">{{ $ticket->ticket->event->theme }}</p>
                    <small class="d-block text-muted">{{ $ticket->ticket->event->date}} | {{ $ticket->ticket->event->location}}</small>

                </div>
            </div>
            @endif
            @empty
            <p class="text-muted fst-italic">No brought tickets yet....</p>
            @endforelse
        </div>

    </div>
    <hr class="w-100">

    <div class="my-5 d-flex align-items-start justify-content-between">
        <div class="w-50">
            <h3 class="color-darkorange fst-italic fw-bold text-center">Points</h3>
        </div>
        <div class="w-50">
            <h3 class="color-darkorange fst-italic fw-bold text-center">Badges</h3>
        </div>
    </div>
</div>







<!-- Friends Modal -->
<div class="modal fade" id="friendsModal" tabindex="-1" aria-labelledby="friendsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 color-gray fw-bold fst-italic" id="friendsModalLabel">Friends List: <small class="color-darkorange">{{ $friends->count() }} Friends</small></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @forelse($friends as $friend)

                @if($friend->user_id == $user->id)
                <a href="{{ route('user.show', $friend->connectedUser->id) }}" target="_blank" class="d-flex alignt-items-start justify-content-start text-decoration-none border-bottom pb-2 mb-2">
                    <div class="w-25">
                        <img src="{{ $friend->connectedUser->photo ? asset('storage/' . $friend->connectedUser->photo) : asset('images/default.jpg') }}" alt="Friend Photo" class="w-75 rounded-circle">
                    </div>
                    <div class="w-75 my-auto">
                        <p class="color-darkorange fw-bold fst-italic m-0">{{ $friend->connectedUser->name}} {{ $friend->connectedUser->surname}}</p>
                        <small class="color-gray fw-bold fst-italic">{{ $friend->connectedUser->profession}}</small>
                    </div>
                </a>
                @else
                <a href="{{ route('user.show', $friend->user->id) }}" target="_blank" class="d-flex alignt-items-start justify-content-start text-decoration-none border-bottom pb-2 mb-2">
                    <div class="w-25">
                        <img src="{{ $friend->user->photo ? asset('storage/' . $friend->user->photo) : asset('images/default.jpg') }}" alt="Friend Photo" class="w-75 rounded-circle">
                    </div>
                    <div class="w-75 my-auto">
                        <p class="color-darkorange fw-bold fst-italic m-0"> {{ $friend->user->name}} {{ $friend->user->surname}}</p>
                        <small class="color-gray fw-bold fst-italic">{{ $friend->user->profession}}</small>
                    </div>
                </a>
                @endif
                @empty
                <p class="text-muted fst-italic">No friends yet....</p>
                @endforelse
            </div>

        </div>
    </div>
</div>

@endsection