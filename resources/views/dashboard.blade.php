@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

{{-- Projects you own --}}
<div class="card">
    <h2>Your Projects</h2>

    <a href="{{ route('projects.create') }}" class="btn btn-primary">+ New Project</a>

    <ul>
        @forelse($ownedProjects as $project)
            <li>
                <a href="{{ route('projects.show', $project) }}">
                    {{ $project->name }}
                </a>
                ({{ $project->todos_count }} tasks)
            </li>
        @empty
            <p>No projects yet.</p>
        @endforelse
    </ul>
</div>

{{-- Projects you participate in --}}
<div class="card">
    <h2>Shared Projects</h2>

    <ul>
        @forelse($sharedProjects as $project)
            <li>
                <a href="{{ route('projects.show', $project) }}">
                    {{ $project->name }}
                </a>
            </li>
        @empty
            <p>No shared projects.</p>
        @endforelse
    </ul>
</div>

{{-- Personal todos --}}
<div class="card">
    <h2>My Personal Tasks</h2>

    <a href="{{ route('todos.create') }}" class="btn btn-primary">+ New Task</a>

    @include('todos._table', ['todos' => $personalTodos])
</div>

@endsection