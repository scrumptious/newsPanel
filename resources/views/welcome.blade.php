@extends('layout')

@section('stylesheets')
    <link rel="stylesheet" href="/css/generic.css">
@endsection

@include('inc.messages')
@section('content')

    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="title m-b-md">
        News Panel
    </div>

    @if($user)
        <p>Welcome back, {{ $user->name }}. Use navigation above to manage News.</p>
    @else
        <p>Please <a href="/login">login</a> or <a href="/register">register</a> to create a new account.</p>
    @endif
@endsection