<table class="table table-hover mt-4 shadow">
    <thead class="table-warning">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <!-- <th scope="col">Image</th> -->
            <th scope="col">Theme</th>
            <!-- <th scope="col">Description</th>
                    <th scope="col">Objective</th> -->
            <th scope="col">Location</th>
            <th scope="col">Date</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody id="eventsTable">
        @forelse($events as $event)

        <tr id="event-{{ $event->id }}" class="eventRow" data-event-title-id="{{ $event->title_id }}">
            <td data-label="#">{{ $event->id }}</td>
            <td data-label="Title">{{ $event->eventTitle->title }}</td>
            <!-- <td>{{ $event->img }}</td> -->
            <td data-label="Theme">{{ $event->theme }}</td>
            <!-- <td>{{ $event->description }}</td>
                    <td>{{ $event->objective }}</td> -->
            <td data-label="Location">{{ $event->location }}</td>
            <td data-label="Date">{{ $event->date }}</td>
            <td>
                <div class="d-block">
                    <a href="{{ route('event.show', $event->id) }}" class="preview d-flex align-items-center my-1 mx-2 justify-content-start text-decoration-none"><i class="fa-solid fa-eye "></i> Preview</a>
                </div>
                <div class="d-block">
                    <a href="{{ route('event.edit' , $event->id) }}" class="text-decoration-none text-success my-1 mx-2 d-flex align-items-center justify-content-start"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                </div>
                <div class="d-block">
                    <button class="delete_event delete d-flex align-items-center justify-content-start p-0 my-1 mx-2" data-id="{{ $event->id }}"><i class="fa-solid fa-trash"></i>Delete</button>
                </div>
            </td>
        </tr>

        @empty
        <tr>
            <td colspan="6">No events found.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="">
    {{ $events->links('pagination::bootstrap-5') }}
</div>