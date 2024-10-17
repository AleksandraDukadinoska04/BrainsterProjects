@extends('AdminPanel.layout.app')

@section('employees')


<div class="container d-flex align-items-center justify-content-center">
    <div class="table-width">
        <div class="top">
            <a href="{{ route('employee.create') }}" class="d-block my-2"><button class="btn-create fw-bold " type="button"><i class="fa-solid fa-plus me-1 "></i>Create Employee</button></a>
            <div class="m-0 p-0 d-flex align-items-center search">
                <input type="text" name="searchEmployees" id="searchEmployees" placeholder="Search..." class="form-control me-2">
                <label for="searchEmployees"><i class="fa-solid fa-magnifying-glass search my-auto"></i></label>
            </div>
        </div>

        <div id="employees-table">
            @include('AdminPanel.Employees.partials.employees_table', ['employees' => $employees])
        </div>


    </div>
</div>




@endsection