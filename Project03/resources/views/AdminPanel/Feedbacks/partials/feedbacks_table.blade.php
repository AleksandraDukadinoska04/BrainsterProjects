<table class="table table-hover mt-4 shadow">

    <thead class="table-warning">
        <tr>
            <th scope="col">#</th>
            <th scope="col">From User</th>
            <th scope="col">Feedback</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody id="feedbacksTable">
        @forelse($feedbacks as $feedback)

        <tr id="feedback-{{ $feedback->id }}">

            <td data-label="#">{{ $feedback->id }}</td>
            <td data-label="From User">
                <a href="{{ route('user.show', $feedback->user_id) }}" class="link">
                    {{ $feedback->user->name }} {{ $feedback->user->surname }} </a>
            </td>
            <td data-label="Feedback">{{ $feedback->content }}</th>
            <td>
                <button class="delete_feedback delete d-flex align-items-center justify-content-center" data-id="{{ $feedback->id }}"><i class="fa-solid fa-trash me-1"></i>Delete</button>

            </td>
        </tr>

        @empty
        <tr>
            <td colspan="4">No feedback found.</td>
        </tr>
        @endforelse
    </tbody>
</table>
<div class="">
    {{ $feedbacks->links('pagination::bootstrap-5') }}
</div>