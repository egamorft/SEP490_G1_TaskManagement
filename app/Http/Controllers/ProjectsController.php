<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\AccountProject;
use App\Models\PermissionRole;
use App\Models\Project;
use App\Models\ProjectRolePermission;
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
		$pageConfigs = [
            'pageHeader' => false,
            'contentLayout' => "content-left-sidebar",
            'pageClass' => 'todo-application',
        ];

		return view('projects.index', [
            'pageConfigs' => $pageConfigs
        ])->with(compact('project'));
    }

	/**
     * Listing all task in project.
     *
     * @return \Illuminate\Http\Response
     */
    public function listTasks($slug)
    {
        $project = Project::where('slug', $slug)->first();
        return view('projects.index')
            ->with(compact(
                'project'
            ));
    }
}
