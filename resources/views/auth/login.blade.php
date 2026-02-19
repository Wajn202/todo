@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="auth-box">
    <h3> Login </h3>

    @if(session('success'))
        <div class="success-box">{{ session('success') }}</div>
    @endif

    @if(session('status'))
        <div class="success-box">{{ session('status') }}</div>
    @endif

    @if($errors->any())
        <div class="error-box">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit"> Login </button>
    </form>

    <a href="{{ route('password.request') }}" class="text-primary">
       Forgot your password?
    </a>

    <p>
       Don’t have an account?
        <a href="{{ route('register') }}" class="text-primary"> Register </a>
    </p>
</div>
@endsection