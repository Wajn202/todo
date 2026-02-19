@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="auth-box">
    <h3> Register </h3>

    @if($errors->any())
        <div class="error-box">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <input type="text" name="name" placeholder="Enter name" required>
        <input type="email" name="email" placeholder="Enter email" required>
        <input type="password" name="password" placeholder="Enter password" required>
        <input type="password" name="password_confirmation" placeholder="Enter confirm the passowrd" required>
        <button type="submit">Register</button>
    </form>

    <p>
      Already have an account?
    <a href="{{ route('login') }}" class="text-primary">Login</a>
    </p>
</div>
@endsection