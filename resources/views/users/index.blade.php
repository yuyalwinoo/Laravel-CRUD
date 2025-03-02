@extends('layouts.app')
@section('content')
<h1>User</h1>
<button type="button" class="btn btn-primary">
    <a href="{{ route('users.create') }}" class="text-white text-decoration-none">+ Create New User</a>
</button>
@if (\Session::has('success'))
    <div class="alert alert-success text-center my-3">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
@if($users->isEmpty())
    <div class="alert alert-danger text-center">No User found.</div>
@else
    <div class="container">
        <div class="row">
            @foreach($users as $user)
                <div class="col-md-4 my-4">
                    <div class="card profile-card">
                        <div class="card-body text-center">
                            <img src="https://i.pinimg.com/736x/b3/f8/9d/b3f89d956b9d735c02118523da6f64b8.jpg" alt="User Profile" class="rounded-circle profile-img mb-3">
                            <h3 class="card-title mb-2">{{$user->name}}</h3>
                            <p class="card-text text-muted mb-3">{{$user->email}}</p>
                            <div class="social-icons mb-4">
                                <a href="{{ route('users.edit', $user) }}" class="m-2"><i class="fa-solid fa-user-pen"></i></a>
                                <a href="#" class="m-2 text-danger delete-trigger" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteModal"
                                    data-action="{{ route('users.destroy', $user) }}">
                                    <i class="fa-solid fa-trash"></i>
                                </a>

                            </div>
                            {{-- <a href="#" class="btn btn-primary btn-lg w-100">Connect</a> --}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @include('components.delete-modal')
@endif

@endsection