<!DOCTYPE html>
<html>
<body>

<h2>Hello {{ $invitation->user->name }}</h2>

<p>
You have been invited to join the project:
<strong>{{ $invitation->project->name }}</strong>
</p>
<p>
<a href="{{ route('invitations.show', $invitation) }}">
View Invitation
</a>
</p>
</body>
</html>