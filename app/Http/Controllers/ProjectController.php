<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{


    public function index()
    {
        $projects = Project::all();

        return view('projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        // $project = Project::findOrFail(request('project'));
        return view('projects.show', compact('project'));
    }

    public function store()
    {

        // validate
        $attributes =  request()->validate([
            'title' => 'required',
            'description' => 'required',

        ]);

        // Set the owner_id to the authenticated user's ID
        // $attributes['owner_id'] = auth()->user()->id;

        // Create a new project for the authenticated user
        Auth::user()->projects()->create($attributes);

        // redirect

        return redirect('/projects');
    }
}
