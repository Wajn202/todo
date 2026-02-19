<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Models\ProjectInvitation;
use App\Mail\ProjectInvitationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class InvitationController extends Controller
{
    public function store(Request $request, Project $project)
    {
        abort_if(auth()->id() !== $project->owner_id, 403);

        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::findOrFail($request->user_id);

        $invite = ProjectInvitation::create([
            'project_id' => $project->id,
            'user_id'    => $user->id,
            'email'      => $user->email,
            'token'      => Str::uuid(),
        ]);

        Mail::to($user->email)->send(
            new ProjectInvitationMail($invite)
        );

        return back()->with('success', 'Invitation sent');
    }

    public function show(ProjectInvitation $invitation)
    {

    return view('invitations.show', compact('invitation'));

    }

    public function accept(ProjectInvitation $invitation)
{
    if ($invitation->status !== 'pending') {
        return back()->with('error', 'Invitation already responded.');
    }

    $invitation->update(['status' => 'accepted']);
    $invitation->project->users()->attach($invitation->user_id);

    auth()->logout();

    return redirect()->route('login')
                     ->with('success', 'You joined the project successfully.');
}

public function decline(ProjectInvitation $invitation)
{
    if ($invitation->status !== 'pending') {
        return back()->with('error', 'Invitation already responded.');
    }

    $invitation->update(['status' => 'rejected']);
    
    auth()->logout();

    return redirect()->route('login')
                     ->with('success', 'You declined the invitation.');
}
}