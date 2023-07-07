<?php

namespace App\Http\Controllers;

use App\Models\AccountProject;
use App\Models\Task;
use App\Models\PermissionRole;
use App\Models\ProjectRolePermission;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\SubTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;


class TaskController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function index($slug, $id) {
		$project = Project::where('slug', $slug)->first();
        // $task = Task::where('project_id', $project->id)->get();
		$breadcrumbs = [['link' => "javascript:void(0)", 'name' => "Doing"]];

		$pageConfigs = [
            'pageHeader' => true,
            'pageClass' => 'todo-application',
        ];

        return view('task.index', ['breadcrumbs' => $breadcrumbs, 'pageConfigs' => $pageConfigs,  'page' => 'task-list'])->with(compact('project'));

	}

    public function create(TaskRequest $request, $slug) {
        $project = Project::where("slug", $slug)->first();

        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => "Can't find project"
            ]);
        }

        $task = [
            "name" => $request->input("taskListTitle"),
            "project_id" => $project->id,
            "limitation" =>  10,
            "description" => $request->input("taskListDescription")
        ];

        $taskCreated = Task::create($task);
        if (!$taskCreated) {
            return response()->json([
                'success' => false,
                "message" => "Can't create task for project {$project->name}"
            ]);
        }

        Session::flash('success', 'Create successfully task list ' . $taskCreated->name);
        return redirect("project/{$project->slug}/task-list");

    }

    public function edit() {
        // 
    }

    public function update(TaskRequest $request, $slug, $id) {
        $task = Task::findOrFail($id);
        
        $task->name = $request->input("taskListTitle");
        $task->limitation = 10;//$request->input("taskListLimitation");
        $task->description = $request->input("taskListDescription");

        $task->save();

        Session::flash("success", "Successfully update task " . $task->name);
        return redirect(URL::previous());
    }

    public function remove($slug, $id) {
        $task = Task::findOrFail($id);
        $taskName = $task->name;
        $subTasks = SubTask::where("task_id", $task->id)->get();
        foreach($subTasks as $subTask) {
            $subTask->delete();
        }

        $task->delete();

        Session::flash("success", "Successfully delete task " . $taskName);
        return redirect("/project/" . $slug . "/task-list");
    }
}
