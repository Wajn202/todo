<?php

namespace App\Http\Controllers;


use App\Models\Todo;
use App\Http\Requests\TodoRequest;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
     $todo = Todo::all();
    return view('index', compact('todo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }


    public function store(TodoRequest $request){


       
         Todo::create($request->validated());

    return redirect()->route('todo.index')->with('success', 'Todo created successfully!');


    }

    /**
     * Store a newly created resource in storage.
     */
    public function show(Todo $todo){

    return view('show', compact('todo'));

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
       return view('edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     */
   
        public function update(TodoRequest $request,Todo $todo){

        $todo->update($request->validated());

        
        return redirect()->route('todo.index')->with('success', 'Todo updated successfully!');

    }
    


    /**
     * Remove the specified resource from storage.
     */
     public function destroy(Todo $todo){

        $todo->delete();

        return redirect()->route('todo.index')->with('success', 'Todo deleted successfully!');

    }
}
