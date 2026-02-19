<?php

namespace App\Http\Controllers;


use App\Models\Todo;
use App\Models\Project;
use App\Models\User;
use App\Http\Requests\TodoRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class TodoController extends Controller
{

    /**
     * Display a listing of the todos.
     */
     public function index(): View
    {
        $todos = Todo::whereNull('project_id')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('todos.index', compact('todos'));
    }

    /**
     * Show create form
     */
    public function create(Request $request): View
    {
        $users = User::all();

        $project = null;
        if ($request->has('project_id')) {
        $project = Project::findOrFail($request->project_id);
        }

        return view('todos.create', compact('users', 'project'));
    }

    /**
     * Store new todo
     */
      public function store(TodoRequest $request): RedirectResponse
{
    $todo = Todo::create([
        'name'        => $request->name,
        'description' => $request->description,
        'user_id'     => auth()->id(),
        'project_id'  => $request->project_id,
        'status'      => $request->status ?? 'todo',
        'assigned_to' => $request->assigned_to,
    ]);

    // If task belongs to a project
    if ($todo->project_id) {
        return redirect()
            ->route('projects.show', $todo->project_id)
            ->with('success', 'Task created successfully');
    }

    // Personal task
    return redirect()
        ->route('dashboard')
        ->with('success', 'Personal task created successfully');
}



    /**
     * Not used (keep for resource compatibility)
     */
    public function show(Todo $todo): RedirectResponse
    {
        return redirect()->route('dashboard');
    }

    /**
     * Edit form
     */
    public function edit(Todo $todo): View
    {
        $this->authorizeTodo($todo);

        $users = User::all();

        return view('todos.edit', compact('todo', 'users'));
    }

    /**
     * Update full todo
     */
    public function update(TodoRequest $request, Todo $todo): RedirectResponse
    {
        $this->authorizeTodo($todo);

        $todo->update($request->validated());

        if ($todo->project_id) {
            return redirect()
                ->route('projects.show', $todo->project_id)
                ->with('success', 'Task updated successfully');
        }

        return redirect()
            ->route('dashboard')
            ->with('success', 'Task updated successfully');
    }

    /**
     * Update status only (from table)
     */
    public function updateStatus(Request $request, Todo $todo): RedirectResponse
    {
        $this->authorizeTodo($todo, 'status');

        $request->validate([
            'status' => 'required|in:todo,in Progress,done',
        ]);

        $todo->update([
            'status' => $request->status,
        ]);

        return back();
    }

    /**
     * Delete todo
     */
    public function destroy(Todo $todo): RedirectResponse
    {
        $this->authorizeTodo($todo);

        $todo->delete();

        return back()->with('success', 'Task deleted successfully');
    }

    /**
 * Authorization helper
 *
 * @param Todo $todo
 * @param string $action 'full'| 'status'
 */
private function authorizeTodo(Todo $todo, string $action = 'full'): void
{
       $userId = auth()->id();

   
    $isOwner = $todo->project && $userId === $todo->project->owner_id;

   
    $isassignedUser = $todo->assigned_to === $userId;

    if ($action === 'status') {
        
        if (!($isOwner || $isassignedUser)) {
            abort(403);
        }
    } else {
        
        if (!($isOwner)) {
            abort(403);
        }
    }
}
}