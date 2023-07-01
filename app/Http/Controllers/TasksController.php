<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\ProjectRequest;
use App\Models\AccountProject;
use App\Models\PermissionRole;
use App\Models\Project;
use App\Models\ProjectRolePermission;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function index($slug, $id) {
		$project = Project::where('slug', $slug)->first();
		$breadcrumbs = [['link' => "javascript:void(0)", 'name' => "Doing"]];

		$pageConfigs = [
            'pageHeader' => true,
            'pageClass' => 'todo-application',
        ];

        return view('tasks.index', ['breadcrumbs' => $breadcrumbs, 'pageConfigs' => $pageConfigs, 'page' => ''])->with(compact('project'));

	}
}
