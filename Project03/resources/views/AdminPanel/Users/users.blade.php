@extends('AdminPanel.layout.app')

@section('users')

<div class="container d-flex align-items-center justify-content-center">
    <div class="table-width">

        <div class="top">
            <a href="{{ route('user.create') }}" class="d-block my-2"><button class="btn-create fw-bold " type="button"><i class="fa-solid fa-plus me-1 "></i>Create User</button></a>
            <div class="m-0 p-0 d-flex align-items-center search">
                <input type="text" name="searchUsers" id="searchUsers" placeholder="Search..." class="form-control me-2">
                <label for="searchUsers"><i class="fa-solid fa-magnifying-glass search my-auto"></i></label>
            </div>
        </div>

        <div id="users-table" class="">
            @include('AdminPanel.Users.partials.users_table', ['users' => $users])
        </div>

    </div>

</div>




@endsection