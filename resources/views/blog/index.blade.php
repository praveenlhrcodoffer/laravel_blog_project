@extends('layouts.layouts')


@section('content')
    <div class="post-list-wrapper">

        {{-- @if ($results) --}}
        {{-- {{ count($results) }} --}}
        {{-- <ul>
                @foreach ($results as $res)
                    <li>{{ $res }}</li>
                @endforeach
            </ul> --}}
        {{-- @else --}}

        @if ($posts)
            @foreach ($posts as $post)
                <div class="post-wrapper">
                    <div class="post-inner-container">
                        <div class="title-container">
                            <p>{{ $post->title }}</p>
                        </div>
                        <div class="image-container">
                            <a href="{{ route('posts.show', $post->id) }}">
                                <img src="{{ $post->image_url }}" alt="Post Image">
                            </a>
                        </div>
                        <div class="author-container">
                            <p>{{ $post->author }}</p>
                        </div>
                        <div class="likes-container">
                            <p>• {{ $post->likes }} <span>Likes</span></p>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

    </div>
@endsection
