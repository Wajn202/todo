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
                    <a href="{{ route('todo.show', $item->id) }}" class="todo-title">{{$item->name}}</a>
                    

                    <a href="{{ route('todo.edit', $item->id) }}" class="todo-edit">Edit</a>

                    <form action="{{ route('todo.destroy', $item->id) }}" method="POST" onsubmit="confirmDelete(event)" >
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="todo-delete">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
</div>

@endsection
