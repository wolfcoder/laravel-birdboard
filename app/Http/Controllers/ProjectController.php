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

        // persist

        $response =  Project::create(request(['title', 'description']));

        // dd($response);
        // redirect

        return redirect('/projects');
    }
}
