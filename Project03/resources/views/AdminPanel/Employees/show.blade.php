@extends('AdminPanel.layout.app')

@section('employees')

<div class="container-md">
    <div class="d-flex align-items-center justify-content-between form-column mx-auto mb-3">
        <a href="{{ route('employees') }}" class="back mt-auto"><i class="fa-solid fa-arrow-left"></i> Go Back</a>
        <div class="">
            <a href="{{ route('employee.edit' , $employee) }}" class="text-decoration-none text-success mx-3"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
            <button class="delete_employee delete" data-id="{{ $employee->id }}"><i class="fa-solid fa-trash"></i>Delete</button>
        </div>
    </div>

    <div class=" form-column user-profile mx-auto">
        <div class="responsive-width image">
            <h3 class="text-center color-darkorange fst-italic text-decoration-underline">{{ $employee->name }} {{ $employee->surname }}</h3>
            <div class="w-50 mx-auto border-top pt-2">
                <img src="{{ $employee->img}}" alt="" class="w-100">
            </div>
        </div>
        <div class="responsive-width info ">
            <div class="">
                <p class="fst-italic color-gray"><i class="fa-solid fa-user color-darkorange"></i> | {{ $employee->profession }}</p>
                <p class="fst-italic color-gray"> <span class="color-darkorange fw-bold">Bio</span> | {{ $employee->bio }}</p>
            </div>
            <div class="mt-3">
                <a href="{{ $employee->facebook }}" class="color-gray hover-darkorange text-decoration-none me-2 fs-5" target="_blank"><i class="fa-brands fa-square-facebook"></i></a>
                <a href="{{ $employee->twitter }}" class="color-gray hover-darkorange text-decoration-none me-2 fs-5" target="_blank"><i class="fa-brands fa-square-instagram"></i></a>
                <a href="{{ $employee->instagram }}" class="color-gray hover-darkorange text-decoration-none me-2 fs-5" target="_blank"><i class="fa-brands fa-square-twitter"></i></a>
                <a href="{{ $employee->linkedin}}" class="color-gray hover-darkorange text-decoration-none fs-5" target="_blank"><i class="fa-brands fa-linkedin"></i></a>
            </div>
        </div>
    </div>

</div>





@endsection