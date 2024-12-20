<?php

namespace App\Providers;

use App\Models\Project;
use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use App\Models\Tier;
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
        view()->composer(['AllProjects','admin','PartialViews.admin.allusers','subscriptions','mytasks','myteams'], function ($view) {
            $Creator = session()->get('uid');
            $Profileprojects = Project::where('Creator',$Creator)->get();
            $Profiletasks = Task::where('Creator',$Creator)->get();
            $Profileteams = Team::where('leader_Id',$Creator)->orWhere('member_id',$Creator)->get();
            $Project = Project::all();
            $user = User::all();
            $task = Task::all();
            $team = Team::all();
            $tier = Tier::all();
            $view->with(['Project'=>$Project,'PfProjects'=>$Profileprojects,'user'=>$user ,'task'=>$task,'PfTasks'=>$Profiletasks ,'team'=>$team,'PfTeams'=>$Profileteams,'tier'=>$tier]);
        });
    }
}
