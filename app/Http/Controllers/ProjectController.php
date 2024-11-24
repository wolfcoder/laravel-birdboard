<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{


    public function index()
    {
        $projects =  Auth::user()->projects;

        return view('projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        // if (Auth::user()->id !== $project->owner_id) {
        //     abort(403);
        // }

        // Alternatif

        // if (auth()->id() !== $project->owner_id) {
        //     abort(403);
        // }

        // isNot

        if (auth()->user()->isNot($project->owner)) {
            abort(403);
        }

        return view('projects.show', compact('project'));
    }

    public function store()
    {

        // validate
        $attributes =  request()->validate([
            'title' => 'required',
            'description' => 'required',

        ]);

        // Create a new project for the authenticated user
        Auth::user()->projects()->create($attributes);

        // redirect

        return redirect('/projects');
    }
}
