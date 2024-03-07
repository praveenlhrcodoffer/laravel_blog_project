@extends('layouts.layouts')

@section('content')
    <div class="post-detail-page">



        {{-- back btn container-------------------–––––––––––––-------- --}}
        <div class="back-btn-container">
            <div class="back-btn">
                <a href="{{ route('posts.home') }}">
                    <p> ←BACK</p>
                </a>
            </div>
            {{-- <p>{{ Auth::user()->id . ' ' . $post->user_id }}</p> --}}
            @if (Auth::user() && Auth::user()->id == $post->user_id)
                <div class="edit-btn-div">
                    <button onclick="toggleEditForm()">Edit</button>
                </div>
                <div class="delete-btn">
                    <form id="delete-post-form" action="{{ route('post.delete', ['id' => $post->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                    </form>
                </div>
            @endif
        </div>

        {{-- post container-------------------–––––––––––––-------- --}}
        <div class="post-commnet-group">
            <div class="post-detail-inner-page">

                <div class="full-post-container" id="postContainer">
                    <div class="full-post-title">
                        <p>{{ $post->title }}</p>
                    </div>
                    <div class="full-post-author">
                        <p> <span>By -</span> {{ $post->author }}</p>
                        <p id="like-text">{{ $post->likes }} Likes</p>
                    </div>
                    <div class="full-image-container">
                        <img src="{{ asset('storage/' . $post->image_url) }}" />
                    </div>
                    <div class="full-post-content">
                        <p>{{ $post->content }}</p>
                    </div>
                </div>

                <form action="{{ route('post.update', ['id' => $post->id]) }}" method="POST" enctype="multipart/form-data"
                    class="edit-post-form" id="editForm" style="display: none;">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <input type="text" name="title" value="{{ $post->title }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="author" value="{{ $post->author }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <textarea name="content" class="form-control" required>{{ $post->content }}</textarea>
                    </div>
                    <div class="form-group">
                        <input type="file" name="image" class="form-control-file">
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" onclick="cancelEdit()" class="btn btn-secondary">Cancel</button>
                </form>
            </div>

            {{-- post comments  container-------------------–––––––––––––-------- --}}

            <div class="post-comments-container">
                <div class="comment-header-div">
                    <p>Comments</p>
                </div>
                <div class="comment-main-div" id="comments-list">
                    {{-- <div class="comment-item-div">
                        <p id="commented-author-text">This is test commnet</p>
                        <p id="commented-text-text"> - John Doe</p>
                    </div> --}}

                </div>
                <div class="comment-input-div">
                    <form id="comment-form" action="{{ route('post.comment') }}" method="POST">
                        @csrf
                        @method('POST')
                        <input id="comment-input" name="comment" placeholder="Share your thoughts" />
                        <button type="button"
                            onclick="addPost( '{{ json_encode($post->id) }}' , '{{ json_encode(Auth::user()) }}', '{{ route('post.comment') }}')">
                            ▶
                        </button>
                    </form>
                </div>
            </div>
        </div>



    </div>


    <script src={{ asset('js/comments.js') }}></script>


    <script>
        function toggleEditForm() {
            document.getElementById('postContainer').style.display = 'none';
            document.getElementById('editForm').style.display = 'block';
        }

        function cancelEdit() {
            document.getElementById('postContainer').style.display = 'block';
            document.getElementById('editForm').style.display = 'none';
        }
    </script>
@endsection
