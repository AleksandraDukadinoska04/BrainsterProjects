<table class="table table-hover mt-4 shadow ">
    <thead class="table-warning">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody id="eventTitlesTable">
        @forelse($eventTitles as $title)

        <tr id="eventTitle-{{ $title->id }}">
            <td data-label="#">{{ $title->id }}</td>
            <td data-label="Title">{{ $title->title }}</td>
            <td>
                <a href="{{ route('event.title.edit', $title->id) }}" class="text-decoration-none text-success me-3"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                <button class="delete_eventTitle delete" data-id="{{ $title->id }}"><i class="fa-solid fa-trash"></i>Delete</button>
            </td>
        </tr>

        @empty
        <tr>
            <td colspan="4">No event title found.</td>
        </tr>
        @endforelse
    </tbody>
</table>
<div class="">
    {{ $eventTitles->links('pagination::bootstrap-5') }}
</div>