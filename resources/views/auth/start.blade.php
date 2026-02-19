@extends('layouts.app')

@section('title', 'Start')

@section('content')
<div class="row mt-3">
    <div class="col-12 align-self-center" style="text-align:center;">
        <h3>Hello in Todo</h3>

        <div style="margin-top:30px;">
            <a href="{{ route('login') }}">
                <button type="button" class="btn btn-primary">Login</button>
            </a>

            <a href="{{ route('register') }}">
                <button type="button" class="btn btn-success">Register</button>
            </a>
        </div>
    </div>
</div>
@endsection