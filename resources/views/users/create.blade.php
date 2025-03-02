@extends('layouts.app')
@section('content')

<h1>{{ isset($user) ? 'Edit User' : 'Create New User' }}</h1>
<div class="d-flex justify-content-center align-items-center mx-auto">
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li class="text-center">{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif
    <form id="" action="{{ isset($user) ? route('users.update', ['user' => $user->id])  : route('users.store') }}" method="POST">
        @csrf
        @if(isset($user))
            @method('PUT') 
        @endif
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" 
                class="form-control" 
                id="name" 
                name="name" 
                value="{{ old('name', $user->name ?? '') }}" 
                aria-describedby="nameHelp"
            >
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" 
                class="form-control" 
                id="email" 
                name="email" 
                value="{{ old('email', $user->email ?? '') }}" 
                aria-describedby="emailHelp"
            >
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror

        </div>
        
        @if(!isset($user)) 
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" 
                        class="form-control" 
                        id="password" 
                        name="password" 
                        value="{{ old('password', $user->password ?? '') }}" 
                        aria-describedby="passwordHelp"
                    >
                    <span class="input-group-text">
                        <i class="fa-regular fa-eye" id="togglePassword" style="cursor: pointer;"></i>
                    </span>
                </div>
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        @endif

        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">{{ isset($user) ? 'Update' : 'Save' }}</button>
        </div>
        
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let togglePassword = document.getElementById('togglePassword');
        if (togglePassword) { // Check if the element exists before adding event
            togglePassword.addEventListener('click', function () {
                let passwordInput = document.getElementById('password');
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    this.classList.replace('fa-eye', 'fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    this.classList.replace('fa-eye-slash', 'fa-eye');
                }
            });
        }
    });

</script>

@endsection