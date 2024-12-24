<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Http\Controllers\Controller;
use App\Http\Requests\TeamRequest;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $Creator =$request->CreatorID;
        session()->put("Creator", $Creator);
        return view("myteams",);
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
    public function store(TeamRequest $request)
    {

        $Creator = session()->get('uid');
        $Team = Team::create([
            'name'=> $request->name,
            'leader_Id'=> $Creator,

        ]);
        //return redirect('home')->with('success', 'User created successfully');
        return response()->json(['done']);
    }


    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        if (Gate::denies('delete-team', $team))
        {
        abort(403);}
        $team->delete();

        return response()->json(['deleted successfully']);
    }
    public function ToTeamMember(Request $request)
    {
     session()->Put('UserID',$request->User_ID);
        dd($request->User_ID);
        return view('Member');
    }
    public function SearchUser(Request $request)
    {
        if($request->ajax())
        {
            $data = User::where('role', 1)
    ->where(function ($query) use ($request) {
        $query->where('id', $request->search)
              ->orWhere('name', 'like', '%' . $request->search . '%');
    })
    ->get();
             $output = '';
             if(count($data)>0){
             $output = ' <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>ID</th>
            </tr>
        </thead>
        <tbody>';
        foreach($data as $row)
        {$output.=
        '
            <tr>
                <td>'.$row->name.'</td>
                <td>'.$row->id.'</td>
            </tr>

        </tbody>
    </table>
             ';
            }

}

        else{
            $output.='no results found';
        }

    return $output;
        }
}
    public function AddTeamMember(Team $team)
    {
        $team->create([
            '',
            '',
            ''
        ]);
        return redirect()->back();

    }

}
