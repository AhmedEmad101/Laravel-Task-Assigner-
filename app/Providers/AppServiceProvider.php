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
        view()->composer(['AllProjects','admin','PartialViews.admin.allusers','subscriptions','mytasks'], function ($view) {

            $Project = Project::all();
            $user = User::all();
            $task = Task::all();
            $team = Team::all();
            $tier = Tier::all();
            $view->with(['Project'=>$Project,'user'=>$user ,'task'=>$task ,'team'=>$team,'tier'=>$tier]);
        });
    }
}
