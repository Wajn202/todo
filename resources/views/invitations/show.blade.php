@extends('layouts.app')

@section('title', 'Project Invitation')

@section('content')

<div class="card">
    <h2>Invitation to Join Project</h2>

    <p>Hello <strong>{{ $invitation->user->name }}</strong>,</p>

    <p>
        You have been invited to join the project:
        <strong>{{ $invitation->project->name }}</strong>
        by <strong>{{ $invitation->project->owner->name }}</strong>.
    </p>

    @if($invitation->status !== 'pending')
        <p>
            This invitation has already been
            <strong>{{ ucfirst($invitation->status) }}</strong>.
        </p>

        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
            Back to Dashboard
        </a>
    @else
        <form method="POST" action="{{ route('invitations.accept', $invitation) }}" style="display:inline">
            @csrf
            <button class="btn btn-success">
                Accept
            </button>
        </form>

        <form method="POST" action="{{ route('invitations.reject', $invitation) }}" style="display:inline">
            @csrf
            <button class="btn btn-danger">
                Decline
            </button>
        </form>
    @endif
</div>

@endsection