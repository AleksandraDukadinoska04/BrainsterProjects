@extends('AdminPanel.layout.app')

@section('blogs')

<div class="container">

    <div class="head mx-auto mb-2">
        <a href="{{ route('blog.show', $section->blog_id) }}" class="back mt-auto w-50"><i class="fa-solid fa-arrow-left"></i> Go Back</a>
        <h1 class="text-secondary text-end fst-italic m-0 mt-auto w-50">Edit Blog Section</h1>
    </div>
    <hr>


    <form id="edit-blogSection-form" data-id="{{ $section->id }}" class="form-column d-flex align-itemns-start justify-content-between flex-wrap mx-auto">
        @csrf
        @METHOD('PUT')

        <div class="coolinput">
            <label for="order" class="text">Order:</label>
            <input type="number" name="order" id="order" class="input" placeholder="Write order of the section..." value="{{ $section->order}}">
            <small id="order-error" class=" error-message text-danger fw-bold d-block"></small>
        </div>

        <div class="coolinput">
            <label for="section_title" class="text">Section Title:</label>
            <input type="text" name="section_title" id="section_title" class="input" placeholder="Write title of the section..." value="{{ $section->section_title}}">
            <small id="section_title-error" class=" error-message text-danger fw-bold d-block"></small>
        </div>


        <div class="coolinput">
            <label for="section_content" class="text">Section Content:</label>
            <textarea name="section_content" id="section_content" class="input" placeholder="Write the content of the section">{{ $section->section_content}}</textarea>
            <small id="section_content-error" class=" error-message text-danger fw-bold d-block"></small>
        </div>


        <div class="coolinput">
            <button class="btn-create my-auto fst-italic fw-bold" type="submit">Update</button>
        </div>
    </form>

</div>

@endsection