@extends('layouts.layouts')

@section('content')
    <div class="post-detail-page">
        <div class="back-btn-container">
            <div class="back-btn">
                <a href="{{ route('posts.home') }}">
                    <p> ←BACK</p>
                </a>
            </div>
            @if (Auth::user())
                <div class="edit-btn">
                    <a href="">
                        <p>Edit</p>
                    </a>
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

        <div class="post-detail-inner-page">
            <div class="full-post-container">
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
        </div>
    </div>
@endsection
