<?php

namespace App\Providers;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ProjectsComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('panels.sidebar', function ($view) {
            $account = Auth::user();
            if($account){
                $projects = $account->projects;
                $view->with('projects', $projects);
            }else{
                $view->with('projects', []);
            }
            
        });
    }
}
