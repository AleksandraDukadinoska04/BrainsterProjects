@extends('AdminPanel.layout.app')

@section('comments')

<div class="container d-flex align-items-center justify-content-center">
    <div class="table-width">

        <div class="d-flex align-items-center justify-content-end">
            <div class="onlySearch m-0 p-0 d-flex align-items-center">
                <input type="text" name="searchComments" id="searchComments" placeholder="Search..." class="form-control me-2">
                <label for="searchComments"><i class="fa-solid fa-magnifying-glass search my-auto"></i></label>
            </div>
        </div>


        <div id="comments-table">
            @include('AdminPanel.Comments.partials.comments_table', ['comments' => $comments])
        </div>



    </div>
</div>




@endsection