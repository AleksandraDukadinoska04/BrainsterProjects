<table class="table table-hover mt-4">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">User</th>
            <th scope="col">Blog</th>
            <th scope="col">Comment</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody id="commentsTable">
        @forelse($comments as $comment)

        <tr id="comment-{{ $comment->id }}">
            <td data-label="#">{{$comment->id }}</td>
            <td data-label="User"><a href="{{ route('user.show', $comment->user->id) }}" target="_blank" class="link">{{ $comment->user->name }} {{ $comment->user->surname }}</a></td>

            <td data-label="Blog"><a href="{{ route('blog.show', $comment->blog->id) }}" target="_blank" class="link">{{$comment->blog->title }}</a></td>
            <td data-label="Comment">{{$comment->content }}</td>

            <td>

                <button class="delete_comment delete" data-id="{{ $comment->id }}"><i class="fa-solid fa-trash"></i>Delete</button>

            </td>
        </tr>

        @empty
        <tr>
            <td colspan="4">No comments found.</td>
        </tr>
        @endforelse
    </tbody>
</table>
<div class="">
    {{ $comments->links('pagination::bootstrap-5') }}
</div>