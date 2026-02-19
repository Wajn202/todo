@extends('layouts.app')

@section('title', 'Create Project')

@section('content')

<div class="card">
    <h2>Create Project</h2>

    <form method="POST" action="{{ route('projects.store') }}">
        @csrf

        <div>
            <label>Name</label><br>
            <input type="text" name="name" value="{{ old('name') }}" required>
        </div>

        <br>

        <div>
            <label>Description</label><br>
            <textarea name="description">{{ old('description') }}</textarea>
        </div>

        <br>

        <button class="btn btn-primary">Create</button>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Back to List</a>
    </form>
</div>

@endsection