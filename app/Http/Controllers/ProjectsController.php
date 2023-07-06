<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Account;
use App\Models\AccountProject;
use App\Models\PermissionRole;
use App\Models\Project;
use App\Models\ProjectRolePermission;
use App\Models\SubTask;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ProjectsController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $project = Project::where('slug', $slug)->first();
        $tasksQuery = Task::where('project_id', $project->id);
        $tasks = $tasksQuery->get();
        $taskIds = $tasksQuery->addSelect("id")->get();
        $subTasks = SubTask::whereIn("task_id", $taskIds)->get();

        $todo = 0;
        $doing = 0;
        $reviewing = 0;
        $doneOntime = 0;
        $doneLate = 0;
        $overdue = 0;

        $subTasksRelease = [];
        foreach ($tasks as $task) {
            if (isset($subTasksRelease[$task->id])) {
                continue;
            }
            $subTasksRelease[$task->id] = [];
        }

        foreach($subTasks as $subTask) {
            switch ($subTask->status) {
                case SubTask::$STATUS_TODO:
                    $todo++;
                    break;
                case SubTask::$STATUS_DOING:
                    $doing++;
                    break;
                case SubTask::$STATUS_REVIEWING:
                    $reviewing++;
                    break;
                case SubTask::$STATUS_DONE_ONTIME:
                    $doneOntime++;
                    break;
                case SubTask::$STATUS_DONE_LATE:
                    $doneLate++;
                    break;
                case SubTask::$STATUS_OVERDUE:
                    $overdue++;
                    break;
                default:
                    $todo++;
                    break;
            }
            if (!isset($subTasksRelease[$subTask->task_id])) {
                $subTask[$subTask->task_id] = [$subTask]; 
                continue;
            }
            array_push($subTasksRelease[$subTask->task_id], $subTask);
        }

        $totalSubTask = count($subTasks);

        $subTaskStatusesPercent = [
            "todo" => round($todo / $totalSubTask, 2),
            "doing" => round($doing / $totalSubTask, 2),
            "reviewing" => round($reviewing / $totalSubTask, 2),
            "doneOntime" => round($doneOntime / $totalSubTask, 2),
            "doneLate" => round($doneLate / $totalSubTask, 2),
            "overdue" => round($overdue / $totalSubTask, 2)
        ];

        $accountsProject = AccountProject::where('project_id', $project->id)->get();
        
        $accountIds = [];
        foreach($accountsProject as $accProj) {
            $accountIds[] = $accProj->account_id;
        }

        $accounts = Account::whereIn("id", $accountIds)->get();

		$breadcrumbs = [['link' => "javascript:void(0)", 'name' => "Doing"]];

		$pageConfigs = [
            'pageHeader' => true,
            'pageClass' => 'todo-application',
        ];

        $pmAccount = Project::findOrFail($project->id)
			->findAccountWithRoleNameAndStatus('pm', 1)
			->first();

        $supervisorAccount = Project::findOrFail($project->id)
        ->findAccountWithRoleNameAndStatus('supervisor', 1)
        ->first();
        
        $memberAccounts = Project::findOrFail($project->id)
        ->findAccountWithRoleNameAndStatus('member', 1)
        ->get();

        return view('projects.index', ['breadcrumbs' => $breadcrumbs, 'pageConfigs' => $pageConfigs, 'page' => ''])
            ->with(compact(
                'project', 
                'tasks', 
                'accounts', 
                'subTasksRelease',
                'pmAccount',
                'supervisorAccount',
                'memberAccounts',
                'subTaskStatusesPercent'
            ));
    }

	 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gantt($slug)
    {
        $project = Project::where('slug', $slug)->first();
		$pageConfigs = [
            'pageHeader' => true,
            'pageClass' => 'todo-application',
        ];

		$breadcrumbs = [['link' => "javascript:void(0)", 'name' => "Doing"]];
        return view('projects.gantt', ['breadcrumbs' => $breadcrumbs, 'pageConfigs' => $pageConfigs, 'page' => 'gantt'])->with(compact('project'));
    }

	 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function kanban($slug)
    {
        $project = Project::where('slug', $slug)->first();
		$pageConfigs = [
            'pageHeader' => true,
            'pageClass' => 'kanban-application',
        ];

		$breadcrumbs = [['link' => "javascript:void(0)", 'name' => "Doing"]];
        return view('projects.kanban', ['breadcrumbs' => $breadcrumbs, 'pageConfigs' => $pageConfigs, 'page' => 'kanban'])->with(compact('project'));
    }

	 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function calendar($slug)
    {
        $project = Project::where('slug', $slug)->first();
		$pageConfigs = [
            'pageHeader' => true,
        ];

		$breadcrumbs = [['link' => "javascript:void(0)", 'name' => "Doing"]];
        return view('projects.calendar', ['breadcrumbs' => $breadcrumbs, 'pageConfigs' => $pageConfigs, 'page' => 'calendar'])->with(compact('project'));
    }

	 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function report($slug)
    {
        $project = Project::where('slug', $slug)->first();
		$pageConfigs = [
            'pageHeader' => true,
            'pageClass' => 'todo-application',
        ];

		$breadcrumbs = [['link' => "javascript:void(0)", 'name' => "Doing"]];
        return view('projects.report', ['breadcrumbs' => $breadcrumbs, 'pageConfigs' => $pageConfigs, 'page' => 'report'])->with(compact('project'));
    }

	 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function settings($slug)
    {
        $project = Project::where('slug', $slug)->first();
		$pageConfigs = [
            'pageHeader' => true,
            'pageClass' => 'todo-application',
        ];

		$breadcrumbs = [['link' => "javascript:void(0)", 'name' => "Doing"]];
        return view('projects.settings', ['breadcrumbs' => $breadcrumbs, 'pageConfigs' => $pageConfigs, 'page' => 'settings'])->with(compact('project'));
    }
}
