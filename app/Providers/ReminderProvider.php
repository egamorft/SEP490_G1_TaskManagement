<?php

namespace App\Providers;

use App\Models\Board;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ReminderProvider extends ServiceProvider
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
        //
        View::composer('panels.reminderLayout', function ($view) {
            $account = Auth::user();
            $tasksReminder = [];
            if($account){
                $tasksReminder = Task::where("assign_to", $account->id)->get();           
                $view->with('tasksReminder', $tasksReminder);
            }else{
                $view->with('tasksReminder', $tasksReminder);
            }
            
        });
    }
}
