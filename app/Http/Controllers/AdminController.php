<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\Todo;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard',[
            'users'=>User::count(),
            'projects'=>Project::count(),
            'todos'=>Todo::count(),
            'completed'=>Todo::where('status','done')->count()
        ]);
    }

    public function makeAdmin(User $user)
    {
        $user->update(['role'=>'admin']);
        return back();
    }
}

