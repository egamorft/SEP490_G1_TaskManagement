<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class NotificationProvider extends ServiceProvider
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
        View::composer('panels.navbar', function ($view) {
            $account = Auth::user();
            if($account){
                $projects = $account->projects()->wherePivot('status', 1)->where('project_status', '!=', -1)->get();
                $view->with('projects', $projects);
            }else{
                $view->with('projects', []);
            }
        });
    }
}
