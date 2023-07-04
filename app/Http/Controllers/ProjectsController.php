<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Account;
use App\Models\AccountProject;
use App\Models\PermissionRole;
use App\Models\Project;
use App\Models\ProjectRolePermission;
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
        $tasks = Task::where('project_id', $project->id)->get();
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

        return view('projects.index', ['breadcrumbs' => $breadcrumbs, 'pageConfigs' => $pageConfigs, 'page' => ''])->with(compact('project', 'tasks', 'accounts'));
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
