<table class="table table-hover  mt-4 shadow" id="">
    <thead class="table-warning">
        <tr>
            <th scope="col" data-label="#">#</th>
            <th scope="col" data-label="Name">Name</th>
            <th scope="col" data-label="Surname">Surname</th>
            <!-- <th scope="col">Bio</th>
                <th scope="col">Profession</th>
                <th scope="col">Phone</th>
                <th scope="col">City</th>
                <th scope="col">Country</th>
                <th scope="col">CV</th>
                <th scope="col">Photo</th>
                <th scope="col">Email</th> -->
            <th scope="col" data-label="">Action</th>
        </tr>
    </thead>
    <tbody id="usersTable">
        @forelse($users as $user)

        <tr id="user-{{ $user->id }}">
            <td data-label="#">{{ $user->id }}</td>
            <td data-label="Name:">{{ $user->name }}</td>
            <td data-label="Surname:">{{ $user->surname }}</td>
            <!-- <td>{{ $user->bio }}</td>
                <td>{{ $user->profession }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->city }}</td>
                <td>{{ $user->country }}</td>
                <td>{{ $user->CV }}</td>
                <td>{{ $user->photo }}</td>
                <td>{{ $user->email }}</td> -->
            <td data-label="">
                <div class="d-flex">
                    <a href="{{ route('user.show', $user->id) }}" class="preview d-flex align-items-center"><i class="fa-solid fa-eye"></i> Preview</a>
                    <a href="{{ route('user.edit' , $user) }}" class="d-flex text-decoration-none text-success mx-3 align-items-center"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                    <button class="delete_user delete d-flex align-items-center" data-id="{{ $user->id }}"><i class="fa-solid fa-trash"></i>Delete</button>
                </div>
            </td>
        </tr>

        @empty
        <tr>
            <td colspan="4">No users found.</td>
        </tr>
        @endforelse
    </tbody>
</table>
<div class="">
    {{ $users->links('pagination::bootstrap-5') }}
</div>