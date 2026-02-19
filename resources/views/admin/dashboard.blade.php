@extends('layouts.app')

@section('content')
<div class="card">
<h2>Admin Dashboard</h2>

<p>Total Users: {{ $users }}</p>
<p>Total Projects: {{ $projects }}</p>
<p>Total Tasks: {{ $todos }}</p>
<p>Completed Tasks: {{ $completed }}</p>

</div>
@endsection
