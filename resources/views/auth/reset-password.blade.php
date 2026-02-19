@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
<div class="auth-box">
    <h3> Reset Password </h3>

    @if($errors->any())
        <div class="error-box">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="email" name="email" placeholder=" Enter email " required>
        <input type="password" name="password" placeholder="Enter a new password" required>
        <input type="password" name="password_confirmation" placeholder="Enter confirm the passowrd" required>
        <button type="submit">Save</button>
    </form>
</div>
@endsection