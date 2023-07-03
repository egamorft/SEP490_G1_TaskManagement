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
    public function task_list(TasksRequest $request, $slug, $taskId) {
        $task = Task::findOrFail($taskId)->first();
        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => "Task not found"
            ]);
        }

        $subTasks = DB::select("select * from SubTasks where task_id = :task_id", [
            "task_id" => $task->id
        ]);

        Session::flash("success", "Get data successfully");
        return response()->json([
            'success' => true,
            'data' => [
                "subTasks" => $subTasks
            ]
        ]);
    }

    public function create() {
        return view("layouts/tasks/sub.tasks/create");
    }

    public function store(TasksRequest $request) {
        $subTask = [
            "name" => $request->input("sub_task_name"),
            "image" => $request->file("images"),
            "description" => $request->input("sub_task_description"),
            "attachment" => $request->file("attachment"),
            "due_date" => $request->date("due_date"),
        ];

        SubTask::create($subTask);

        Session::flash('success', "Create Sub Task successfully!");
        return redirect()->route("layouts/tasks/sub.tasks");
        // return response()->json(['success' => true, "message" => "Task created"]);
    }

    public function edit() {
        return view("tasks/sub.tasks/edit");
    }

    public function update(TasksRequest $request, $id) {
        $subTask = SubTask::findOrFail($id);
        
        $subTask->name = $request->input("sub_task_name");
        $subTask->image = $request->file("image");
        $subTask->description = $request->input("sub_task_description");
        $subTask->attachment = $request->file("attachment");
        $subTask->due_date = $request->date("due_date");

        $subTask->save();

        Session::flash("success", "Successfully update sub task");
        return response()->json(["success" => true]);
    }

    public function delete($id) {
        $subTask = Task::findOrFail($id);
        
        $subTask->delete();

        Session::flash("success", "Successfully delete sub task");
        return response()->json(["success" => true, "message" => "Sub Task Deleted"]);
    }

    public function assign(TasksRequest $request, $id) {
        $task = Task::findOrFail($id);
        
    }
}
