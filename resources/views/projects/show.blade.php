@extends('layouts.app')

@section('title', $project->name)

@section('content')

<div class="card">
    <h2>{{ $project->name }}</h2>
    <p>{{ $project->description }}</p>

    @if(auth()->id() === $project->owner_id)
    <a href="{{ route('todos.create', ['project_id' => $project->id]) }}"
       class="btn btn-primary">
        + Add Task
    </a>
    @endif

    @if(auth()->id() === $project->owner_id)
   <div class="card">
   <h3>Invite Member</h3>

<form method="POST" action="{{ route('projects.invite', $project) }}">
    @csrf
    <select name="user_id" required>
        <option value="">-- Select User --</option>
        @foreach(\App\Models\User::all() as $user)
            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
        @endforeach
    </select>
    <button class="btn btn-primary">Send Invitation</button>
</form>
</div>
@endif
    <a href="{{ route('dashboard') }}" class="btn btn-secondary" style="float:right;">Back to Dashboard</a>

@if(auth()->id() === $project->owner_id)
    <form action="{{ route('projects.destroy', $project) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
</form>
@endif
</div>

<div class="card">
    <h3>Project Tasks</h3>

    @include('todos._table', ['todos' => $project->todos])
</div>

@endsection
