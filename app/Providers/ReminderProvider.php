<?php

namespace App\Providers;

use App\Enums\TaskStatus;
use App\Models\Board;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskList;
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
                
                // 
                $taskList_ids = [];
                foreach ($tasksReminder as $task) {
                    $taskList_ids[] = $task->taskList_id;
                }

                $taskList_ids = array_unique($taskList_ids);
                $taskLists = TaskList::whereIn("id", $taskList_ids)->get();

                $board_ids = [];
                foreach($taskLists as $taskList) {
                    $board_ids[] = $taskList->board_id;
                }
                $board_ids = array_unique($board_ids);
                $boards = Board::whereIn("id", $board_ids)->get();

                $project_ids = [];
                foreach ($boards as $board) {
                    $project_ids[] = $board->project_id;
                }
                $projects = Project::whereIn("id", $project_ids)->get();

                $boardProjects = [];
                foreach($projects as $project) {
                    $boardProjects[$project->id] = $project;
                }

                $taskListBoards = [];
                foreach ($boards as $board) {
                    if (!isset($boardProjects[$board->project_id])) {
                        continue;
                    }
                    $board->project = $boardProjects[$board->project_id];
                    $taskListBoards[$board->id] = $board;
                }

                $taskInTaskLists = [];
                foreach ($taskLists as $taskList) {
                    if (!isset($taskListBoards[$taskList->board_id])) {
                        continue;
                    }
                    $taskList->board = $taskListBoards[$taskList->board_id];
                    $taskList->project = $taskList->board->project;
                    $taskInTaskLists[$taskList->id] = $taskList;
                }

                foreach($tasksReminder as $task) {
                    if (!isset($taskInTaskLists[$task->taskList_id])) {
                        continue;
                    }
                    $task->taskList = $taskInTaskLists[$task->taskList_id];
                    $task->board = $task->taskList->board;
                    $task->project = $task->taskList->project;
                }

                foreach($tasksLateReminder as $task) {
                    if (!isset($taskInTaskLists[$task->taskList_id])) {
                        continue;
                    }
                    $task->taskList = $taskInTaskLists[$task->taskList_id];
                    $task->board = $task->taskList->board;
                    $task->project = $task->taskList->project;
                }

                foreach($tasksTodayReminder as $task) {
                    if (!isset($taskInTaskLists[$task->taskList_id])) {
                        continue;
                    }
                    $task->taskList = $taskInTaskLists[$task->taskList_id];
                    $task->board = $task->taskList->board;
                    $task->project = $task->taskList->project;
                }
                
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
