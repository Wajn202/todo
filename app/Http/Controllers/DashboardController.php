<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $ownedProjects = $user->ownedProjects()->withCount('todos')->get();
        $sharedProjects = $user->projects()->get();
        $personalTodos = $user->personalTodos()->whereNull('project_id')->latest()->get();

        return view('dashboard', compact('ownedProjects', 'sharedProjects', 'personalTodos'));
    }
}