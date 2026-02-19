@extends('layouts.app')

@section('title')
    View Todo
@endsection

@section('content')

<div class="row mt-3">
    <div class="col-12 align-self-center">
        <h3>{{ $todo->title }}</h3>
        <p>{{ $todo->description }}</p>

        <a href="{{ route('todo.index') }}" style="color: cornflowerblue; display:inline-block; margin-top:10px;">
            Back to List
        </a>
    </div>
</div>

@endsection