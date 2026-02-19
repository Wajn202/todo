@extends('layouts.app')

@section('title')
    Add New Todo
@endsection

@section('content')

<div class="row mt-3">
    <div class="col-12 align-self-center">
        <form action="{{ route('todo.store') }}" method="POST">
            @csrf
            <div>
                <label>name:</label>
                <input type="text" name="name" required>
            </div>
            <div style="margin-top:10px;">
                <label>Description:</label>
                <textarea name="description"></textarea>
            </div>
            <div style="margin-top:10px;">
                <button type="submit" style="color: cornflowerblue;">Save</button>
            </div>
        </form>

        <a href="{{ route('todo.index') }}" style="color: cornflowerblue; display:inline-block; margin-top:10px;">
            Back to List
        </a>
    </div>
</div>

@endsection