<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */




    public function index()
    {
        //
        $projects = auth()->user()->allProjects();

        return view('projects.index', ['projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        if (!auth()->check())
            abort(403);
        //$this->authorize('update', $project);

        $attributes =  request()->validate(['title' => 'required', 'description' => 'required', 'notes' => 'min:3']);



        $project = auth()->user()->projects()->create($attributes);

        //   /  $this->authorize('update', $project);

        return redirect($project->path());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $this->authorize('update', $project);


        return view('projects.show', compact('project'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Project $project)
    {

        $this->authorize('update', $project);

        $attributes = request()->validate(['notes' => 'sometimes|required', 'title' => 'sometimes|required', 'description' => 'sometimes|required']);

        $project->update(
            $attributes
        );

        return redirect($project->path());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Project $project)
    {

        $this->authorize('update', $project);


        return view('projects.update', compact('project'));
    }

    public function destroy(Project $project)
    {
        $this->authorize('update', $project);

        $project->delete();

        return redirect('/projects');
    }
}
