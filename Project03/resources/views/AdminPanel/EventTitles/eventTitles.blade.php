@extends('AdminPanel.layout.app')

@section('events')

<div class="container d-flex align-items-center justify-content-center">
    <div class="table-width">


        <div class="top">
            <a href="{{ route('event.title.create') }}" class="d-block my-2"><button class="btn-create fw-bold " type="button"><i class="fa-solid fa-plus me-1 "></i>Create Event Title</button></a>
            <div class="m-0 p-0 d-flex align-items-center search">
                <input type="text" name="searchEventTitles" id="searchEventTitles" placeholder="Search..." class="form-control me-2">
                <label for="searchEventTitles"><i class="fa-solid fa-magnifying-glass search my-auto"></i></label>
            </div>
        </div>


        <div id="eventTitles-table">
            @include('AdminPanel.EventTitles.partials.eventTitles_table', ['eventTitles' => $eventTitles])
        </div>



    </div>
</div>




@endsection