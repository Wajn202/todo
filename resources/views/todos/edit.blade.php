@extends('layouts.app')

@section('title', 'Edit Task')

@section('content')

<div class="card">
    <h2>Edit Task</h2>

    <form method="POST" action="{{ route('todos.update', $todo) }}">
        @csrf
        @method('PUT')

        <div>
            <label>Name</label><br>
            <input type="text" name="name" value="{{ old('name', $todo->name) }}" required>
        </div>

        <br>

        <div>
            <label>Status</label><br>
            <select name="status">
                <option value="todo" {{ $todo->status === 'todo' ? 'selected' : '' }}>Todo</option>
                <option value="in Progress" {{ $todo->status === 'in Progress' ? 'selected' : '' }}>In Progress</option>
                <option value="done" {{ $todo->status === 'done' ? 'selected' : '' }}>Done</option>
            </select>
        </div>

        <br>

        <button class="btn btn-primary">Update</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
    </form>
</div>

@endsection