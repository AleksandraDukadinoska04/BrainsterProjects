@extends('AdminPanel.layout.app')

@section('events')

<div class="container">

    <div class="head mx-auto mb-2">
        <a href="{{ route('event.show', $event_id) }}" class="back mt-auto"><i class="fa-solid fa-arrow-left"></i> Go Back</a>
        <h1 class="text-secondary text-end fst-italic m-0 mt-auto">Create Ticket</h1>
    </div>
    <hr>

    <form id="ticket-form" method="POST" class="form-column d-flex align-itemns-start justify-content-between flex-wrap mx-auto">
        @csrf

        <input type="hidden" name="event_id" id="event_id" value="{{ $event_id }}">


        <div class="coolinput">
            <label for="ticket_type" class="text">Ticket Type</label>
            <select name="ticket_type" id="ticket_type" class="input">
                <option value="" selected disabled>Choose ticket type...</option>
                <option value="person" {{ old('for') === 'person' ? 'selected' : ''}}>Person</option>
                <option value="company" {{ old('for') === 'company' ? 'selected' : ''}}>Company</option>
            </select>
            <small id="ticket_type-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="price" class="text">Price</label>
            <input type="text" name="price" id="price" class="input" placeholder="Write price..." value="{{ old('price') }}">
            <small id="price-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="quantity" class="text">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="input" placeholder="Write quantity number..." value="{{old('quantity')}}">
            <small id="quantity-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="seats" class="text">Seats</label>
            <input type="number" name="seats" id="seats" class="input" placeholder="Write seats number..." value="{{old('seats')}}">
            <small id="seats-error" class="error-message text-danger fw-bold d-block"></small>
        </div>


        <div class="coolinput">
            <label for="pauses" class="text">Pauses</label>
            <textarea name="pauses" id="pauses" class="input" placeholder="Write pauses...">{{old('pauses')}}</textarea>
            <small id="pauses-error" class="error-message text-danger fw-bold d-block"></small>
        </div>
        <div class="coolinput">
            <label for="wifi" class="text">WiFi</label>
            <input type="text" name="wifi" id="wifi" class="input" placeholder="0/1" value="{{old('wifi')}}">
            <small id="wifi-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput"></div>

        <div class="coolinput mt-3">
            <button class="btn-create my-auto fst-italic fw-bold" type="submit">Create</button>
        </div>

    </form>

</div>

@endsection