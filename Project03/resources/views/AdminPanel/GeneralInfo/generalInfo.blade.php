@extends('AdminPanel.layout.app')

@section('generalInfo')

<div class="container d-flex align-items-center justify-content-center">
    <div class="table-width">

        @forelse($generalInfos as $generalInfo)

        <div class=" d-flex align-items-center justify-content-between px-4">
            <h2 class="color-gray fw-bold fst-italic m-0">General Info</h2>
            <a href="{{ route('generalInfo.edit', $generalInfo->id) }}" class="text-decoration-none btn btn-success "><i class="fa-solid fa-pen-to-square"></i>Edit</a>

        </div>
        <hr class="w-100 mt-2 mb-3">


        <div class=" mx-auto">
            <div class="">
                <p class="color-darkorange fw-bold fst-italic fs-5">Hero title | <span class="color-gray fw-normal fs-6">{{ $generalInfo->hero_title }}</span></p>

            </div>

            <div class="">

                <p class="color-darkorange fw-bold fst-italic fs-5">Hero Image | <a href="{{ $generalInfo->hero_image }}" target="_blank" class="color-gray hover-darkorange fs-6"> {{ $generalInfo->hero_image }} </a></p>


            </div>

            <div class="">

                <p class="color-darkorange fw-bold fst-italic fs-5">Logo | <a href="{{ $generalInfo->logo }}" target="_blank" class="color-gray hover-darkorange fs-6"> {{ $generalInfo->logo }} </a></p>


            </div>


            <div class="">

                <p class="color-darkorange fw-bold fst-italic fs-5"><i class="fa-solid fa-envelope"></i> | <span class="color-gray fw-normal fs-6">{{ $generalInfo->email }}</span></p>


            </div>

            <div class="">

                <p class="color-darkorange fw-bold fst-italic fs-5"><i class="fa-solid fa-location-dot"></i> | <span class="color-gray fw-normal fs-6">{{ $generalInfo->address }}</span></p>


            </div>

            <div class="">

                <p class="color-darkorange fw-bold fst-italic fs-5"><i class="fa-brands fa-square-facebook"></i> | <a href="{{ $generalInfo->facebook }}" target="_blank" class="color-gray hover-darkorange fs-6"> {{ $generalInfo->facebook }} </a></p>


            </div>

            <div class="">

                <p class="color-darkorange fw-bold fst-italic fs-5"><i class="fa-brands fa-square-instagram"></i> | <a href="{{ $generalInfo->instagram }}" target="_blank" class="color-gray hover-darkorange fs-6"> {{ $generalInfo->instagram }} </a></p>


            </div>
            <div class="">
                <p class="color-darkorange fw-bold fst-italic fs-5"><i class="fa-brands fa-youtube"></i> | <a href="{{ $generalInfo->youtube }}" target="_blank" class="color-gray hover-darkorange fs-6"> {{ $generalInfo->youtube }} </a></p>

            </div>
            <div class="">
                <p class="color-darkorange fw-bold fst-italic fs-5"><i class="fa-brands fa-linkedin"></i> | <a href="{{ $generalInfo->linkedin }}" target="_blank" class="color-gray hover-darkorange fs-6"> {{ $generalInfo->linkedin }} </a></p>
            </div>

        </div>
        @empty
        <p class="text-muted text-center fst-italic">No General Info yet...</p>
        @endforelse

    </div>
</div>



@endsection