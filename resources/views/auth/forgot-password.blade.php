@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')
<div class="auth-box">
    <h3>Forgot Password</h3>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <input type="email" name="email" placeholder="Enter email" required>
        <button type="submit">Send Reset link</button>
    </form>

    <a href="{{ route('login') }}" class="text-primary">Back for login</a>
</div>
@endsection
