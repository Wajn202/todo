@extends('layouts.app')

@section('title', 'Edit Project')

@section('content')

<div class="card">
    <h2>Edit Project</h2>

    <form method="POST" action="{{ route('projects.update', $project) }}">
        @csrf
        @method('PUT')

        <div>
            <label>Name</label><br>
            <input type="text" name="name" value="{{ old('name', $project->name) }}" required >
        </div>

        <br>

        <div>
            <label>Description</label><br>
            <textarea name="description">{{ old('description', $project->description) }}</textarea>
        </div>

        <br>

        <button class="btn btn-primary">Update</button>

        <a href="{{ route('projects.show', $project) }}" class="btn btn-secondary">
            Cancel
        </a>
    </form>
</div>

@endsection