<?php

namespace App\Http\Controllers;

use App\Models\WorkOn;
use App\Http\Controllers\Controller;
use App\Http\Requests\WorkOnRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class WorkOnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {$AssignmentorId = $request->Assignment;
     session()->put('AssignmentorId',$AssignmentorId);

    return view('workon');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WorkOnRequest $request, Task $task)
    { try {
        $Project_Id = $task->Project->id;
        $username = $request->search_member_id;
        $user = User::where('name',$username)->firstOrFail();
       $Assignment = WorkOn::create([
        'user_Id'=>$user->id,
        'project_id'=>$Project_Id,
        'task_id'=>$task->id
       ]);
       $Assignment->save();
       return back()->with('user_assigned' , 'User '.$username. ' has been assigned to task id'.$task->id);
    }
    catch (ModelNotFoundException $e) {
        return redirect()->back()->withErrors(['error' => 'User not found']);
    }

    }

    /**
     * Display the specified resource.
     */
    public function show(WorkOn $workOn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WorkOn $workOn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WorkOn $workOn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorkOn $workOn)
    {
        //
    }
}
