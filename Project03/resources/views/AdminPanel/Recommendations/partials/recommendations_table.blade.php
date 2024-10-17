<table class="table table-hover mt-4">

    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">From User</th>
            <th scope="col">For User</th>
            <th scope="col">Content</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody id="recommendationsTable">
        @forelse($recommendations as $recommendation)

        <tr id="recommendation-{{ $recommendation->id }}">
            <td data-label="#">{{$recommendation->id }}</td>
            <td data-label="From User"><a href="{{ route('user.show', $recommendation->fromUser->id) }}" target="_blank" class="link">{{ $recommendation->fromUser->name }} {{ $recommendation->fromUser->surname }} </a> </td>
            <td data-label="For User"><a href="{{ route('user.show', $recommendation->forUser->id) }}" target="_blank" class="link">{{ $recommendation->forUser->name }} {{ $recommendation->forUser->surname }} </a> </td>
            <td data-label="Content">{{ $recommendation->content}}</td>

            <td>
                <button class="delete_recommendation delete" data-id="{{ $recommendation->id }}"><i class="fa-solid fa-trash"></i>Delete</button>
            </td>
        </tr>

        @empty
        <tr>
            <td colspan="5">No recommendations found.</td>
        </tr>
        @endforelse
    </tbody>
</table>
<div class="">
    {{ $recommendations->links('pagination::bootstrap-5') }}
</div>