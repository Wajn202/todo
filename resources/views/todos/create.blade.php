@extends('layouts.app')

@section('title', 'Create Task')

@section('content')

<div class="card">
    <h2>Create Task</h2>

    <form method="POST" action="{{ route('todos.store') }}">
        @csrf

        <input type="hidden" name="project_id" value="{{ $project?->id }}">

        <div>
            <label>Name</label><br>
            <input type="text" name="name" required>
        </div>
         <div>
            <label>Description</label><br>
            <textarea name="description"></textarea>
        </div>

        <br>

        <div>
            <label>Status</label><br>
            <select name="status">
                <option value="todo">Todo</option>
                <option value="in Progress">In Progress</option>
                <option value="done">Done</option>
            </select>
        </div>

        <br>

        <button class="btn btn-primary">Save</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back to Project</a>
    </form>
</div>

@endsection