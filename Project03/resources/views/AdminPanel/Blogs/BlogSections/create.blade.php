@extends('AdminPanel.layout.app')

@section('blogs')

<div class="container">


    <div class="head mx-auto mb-2">
        <a href="{{ route('blog.show', $blog_id) }}" class="back mt-auto w-25"><i class="fa-solid fa-arrow-left"></i> Go Back</a>
        <h1 class="text-secondary text-end fst-italic m-0 mt-auto w-75">Create Blog Section</h1>
    </div>
    <hr>

    <form id="blogSection-form" method="POST" class="form-column d-flex flex-wrap align-itemns-start justify-content-between mx-auto">
        @csrf

        <input type="hidden" name="blog_id" id="blog_id" value="{{ $blog_id }}">

        <div class="coolinput">
            <label for="order" class="text">Order:</label>
            <input type="number" name="order" id="order" class="input" placeholder="Write order of the section...">
            <small class="order-error error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="section_title" class="text">Section Title:</label>
            <input type="text" name="section_title" id="section_title" class="input" placeholder="Write title of the section...">
            <small class="section_title-error error-message text-danger fw-bold d-block"></small>
        </div>


        <div class="coolinput">
            <label for="section_content" class="text">Section Content:</label>
            <textarea name="section_content" id="section_content" class="input" placeholder="Write the content of the section"></textarea>
            <small class="section_content-error error-message text-danger fw-bold d-block"></small>
        </div>



        <div class="coolinput">
            <button class="btn-create my-auto fst-italic fw-bold" type="submit">Create</button>
        </div>



    </form>

</div>

@endsection