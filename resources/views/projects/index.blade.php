@extends('layouts.app')

@section('title', 'Projects')

@section('content')

<div class="card">
    <h2>All Projects</h2>

    <a href="{{ route('projects.create') }}" class="btn btn-primary">+ New Project</a>

    <ul>
        @foreach($projects as $project)
            <li>
                <a href="{{ route('projects.show', $project) }}">
                    {{ $project->name }}
                </a>
            </li>
        @endforeach
    </ul>
</div>

@endsection