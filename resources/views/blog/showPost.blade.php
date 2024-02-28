@extends('layouts.layouts')

@section('content')
    <div class="post-detail-page">
        <div class="back-btn-container">
            <a href="{{ route('posts.home') }}">
                <p> ←BACK</p>
            </a>
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
                    <img src="{{ $post->image_url }}" />
                </div>
                <div class="full-post-content">
                    <p>{{ $post->content }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
