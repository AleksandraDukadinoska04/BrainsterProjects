@extends('AdminPanel.layout.app')

@section('recommendations')

<div class="container d-flex align-items-center justify-content-center">

    <div class="table-width">

        <div class="d-flex align-items-center justify-content-end">
            <div class="onlySearch m-0 p-0 d-flex align-items-center">
                <input type="text" name="searchRecommendations" id="searchRecommendations" placeholder="Search..." class="form-control me-2">
                <label for="searchRecommendations"><i class="fa-solid fa-magnifying-glass search my-auto"></i></label>
            </div>
        </div>

        <div id="recommendations-table">
            @include('AdminPanel.Recommendations.partials.recommendations_table', ['recommendations' => $recommendations])
        </div>



    </div>
</div>




@endsection