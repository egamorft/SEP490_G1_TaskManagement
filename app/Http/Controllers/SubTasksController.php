<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TasksRequest;
use App\Models\SubTask;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SubTasksController extends Controller
{
    public function taskList(TasksRequest $request, $task_id) {
        $task = Task::findOrFail($task_id);

        $sub_tasks = DB::select("select * from SubTasks where task_id = :task_id", [
            "task_id" => $task_id
        ]);

        Session::flash("success", "Get data successfully");
        return response()->json([
            'success' => true,
            'data' => $sub_tasks
        ]);
    }

    public function create() {
        return view("layouts/tasks/sub.tasks/create");
    }

    public function store(TasksRequest $request) {
        $sub_task = [
            "name" => $request->input("sub_task_name"),
            "image" => $request->file("images"),
            "description" => $request->input("sub_task_description"),
            "attachment" => $request->file("attachment"),
            "due_date" => $request->date("due_date"),
        ];

        SubTask::create($sub_task);

        Session::flash('success', "Create Sub Task successfully!");
        return redirect()->route("layouts/tasks/sub.tasks");
        // return response()->json(['success' => true, "message" => "Task created"]);
    }

    public function edit() {
        return view("tasks/sub.tasks/edit");
    }

    public function update(TasksRequest $request, $id) {
        $sub_task = SubTask::findOrFail($id);
        
        $sub_task->name = $request->input("sub_task_name");
        $sub_task->image = $request->file("image");
        $sub_task->description = $request->input("sub_task_description");
        $sub_task->attachment = $request->file("attachment");
        $sub_task->due_date = $request->date("due_date");

        $sub_task->save();

        Session::flash("success", "Successfully update sub task");
        return response()->json(["success" => true]);
    }

    public function delete(TasksRequest $request, $id) {
        $sub_task = Task::findOrFail($id);
        
        $sub_task->delete();

        Session::flash("success", "Successfully delete sub task");
        return response()->json(["success" => true, "message" => "Sub Task Deleted"]);
    }

    private function hasPermission() {
        $user = Auth::user();
        
        // $account_role = 
        return false;
    }

    public function assign(TasksRequest $request, $id) {
        $task = Task::findOrFail($id);

        if (!$this->hasPermission()) {
            return response()->json(["success" => false, "message" => "User don't have permission to assign sub task"]);
        }

        
    }
}
