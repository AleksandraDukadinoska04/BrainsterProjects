@extends('AdminPanel.layout.app')

@section('blogs')

<div class="container">


    <div class="head mx-auto mb-2">
        <a href="{{ route('blogs') }}" class="back mt-auto"><i class="fa-solid fa-arrow-left"></i> Go Back</a>
        <h1 class="text-secondary text-end fst-italic m-0 mt-auto">Create Blog</h1>
    </div>
    <hr>

    <form id="blog-form" method="POST" class="form-column d-flex flex-column align-itemns-start justify-content-between mx-auto">
        @csrf

        <div class="w-100  wrap">

            <div class="coolinput">
                <label for="title" class="text">Title</label>
                <input type="text" name="title" id="title" class="input" placeholder="Write title..." value="{{ old('title') }}">
                <small id="title-error" class="error-message text-danger fw-bold d-block"></small>

            </div>

            <div class="coolinput">
                <label for="img" class="text">Image URL</label>
                <input type="url" name="img" id="img" class="input" placeholder="Enter Image URL..." value="{{ old('img') }}">
                <small id="img-error" class="error-message text-danger fw-bold d-block"></small>
            </div>
        </div>

        <div class="w-100">
            <h3 class="text-secondary text-start fst-italic mb-2 mt-4">Body of the Blog</h3>

            <div id="sections" class="d-flex align-itemns-center justify-content-center flex-wrap">
                <div class="section w-100 d-flex flex-wrap align-itemns-start justify-content-between border-bottom pb-3 mb-3">
                    <div class="coolinput">
                        <label for="section_order" class="text">Order:</label>
                        <input type="number" name="order[]" class="section-order input" placeholder="Write order of the section...">
                        <small class="order-error error-message text-danger fw-bold d-block"></small>
                    </div>

                    <div class="coolinput">
                        <label for="section_title" class="text">Section Title:</label>
                        <input type="text" name="section_title[]" class="section-title input" placeholder="Write title of the section...">
                        <small class="section_title-error error-message text-danger fw-bold d-block"></small>
                    </div>


                    <div class="coolinput">
                        <label for="section_body" class="text">Section Body:</label>
                        <textarea name="section_body[]" class="section-body input" placeholder="Write the content of the section..."></textarea>
                        <small class="section_body-error error-message text-danger fw-bold d-block"></small>
                    </div>

                    <div class="coolinput">
                        <button type="button" class="remove-section btn-create my-auto fst-italic fw-bold">Remove Section<i class="fa-solid fa-trash ms-2"></i></button>
                    </div>

                </div>
            </div>
        </div>

        <div class="d-flex align-items-start justify-content-between">
            <div class="coolinput ">
                <button type="button" id="addSection" class="btn-create my-auto fst-italic fw-bold"><i class="fa-solid fa-plus me-1 "></i>Add Section</button>
            </div>

            <div class="coolinput">
                <button class="btn-create my-auto fst-italic fw-bold" type="submit">Create</button>
            </div>
        </div>


    </form>

</div>

@endsection