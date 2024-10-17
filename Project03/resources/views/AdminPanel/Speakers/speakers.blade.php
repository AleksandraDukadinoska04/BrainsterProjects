@extends('AdminPanel.layout.app')

@section('speakers')

<div class="container d-flex align-items-center justify-content-center">

    <div class="table-width">

        <div class="top">
            <a href="{{ route('speaker.create') }}" class="d-block my-2"><button class="btn-create fw-bold " type="button"><i class="fa-solid fa-plus me-1 "></i>Create Speaker</button></a>
            <div class="m-0 p-0 d-flex align-items-center search">
                <input type="text" name="searchSpeakers" id="searchSpeakers" placeholder="Search..." class="form-control me-2">
                <label for="searchSpeakers"><i class="fa-solid fa-magnifying-glass search my-auto"></i></label>
            </div>
        </div>


        <div id="speakers-table">
            @include('AdminPanel.Speakers.partials.speakers_table', ['speakers' => $speakers])
        </div>



    </div>
</div>




@endsection