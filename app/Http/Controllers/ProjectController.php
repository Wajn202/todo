<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\ProjectRequest;
use App\Models\ProjectInvitation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ProjectInvitationMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class ProjectController extends Controller
{
     /**
     * Display a listing of the projects.
     */
    public function index(): View
    {
        $projects = Project::with('todos')->latest()->get();

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new project.
     */
    public function create(): View
    {
        return view('projects.create');
    }

    /**
     * Store a newly created project in storage.
     */
    public function store(ProjectRequest $request): RedirectResponse
    {
        $project = Project::create([
        'name' => $request->name,
        'description' => $request->description,
        'owner_id' => auth()->id(), 
    ]);

    return redirect()
        ->route('projects.show', $project)
        ->with('success', 'Project created successfully');
    }

    /**
     * Display the specified project.
     */
    public function show(Project $project): View
    {
        $project->load(['todos' => function($q) {
            $q->latest();}]);

        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified project.
     */
    public function edit(Project $project): View
    {
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified project in storage.
     */
    public function update(ProjectRequest $request, Project $project): RedirectResponse
    {
    $project->update($request->validated());

    return redirect()
        ->route('projects.index')
        ->with('success', 'Project updated successfully');
    }

    /**
     * Remove the specified project from storage.
     */
    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();

        return redirect()
            ->route('dashboard')
            ->with('success', 'Project deleted successfully');
    }


    public function invite(Request $request, Project $project)
{

    if (auth()->id() !== $project->owner_id) {
        abort(403);
    }

    $request->validate([
        'user_id' => 'required|exists:users,id',
    ]);

    $user = User::findOrFail($request->user_id);

    $existing = ProjectInvitation::where('project_id', $project->id)
        ->where('user_id', $user->id)
        ->where('status', 'pending')
        ->first();

    if ($existing) {
        return back()->with('error', 'User already invited.');
    }

    $invitation = ProjectInvitation::create([
        'project_id' => $project->id,
        'user_id'    => $user->id,
        'email'      => $user->email,
        'status'     => 'pending',
        'token'      => Str::uuid(),
    ]);


    Mail::to($user->email)->send(
        new ProjectInvitationMail($invitation)
    );
    return back()->with('success', 'Invitation sent successfully.');
}
}