@extends('layouts.app')

@section('title')
    View Todo
@endsection

@section('content')

<div class="row mt-3">
    <div class="col-12 align-self-center">
        <h3>{{ $todo->name }}</h3>
        <p>{{ $todo->description }}</p>

        <a href="{{ route('todo.index') }}" class="btn btn-secondary">
            Back to List
        </a>
    </div>
</div>

@endsection