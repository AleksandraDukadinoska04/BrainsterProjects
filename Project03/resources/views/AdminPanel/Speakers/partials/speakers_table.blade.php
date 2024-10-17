<table class="table table-hover mt-4">

    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Surname</th>
            <!-- <th scope="col">Image</th> -->
            <th scope="col">Profession</th>
            <!-- <th scope="col">Linkedin</th> -->
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody id="speakersTable">
        @forelse($speakers as $speaker)

        <tr id="speaker-{{ $speaker->id }}">
            <td data-label="#">{{ $speaker->id }}</td>
            <td data-label="Name">{{ $speaker->name}}</td>
            <td data-label="Surname">{{ $speaker->surname }}</td>
            <!-- <td>{{ $speaker->img }}</td> -->
            <td data-label="Profession">{{ $speaker->profession }}</td>
            <!-- <td>{{ $speaker->linkedin }}</td> -->
            <td class="">
                <div class="d-flex">
                    <a href="{{ route('speaker.show', $speaker->id) }}" class="preview my-1 mx-2  d-flex align-items-center justify-content-start"><i class="fa-solid fa-eye"></i> Preview</a>
                    <a href="{{ route('speaker.edit' , $speaker->id) }}" class="text-decoration-none text-success my-1 mx-2 d-flex align-items-center justify-content-start"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                    <button class="delete_speaker delete my-1 mx-2 d-flex align-items-center justify-content-start p-0" data-id="{{ $speaker->id }}"><i class="fa-solid fa-trash "></i>Delete</button>
                </div>
            </td>
        </tr>

        @empty
        <tr>
            <td colspan="5">No speakers found.</td>
        </tr>
        @endforelse
    </tbody>
</table>
<div class="">
    {{ $speakers->links('pagination::bootstrap-5') }}
</div>