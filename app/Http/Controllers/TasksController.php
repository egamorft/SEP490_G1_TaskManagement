<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Controllers\Controller;
use App\Http\Requests\TasksRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TasksController extends Controller
{
    public function index($id) {
        $tasks = DB::select("select * from Tasks where project_id = :project_id", [
            "project_id" => $id
        ]);

        return view("layouts/tasks/index", [
            "tasks" => $tasks
        ]);
    }

    public function task_list(TasksRequest $request, $project_id) {
        $project = Project::findOrFail($project_id);

        $tasks = DB::select("select * from Tasks where project_id = :project_id", [
            "project_id" => $project_id
        ]);

        Session::flash("success", "Get data successfully");
        return response()->json([
            'success' => true,
            'data' => $tasks
        ]);
    }

    public function create() {
        return view("layouts/tasks/create");
    }

    public function store(TasksRequest $request) {
        $task = [
            "name" => $request->input("task_name"),
            "project_id" => $request->input("project_id"),
            "limitation" => $request->input("task_limitation"),
            "description" => $request->input("task_description")
        ];

        Task::create($task);

        Session::flash('success', "Create Task successfully!");
        return redirect()->route("layouts/tasks");
        // return response()->json(['success' => true, "message" => "Task created"]);
    }

    public function edit() {
        return view("tasks/edit");
    }

    public function update(TasksRequest $request, $id) {
        $task = Task::findOrFail($id);
        
        $task->name = $request->input("task_name");
        $task->limitation = $request->input("task_limitation");
        $task->description = $request->input("task_description");

        $task->save();

        Session::flash("success", "Successfully update task");
        return response()->json(["success" => true]);
    }

    public function delete(TasksRequest $request, $id) {
        $task = Task::findOrFail($id);
        
        $task->delete();

        Session::flash("success", "Successfully delete task");
        return response()->json(["success" => true, "message" => "Task Deleted"]);
    }
}
