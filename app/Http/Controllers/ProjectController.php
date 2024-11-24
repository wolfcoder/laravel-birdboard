<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();

        return view('projects.index', compact('projects'));
    }

    public function store()
    {
        // validate
        $attributes =  request()->validate(['title' => 'required', 'description' => 'required']);

        // persist
        Project::create($attributes);

        // dd($response);
        // redirect

        return redirect('/projects');
    }
}
