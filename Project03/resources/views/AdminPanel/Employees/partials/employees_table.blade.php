<table class="table table-hover mt-4">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Surname</th>
            <!-- <th scope="col">Image</th> -->
            <th scope="col">Profession</th>
            <!-- <th scope="col">Bio</th> -->
            <!-- <th scope="col">Facebook</th> -->
            <!-- <th scope="col">Instagram</th> -->
            <!-- <th scope="col">Linkedin</th> -->
            <!-- <th scope="col">Twitter</th> -->
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody id="employeesTable">
        @forelse($employees as $employee)

        <tr id="employee-{{ $employee->id }}">
            <td data-label="#">{{ $employee->id }}</td>
            <td data-label="Name">{{ $employee->name }}</td>
            <td data-label="Surname">{{ $employee->surname }}</td>
            <!-- <td>{{ $employee->img }}</td> -->
            <td data-label="Proffesion">{{ $employee->profession }}</td>
            <!-- <td>{{ $employee->bio }}</td> -->
            <!-- <td>{{ $employee->facebook }}</td> -->
            <!-- <td>{{ $employee->instagram }}</td> -->
            <!-- <td>{{ $employee->linkedin }}</td> -->
            <!-- <td>{{ $employee->twitter }}</td> -->

            <td>
                <div class="d-flex">
                    <a href="{{ route('employee.show', $employee->id) }}" class="preview d-flex align-items-center"><i class="fa-solid fa-eye"></i> Preview</a>
                    <a href="{{ route('employee.edit' , $employee->id) }}" class="text-decoration-none text-success mx-3 d-flex align-items-center"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                    <button class="delete_employee delete d-flex align-items-center" data-id="{{ $employee->id }}"><i class="fa-solid fa-trash"></i>Delete</button>
                </div>
            </td>
        </tr>

        @empty
        <tr>
            <td colspan="5">No employees found.</td>
        </tr>
        @endforelse
    </tbody>
</table>
<div class="">
    {{ $employees->links('pagination::bootstrap-5') }}
</div>