<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $projects = Project::where('Creator',auth()->id())->paginate(10);
       return view('AllProjects',['projects'=>$projects]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('project.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        $Creator = auth()->user()?->id;
       $title = $request->title;
       $description = $request->description;
       $Project = Project::create(['Creator'=> $Creator ,'title'=> $title,'description'=> $description]);
       $Project->save();
       return redirect('home')->with('project_created','Project Created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->back();
    }
   public function suggestDescription(Request $request)
{
    $response = Http::timeout(60)->post('http://172.17.0.1:8000/generate-description', [
        'title' => $request->string('title'),
        'context_type' => $request->string('context_type', 'project'),
    ]);

    if ($response->successful()) {
        return response()->json($response->json());
    }

    // Dump the actual error details from FastAPI
    return response()->json([
        'status' => $response->status(),
        'error_from_python' => $response->json() ?? $response->body(),
    ], 500);
}
}
