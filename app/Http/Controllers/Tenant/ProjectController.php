<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Requests\Tenant\ProjectStoreRequest;
use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function index()
    {
        $projects = cache()->remember('projects', 10, function () {
            return Project::get();
        });

        return view('tenant.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tenant.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProjectStoreRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function store(ProjectStoreRequest $request)
    {
        $project = new Project;
        $project->fill($request->all());
        $project->save();

        cache()->forget('projects');

        return redirect()->route('projects.show', $project)
            ->withSuccess("Project created successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $project->loadMissing('files');

        return view('tenant.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project $project
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Project $project)
    {
        try {
            $project->delete();
        } catch (\Exception $e) {
            return back()->withError("Failed deleting `{$project->name}` project.");
        }

        cache()->forget('projects');

        return redirect()->route('projects.index')
            ->withSuccess("{$project->name} deleted successfully.");
    }
}
