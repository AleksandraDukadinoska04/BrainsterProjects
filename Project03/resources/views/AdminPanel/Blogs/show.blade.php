@extends('AdminPanel.layout.app')

@section('blogs')

<div class="container-md">

    <div class="d-flex align-items-center justify-content-between form-column mx-auto mb-2">
        <a href="{{ route('blogs') }}" class="back mt-auto"><i class="fa-solid fa-arrow-left"></i> Go Back</a>
        <div class="">
            <a href="{{ route('blog.edit' , $blog) }}" class="text-decoration-none text-success me-3"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
            <button class="delete_blog delete" data-id="{{ $blog->id }}"><i class="fa-solid fa-trash"></i>Delete</button>
        </div>
    </div>


    <div class="d-flex align-items-start justify-content-center rounded-pill vh-70 shadow" style='background-image: url("{{ $blog->img }}") ; background-position: center; background-size: cover;'>
        <div class="overlay w-100 vh-70 d-flex flex-column align-items-start justify-content-center rounded-pill p-4">
            <small class="text-white fs-5">Blog</small>
            <h1 class="text-white fw-bold fst-italic w-75 my-2">{{ $blog->title }} </h1>

            <p class="text-white fst-italic">Created By: <a href="{{ route('user.show', $blog->user->id) }}" class="color-darkorange" target="_blank"> <b>{{ $blog->user->name }} {{ $blog->user->surname }}</b></a> | <b>{{ \Carbon\Carbon::parse($blog->created_at)->format('d F, Y') }}</b> </p>
        </div>
    </div>




    <div class="my-5">
        <h2 class="color-grey fw-bold fst-italic d-inline me-3 ">Body</h2>
        <a href="{{ route('blog.section.create', $blog->id) }}" class="btn-create fw-bold d-inline"><i class="fa-solid fa-plus me-1 "></i>Add new section</a>
        <hr class="w-100 d-block mt-4 mb-3">

        <div class="body">
            <div class="sections ">
                @foreach($sections as $section)
                <div class="my-4" id="section-{{ $section->id }}">
                    <div class="d-flex align-items-start justify-content-between ">
                        <h3 class="color-darkorange fw-bold fst-italic w-75">{{ $section->section_title}}</h3>
                        <div class="w-25 d-flex flex-column">
                            <a href="{{ route('blog.section.edit', $section->id) }}" class="text-decoration-none text-success fst-italic d-flex align-items-center">Edit <i class="ms-1 fa-solid fa-pen-to-square"></i></a>
                            <button class="delete_section delete d-inline fst-italic d-flex align-items-center p-0" data-id="{{ $section->id }}">Delete <i class="ms-1 fa-solid fa-trash"></i></button>
                        </div>
                    </div>
                    <p class="color-gray w-75">{{ $section->section_content}}</p>
                    <hr class="w-100">
                </div>
                @endforeach
            </div>
            <div class=" summary border border-2 p-3 rounded-4">
                <h4 class="text-center text-gray fw-bold fst-italic mb-2">Summary</h4>
                <ul>
                    @foreach($sections as $section)
                    <li class="mb-2" id="sectionTitle-{{ $section->id }}">
                        <a href="#section-{{ $section->id }}" class="hover-darkorange">{{ $section->section_title}}</a>
                    </li>
                    @endforeach
                    <li class="mb-2">
                        <a href="#comments" class="hover-darkorange">Comments</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <button type="button" class="border-0 bg-light fs-3 text-primary" data-bs-toggle="modal" data-bs-target="#likesModal">
        <i class="fa-solid fa-thumbs-up"></i> {{ $likes->count() }}
    </button>
    <button type="button" class="border-0 bg-light fs-3 text-danger mx-4" data-bs-toggle="modal" data-bs-target="#favouritedModal">
        <i class="fa-solid fa-heart"></i> {{ $favourited->count() }}
    </button>
    <a href="#comments" class="fs-3 text-success text-decoration-none">
        <i class="fa-solid fa-comment"></i>{{ $comments->count() }}
    </a>

    <div class="my-5" id="comments">
        <h3 class="text-grey fw-bold fst-italic border-bottom pb-2">Comments: </h3>

        @forelse($comments as $comment)
        <div class="p-3 my-2" id="comment-{{ $comment->id }}">
            <div class="d-flex align-items-center">
                <div class="comment-photo me-2 mb-2">
                    <img src="{{ $comment->user->photo ? asset('storage/' . $comment->user->photo) : asset('images/default.jpg') }}" alt="User Photo" class="w-100 rounded-circle">
                </div>
                <div class="w-75">
                    <p class="m-0 "><a href="{{ route('user.show', $comment->user->id) }}" class="hover-darkorange" target="_blank"><b>{{ $comment->user->name }} {{ $comment->user->surname }}</b> </a> </p>
                    <small class="text-muted d-inline">{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</small>
                </div>
            </div>
            <div class="">
                <p>{{ $comment->content}}</p>
            </div>
            <div class="">
                <button type="button" class="border-0 bg-light text-primary" data-bs-toggle="modal" data-bs-target="#commentLikesModal-{{$comment->id}}">
                    <i class="fa-solid fa-thumbs-up"></i> {{ $commentLikes->where('blog_comment_id', $comment->id)->count() }}
                </button>
                <button type="button" class="toggle-replies-btn border-0 bg-light text-success mx-2" data-comment-id="{{ $comment->id }}">
                    <i class="fa-regular  fa-comment"></i> {{ $replies->where('parent_id', $comment->id)->count() }}
                </button>
                <button class="delete_comment delete" data-id="{{ $comment->id }}"><i class="fa-solid fa-trash"></i></button>
            </div>

            <div id="replies-{{ $comment->id }}" class="replies ms-5 " style="display: none;">

                @forelse($replies->where('parent_id', $comment->id) as $replay)

                <div class="reply mt-4" id="comment-{{ $replay->id }}">
                    <div class="d-flex align-items-center">
                        <div class="comment-photo me-2 mb-2">
                            <img src="{{ $replay->user->photo ? asset('storage/' . $replay->user->photo) : asset('images/default.jpg') }}" alt="User Photo" class="w-100 rounded-circle">
                        </div>
                        <div class="">
                            <p class="m-0 d-inline me-2"><a href="{{ route('user.show', $replay->user->id) }}" class="hover-darkorange" target="_blank"><b>{{ $replay->user->name }} {{ $replay->user->surname }}</b> </a> </p>
                            <button class="delete_comment delete d-inline" data-id="{{ $replay->id }}"><i class="fa-solid fa-trash"></i></button>
                            <small class="text-muted d-inline d-block">{{ \Carbon\Carbon::parse($replay->created_at)->diffForHumans() }}</small>
                        </div>

                    </div>
                    <div class="">
                        <p class="m-0">{{ $replay->content}}</p>
                    </div>
                </div>
                @empty
                <p class="text-muted fst-italic m-0">No replies yet....</p>
                @endforelse
            </div>
        </div>


        <!-- Comment Likes Modal -->
        <div class="modal fade" id="commentLikesModal-{{$comment->id}}" tabindex="-1" aria-labelledby="commentLikesModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5  fw-bold fst-italic color-gray" id="commentLikesModalLabel">Comment Likes: <span class="color-darkorange"> {{ $commentLikes->where('blog_comment_id', $comment->id)->count() }}</span></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        @forelse($commentLikes->where('blog_comment_id', $comment->id) as $like)

                        <a href="{{ route('user.show', $like->user->id) }}" target="_blank" class="d-flex alignt-items-start justify-content-start text-decoration-none border-bottom pb-2 mb-2">
                            <div class="w-25">
                                <img src="{{ $like->user->photo ? asset('storage/' . $like->user->photo) : asset('images/default.jpg') }}" alt="User Photo" class="w-75 rounded-circle">
                            </div>
                            <div class="w-75 my-auto">
                                <p class="color-darkorange fw-bold fst-italic m-0">{{ $like->user->name }} {{ $like->user->surname }}</p>
                                <small class="color-gray fw-bold fst-italic">{{ $like->user->profession}}</small>
                            </div>
                        </a>

                        @empty
                        <p class="text-muted fst-italic">No likes yet....</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        @empty
        <p class="text-muted fst-italic">No comments yet....</p>
        @endforelse
    </div>




</div>

<!-- Likes Modal -->
<div class="modal fade" id="likesModal" tabindex="-1" aria-labelledby="likesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold fst-italic color-gray" id="likesModalLabel">Likes: <span class="color-darkorange"> {{ $likes->count() }}</span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @forelse($likes as $like)

                <a href="{{ route('user.show', $like->user->id) }}" target="_blank" class="d-flex alignt-items-start justify-content-start text-decoration-none border-bottom pb-2 mb-2">
                    <div class="w-25">
                        <img src="{{ $like->user->photo ? asset('storage/' . $like->user->photo) : asset('images/default.jpg') }}" alt="User Photo" class="w-75 rounded-circle">
                    </div>
                    <div class="w-75 my-auto">
                        <p class="color-darkorange fw-bold fst-italic m-0">{{ $like->user->name }} {{ $like->user->surname }}</p>
                        <small class="color-gray fw-bold fst-italic">{{ $like->user->profession}}</small>
                    </div>
                </a>
                @empty
                <p class="text-muted fst-italic">No likes yet....</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Favourited Modal -->
<div class="modal fade" id="favouritedModal" tabindex="-1" aria-labelledby="favouritedModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5  fw-bold fst-italic color-gray" id="favouritedModalLabel">Favourited By: <span class="color-darkorange"> {{ $favourited->count() }}</span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                @forelse($favourited as $user)
                <a href="{{ route('user.show', $user->user->id) }}" target="_blank" class="d-flex alignt-items-start justify-content-start text-decoration-none border-bottom pb-2 mb-2">
                    <div class="w-25">
                        <img src="{{ $user->user->photo ? asset('storage/' . $user->user->photo) : asset('images/default.jpg') }}" alt="User photo" class="w-75 rounded-circle">
                    </div>
                    <div class="w-75 my-auto">
                        <p class="color-darkorange fw-bold fst-italic m-0">{{ $user->user->name }} {{ $user->user->surname }}</p>
                        <small class="color-gray fw-bold fst-italic">{{ $user->user->profession}}</small>
                    </div>
                </a>
                @empty
                <p class="text-muted fst-italic">No favourites yet....</p>
                @endforelse

            </div>
        </div>
    </div>
</div>



@endsection