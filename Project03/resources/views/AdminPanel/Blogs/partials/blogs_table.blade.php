<table class="table table-hover mt-4">
    <thead>
        <tr>
            <th scope="col" data-label="#">#</th>
            <th scope="col" data-label="Title">Title</th>
            <!-- <th scope="col">Image</th> -->
            <!-- <th scope="col">Body</th> -->
            <th scope="col" data-label="Created By">Created By</th>
            <th scope="col" data-label="">Action</th>
        </tr>
    </thead>
    <tbody id="blogsTable">
        @forelse($blogs as $blog)

        <tr id="blog-{{ $blog->id }}">
            <td data-label="#">{{ $blog->id }}</td>
            <td data-label="Title:">{{ $blog->title }}</td>
            <!-- <td>{{ $blog->img }}</td> -->
            <!-- <td>{{ $blog->body }}</td> -->
            <td data-label="Created By:"> <a href="{{ route('user.show', $blog->user->id) }}" target="_blank" class="link">
                    {{ $blog->user->name }} {{ $blog->user->surname }}
                </a>
            </td>
            <td data-label="">
                <div class="d-flex">
                    <a href="{{ route('blog.show', $blog->id) }}" class="preview d-flex align-items-center"><i class="fa-solid fa-eye"></i> Preview</a>
                    <a href="{{ route('blog.edit' , $blog->id) }}" class="d-flex align-items-center text-decoration-none text-success mx-3"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                    <button class="delete_blog delete d-flex align-items-center" data-id="{{ $blog->id }}"><i class="fa-solid fa-trash"></i>Delete</button>
                </div>

            </td>
        </tr>

        @empty
        <tr>
            <td colspan="4">No blogs found.</td>
        </tr>
        @endforelse
    </tbody>
</table>
<div class="">
    {{ $blogs->links('pagination::bootstrap-5') }}
</div>