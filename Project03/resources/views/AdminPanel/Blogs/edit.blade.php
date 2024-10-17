@extends('AdminPanel.layout.app')

@section('blogs')

<div class="container">

    <div class="head mx-auto mb-2">
        <a href="{{ route('blogs') }}" class="back mt-auto"><i class="fa-solid fa-arrow-left"></i> Go Back</a>
        <h1 class="text-secondary text-end fst-italic m-0 mt-auto">Edit Blog</h1>
    </div>
    <hr>


    <form id="edit-blog-form" data-id="{{ $blog->id }}" class="form-column d-flex align-itemns-start justify-content-between flex-wrap mx-auto">
        @csrf
        @METHOD('PUT')

        <div class="coolinput">
            <label for="title" class="text">Title</label>
            <input type="text" name="title" id="title" class="input" placeholder="Write title..." value="{{ $blog->title }}">
            <small id="title-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="img" class="text">Image URL</label>
            <input type="url" name="img" id="img" class="input" placeholder="Enter Image URL..." value="{{ $blog->img }}">
            <small id="img-error" class="error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">

        </div>

        <div class="coolinput mt-2">
            <button class="btn-create my-auto fst-italic fw-bold" type="submit">Update</button>
        </div>

    </form>

</div>

@endsection