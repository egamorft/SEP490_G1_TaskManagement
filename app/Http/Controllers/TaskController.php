<?php

namespace App\Http\Controllers;

use App\Models\AccountProject;
use App\Models\Task;
use App\Models\PermissionRole;
use App\Models\ProjectRolePermission;
use App\Http\Controllers\Controller;
use App\Http\Requests\TasksRequest;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\SubTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
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

        return view('tasks/index', ['breadcrumbs' => $breadcrumbs, 'pageConfigs' => $pageConfigs, 'page' => ''])->with(compact('project'));

	}

    public function create(TasksRequest $request, $slug) {
        $project = Project::where("slug", $slug)->first();

        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => "Can't find project"
            ]);
        }

        $task = [
            "name" => $request->input("listTitleAdd"),
            "project_id" => $project->id,
            "limitation" =>  10, //$request->input("task_limitation"),
            "description" => "No description" //$request->input("task_description")
        ];

        $taskCreated = Task::create($task);
        if (!$taskCreated) {
            return response()->json([
                'success' => false,
                "message" => "Can't create task for project {$project->name}"
            ]);
        }

        Session::flash('success', 'Create successfully task list ' . $taskCreated->name);
        return redirect("projects/{$project->slug}");

    }

    public function edit() {
        return view("tasks/edit");
    }

    public function update(TasksRequest $request, $id) {
        $task = Task::findOrFail($id)->first();
        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => "Task not found!"
            ]);
        }
        
        $task->name = $request->input("task_name");
        $task->limitation = $request->input("task_limitation");
        $task->description = $request->input("task_description");

        $task->save();

        Session::flash("success", "Successfully update task");
        return response()->json(["success" => true]);
    }

    public function delete($id) {
        $task = Task::findOrFail($id)->first();
        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => "Task not found!"
            ]);
        }

        $subTasks = SubTask::where("task_id", $task->id)->get();
        if (count($subTasks) > 0) {
            return response()->json([
                'success' => false,
                'message' => "Cannot delete Task contains Subtasks"
            ]);
        }

        $task->delete();

        Session::flash("success", "Successfully delete task");
        return response()->json(["success" => true, "message" => "Task Deleted"]);
    }
}
