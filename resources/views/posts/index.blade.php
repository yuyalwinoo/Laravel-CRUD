@extends('layouts.app')
@section('content')
<button type="button" class="btn btn-primary">
    <a href="{{ route('posts.create') }}" class="text-white text-decoration-none">+ Create New Post</a>
</button>
<h1>Posts</h1>
@if (\Session::has('success'))
    <div class="alert alert-success text-center">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif

@if($posts->isEmpty())
    <div class="alert alert-danger text-center">No posts available.</div>
@else
    @foreach($posts as $post)
        <div class="card post-card">
            {{-- <p>{{ $post->id }}</p> --}}
            <h3>{{ $post->title }}</h3>
            <p>{{ $post->content }}</p>
            
            <div class="social-icons">
                <a href="{{ route('posts.edit', $post) }}" class="m-2"><i class="fa-solid fa-pen-to-square"></i></a>
                <a href="#" class="m-2 text-danger delete-trigger" 
                    data-bs-toggle="modal" 
                    data-bs-target="#deleteModal"
                    data-action="{{ route('posts.destroy', $post) }}">
                    <i class="fa-solid fa-trash"></i>
                </a>

            </div>
        </div>
    @endforeach

    <!-- Delete Confirmation Modal -->
    @include('components.delete-modal')
@endif

@endsection

