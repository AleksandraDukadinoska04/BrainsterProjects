@extends('AdminPanel.layout.app')

@section('feedbacks')

<div class="container d-flex align-items-center justify-content-center">
    <div class="table-width">

        <div class="d-flex align-items-center justify-content-end">
            <div class="onlySearch m-0 p-0 d-flex align-items-center">
                <input type="text" name="searchFeedbacks" id="searchFeedbacks" placeholder="Search..." class="form-control me-2">
                <label for="searchFeedbacks"><i class="fa-solid fa-magnifying-glass search my-auto"></i></label>
            </div>
        </div>


        <div id="feedbacks-table">
            @include('AdminPanel.Feedbacks.partials.feedbacks_table', ['feedbacks' => $feedbacks])
        </div>


    </div>
</div>




@endsection