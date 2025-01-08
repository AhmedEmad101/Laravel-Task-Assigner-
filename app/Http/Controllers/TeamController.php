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
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeamRequest $request)
    {

        $leader_ID = $request->leader_Id;
        $Team = Team::create([
            'name'=> $request->name,
            'leader_Id'=> $leader_ID,
            'member_id'=>$leader_ID

        ]);
        $Team->save();

        return redirect('home')->with('success-addteam', 'you have created team '.$request->name .' successfully');
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
    public function destroy(Request $request,Team $team)
    {
        $User_ID =  session()->get("Creator");
        $User = User::find($User_ID);
        if (Gate::forUser($User)->denies('delete-team', $team))
        {
            abort(403);}

        Team::where('leader_Id',$User_ID)->delete();

        return redirect()->back()->with('Team_deleted','Team has been deleted successfully');
    }
    public function ToTeamMember(Request $request)
    {
     session()->Put('Leader_ID',$request->Leader_ID);
     session()->Put('Team_Name',$request->Team_Name);
     session()->Put('Team_ID',$request->Team_ID);
        return view('Member');
    }
    public function SearchUser(Request $request)
    {$userid =  session()->get("Creator")??session()->get('TaskCreator');//because it's the two pages ajax is used in Creator is stored in myteams and Task creator is stored in my tasks
        if($request->ajax())
        {
            $data = User::where('role', 1)->whereNot('id',$userid)
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
                <th >Name</th>
                <th>ID</th>
            </tr>
        </thead>
        <tbody>';
        foreach($data as $row)
        {$output.=
        '
            <tr><select><option id ="aaa" value = '.$row->name.'>
                <td >'.$row->name.'</td></option>
                <td>'.$row->id.'</td></select>
            </tr>

        </tbody>
    </table>
    <script> document.getElementById("search_member_id").value = document.getElementById("aaa").value</script>
             ';
            }

}

        else{
            $output.='no results found';
        }

    return $output;
        }
}
    public function AddTeamMember(Team $team , Request $request)
    {   $Member_Name = $request->search;
        $Member = User::where('name',$Member_Name)->first();
        $LeaderID = session()->get('Leader_ID');
        $TeamName = session()->get('Team_Name');
$Query = Team::where('name',$TeamName)->where('member_id',$Member->id);
  if($Query->count() < 1){
        $team->create([
            'name'=>$TeamName,
            'leader_Id'=>$LeaderID,
            'member_id'=>$Member->id
        ]);
        $team->save();
        return redirect('myteams')->with('Success_add_member','user '.$Member_Name.'has been added to team '.$TeamName);
    }
    else
    {
        return redirect('myteams')->with('Failed_add_member','user '.$Member_Name.' already in team '.$TeamName);
    }

    }
public function DeleteTeamMember($TeamName,$UserId)
{
$User = User::find($UserId);
$Team = Team::where('name',$TeamName);
dd($UserId);
Team::where('member_id',$User->id)->where('id',$Team->id)->delete();
return redirect('myteams')->with(['member_deleted', $User->name.' has been deleted successfully from team '.$Team->name]);
}
}
