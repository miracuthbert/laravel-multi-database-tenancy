<?php

namespace App\Http\Controllers\Tenant;

use App\File;
use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProjectFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Project $project)
    {
        $upload = $request->file('file');

        if ($path = Storage::disk('tenant')->putFile('/', $upload)) {
            $file = File::make([
                'name' => $upload->getClientOriginalName(),
                'path' => $path,
            ]);

            $project->files()->save($file);
        }

        return back()->withSuccess("File uploaded successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project $project
     * @param  \App\File $file
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project, File $file)
    {
        return Storage::disk('tenant')->download($file->path, $file->name);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project $project
     * @param  \App\File $file
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project, File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Project $project
     * @param  \App\File $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project $project
     * @param  \App\File $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project, File $file)
    {
        try {
            $file->delete();
            Storage::disk('tenant')->delete($file->path);
        } catch (\Exception $e) {
            return back()->withError("Failed deleting `{$file->name}` from project.");
        }

        return back()->withSuccess("{$file->name} deleted from project.");
    }
}
