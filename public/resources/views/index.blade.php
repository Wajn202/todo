@extends('layouts.app')

@section('title')
    My Todo App
@endsection

@section('content')

<div class="row mt-3">
    <div class="col-12 align-self-center">
        <a href="{{ route('todo.create') }}" style="color: cornflowerblue; display:inline-block; margin-bottom:15px;">
            <span class="btn btn-primary">Create Todo</span>
        </a>

        <ul class="list-group">
            @foreach($todo as $item)
                <li class="list-group-item">
                    <a href="{{ route('todo.show', $item->id) }}" style="color: cornflowerblue">{{ $item->title }}</a>

                    <a href="{{ route('todo.edit', $item->id) }}" style="color: cornflowerblue; margin-left:10px;">Edit</a>

                    <form action="{{ route('todo.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="color: cornflowerblue; background:none; border:none; cursor:pointer;">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
</div>

@endsection