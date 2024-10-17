@extends('AdminPanel.layout.app')

@section('events')

<div class="container d-flex align-items-center justify-content-center">
    <div class="table-width">

        <div class="top">
            <div class="">
                <a href="{{ route('event.create') }}" class="d-block my-2"><button class="btn-create fw-bold " type="button"><i class="fa-solid fa-plus me-1 "></i>Create Event</button></a>
                <a href="{{ route('event.titles') }}" class="d-block my-2"><button class="btn-create fw-bold " type="button"><i class="fa-solid fa-eye"></i> See Event Titles</button></a>
            </div>
            <div class="m-0 p-0 d-flex align-items-center search">
                <input type="text" name="searchEvents" id="searchEvents" placeholder="Search..." class="form-control me-2">
                <label for="searchEvents"><i class="fa-solid fa-magnifying-glass search my-auto"></i></label>
            </div>
        </div>

        <div class="form-group my-4">
            <div class="eventFilters">
                @foreach($eventTitles as $eventTitle)
                <div class="form-check form-check-inline">
                    <span class="custom-radio"></span>
                    <input class="form-check-input" type="radio" name="eventTitle" id="eventTitle{{ $eventTitle->id }}" value="{{ $eventTitle->id }}">
                    <label class="form-check-label" for="eventTitle{{ $eventTitle->id }}">{{ $eventTitle->title }}</label>
                </div>
                @endforeach

                <div class="form-check form-check-inline">
                    <span class="custom-radio"></span>
                    <input class="form-check-input" type="radio" name="eventTitle" id="eventTitleAll" value="all" checked>
                    <label class="form-check-label" for="eventTitleAll">Show All</label>
                </div>
            </div>
        </div>


        <div id="events-table">
            @include('AdminPanel.Events.partials.events_table', ['events' => $events])
        </div>

    </div>

</div>




@endsection