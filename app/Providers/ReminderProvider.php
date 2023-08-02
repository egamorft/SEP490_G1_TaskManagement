<?php

namespace App\Providers;

use App\Enums\TaskStatus;
use App\Models\Board;
use App\Models\Task;
use Carbon\Carbon;
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
            $tasksLateReminder = [];
            $tasksTodayReminder = [];
            if($account){
                $tasksReminder = Task::where("assign_to", $account->id)
                                        ->whereIn("status", [TaskStatus::TODO, TaskStatus::DOING])
                                        ->get();
                $tasksLateReminder = Task::where("assign_to", $account->id)
                                        ->whereIn("status", [TaskStatus::TODO, TaskStatus::DOING])
                                        ->where("due_date", "<", Carbon::now())
                                        ->get();
                $tasksTodayReminder = Task::where("assign_to", $account->id)
                                        ->whereIn("status", [TaskStatus::TODO, TaskStatus::DOING])
                                        ->where("due_date", ">=", strtotime("midnight", time()))
                                        ->where("due_date", "<=", strtotime("tomorrow", time())-1)
                                        ->get();
                
                $view->with(compact(
                    'tasksReminder',
                    'tasksLateReminder',
                    'tasksTodayReminder'
                ));
            }else{
                $view->with(compact(
                    'tasksReminder',
                    'tasksLateReminder',
                    'tasksTodayReminder'
                ));
            }
            
        });
    }
}
