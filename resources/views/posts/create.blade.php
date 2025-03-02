@extends('layouts.app')
@section('content')
{{-- @dd($post->id) --}}
<h1>{{ isset($post) ? 'Edit Post' : 'Create New Post' }}</h1>

@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li class="text-center">{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
<form id="postForm" action="{{ isset($post) ? route('posts.update', ['post' => $post->id])  : route('posts.store') }}" method="POST">
	@csrf
    @if(isset($post))
        @method('PUT') 
    @endif
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" 
            class="form-control" 
            id="title" 
            name="title" 
            value="{{ old('title', $post->title ?? '') }}" 
            aria-describedby="titleHelp"
        >
		@error('title')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">Content</label>
		<textarea class="form-control" 
            id="content" 
            rows="5"  
            name="content" 
            >{{ old('content', $post->content ?? '') }}</textarea>
		@error('content')
            <div class="text-danger">{{ $message }}</div>
        @enderror

    </div>
	<div class="d-flex justify-content-center">
		<button type="submit" class="btn btn-primary">{{ isset($post) ? 'Update' : 'Save' }}</button>
	</div>
    
</form>

@endsection