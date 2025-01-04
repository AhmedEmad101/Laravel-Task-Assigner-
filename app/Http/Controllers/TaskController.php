<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use Database\Seeders\TaskSeeder;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        session()->put('TaskCreator',$request->TaskCreator);
        return view('mytasks');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        session()->put('ProjectId',$request->ProjectId);
        return view('Task');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        $Task_Creator_Id = session()->get('Creator');
        $ProjectId = session()->get('ProjectId');
        $name = $request->name;
        $Task_Description = $request->task_description;
        $Task = Task::create(['Creator'=>$Task_Creator_Id,'Project_ID'=>$ProjectId,'name'=>$name,'Description'=>$Task_Description]);
        $Task->save();
        return redirect('home')->with('task_created','Task Created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
        if (Gate::denies('edit-task', $task)) {
            return response()->json(['error' => 'You are not authorized to edit this task.'], 403);
        }
        $task->update($request->all());

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->back();
    }
}
