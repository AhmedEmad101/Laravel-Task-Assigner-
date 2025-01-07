<?php

namespace App\Providers;

use App\Models\ContactUs;
use App\Models\Project;
use App\Models\Subscription;
use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use App\Models\Tier;
use App\Models\WorkOn;
use Illuminate\Support\ServiceProvider;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        view()->composer(['AllProjects','admin','PartialViews.admin.allusers','subscriptions','mytasks','myteams','workon','test.teamtest'], function ($view) {
            //$Creator = session()->get('uid');
            $AssignmentorId = session()->get('AssignmentorId');
            $userNames = WorkOn::with(['task', 'user'])
            ->whereHas('task', function ($query) use ($AssignmentorId) {
                $query->where('Creator', $AssignmentorId); // Filter tasks by creator
            })
            ->get()
            ; // Get the name of the related users

            $Creator = session()->get('Creator');
            $taskCreator = session()->get('TaskCreator');
            $Profileprojects = Project::where('Creator',$Creator)->get();
            $Profiletasks = Task::where('Creator',$taskCreator)->get();
            $Profileteams = Team::where('leader_Id',$Creator)->orWhere('member_id',$Creator)->get()->groupBy('name');
            $Project = Project::all();
            $user = User::paginate(7);
            $task = Task::all();
            $team = Team::all();
            $tier = Tier::all();
            $view->with(['Project'=>$Project,'PfProjects'=>$Profileprojects,'user'=>$user ,'task'=>$task,'PfTasks'=>$Profiletasks ,'team'=>$team,'PfTeams'=>$Profileteams,'tier'=>$tier , 'workon'=>$userNames]);
        });
        view()->composer(['PartialViews.admin.Contacts'],function($view)
    {
        $Contacts = ContactUs::all();
        $view->with(['Contacts'=>$Contacts]);

    });

    }
}
