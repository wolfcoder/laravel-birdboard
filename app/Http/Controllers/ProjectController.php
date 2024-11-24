<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config; // Add this line

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

        auth()->user()->projects()->create($attributes);

        // redirect

        return redirect('/projects');
    }
}
