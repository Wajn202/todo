@extends('layouts.app')

@section('title')
    Edit Todo
@endsection

@section('content')

<div class="row mt-3">
    <div class="col-12 align-self-center">
        <form action="{{ route('todo.update', $todo->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label>name:</label>
                <input type="text" name="name" value="{{ $todo->name }}" required>
            </div>
            <div style="margin-top:10px;">
                <label>Description:</label>
                <textarea name="description">{{ $todo->description }}</textarea>
            </div>
            <div style="margin-top:10px;">
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </form>

        <a href="{{ route('todo.index') }}" class="btn btn-secondary">
            Back to List
        </a>
    </div>
</div>

@endsection