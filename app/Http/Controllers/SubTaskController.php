<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubTasksRequest;
use App\Http\Requests\TasksRequest;
use App\Models\Account;
use App\Models\AccountProject;
use App\Models\Project;
use App\Models\SubTask;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SubTaskController extends Controller
{
    public function index($slug, $subTaskId) {
        $project = Project::where("slug", $slug)->first();
        $tasksQuery = Task::where("project_id", $project->id);
        $tasks = $tasksQuery->get();
        $subTask = SubTask::where("id", $subTaskId)->first();
        $task = Task::where("id", $subTask->task_id)->first();
        $breadcrumbs = [['link' => "javascript:void(0)", 'name' => "Doing"]];

        $taskIds = $tasksQuery->addSelect("id")->get();
        $subTaskView = SubTask::whereIn("task_id", $taskIds)->get();
        $subTasksRelease = [];
        foreach ($tasks as $task) {
            if (isset($subTasksRelease[$task->id])) {
                continue;
            }
            $subTasksRelease[$task->id] = [];
        }

        foreach($subTaskView as $subTask) {
            if (!isset($subTasksRelease[$subTask->task_id])) {
                $subTask[$subTask->task_id] = [$subTask]; 
                continue;
            }
            array_push($subTasksRelease[$subTask->task_id], $subTask);
        }

		$pageConfigs = [
            'pageHeader' => true,
            'pageClass' => 'todo-application',
        ];

        $accountsProject = AccountProject::where('project_id', $project->id)->get();
        
        $accountIds = [];
        foreach($accountsProject as $accProj) {
            $accountIds[] = $accProj->account_id;
        }

        $accounts = Account::whereIn("id", $accountIds)->get();
        
        return view('task.index', ['breadcrumbs' => $breadcrumbs, 'pageConfigs' => $pageConfigs, 'page' => 'task-list'])->with(compact("subTask", "tasks", "project", "task", "accounts", "subTasksRelease"));
    }

    public function create(SubTasksRequest $request, $slug) {
        $dates = Project::extractDatesFromDuration($request->input('duration'));

        $project = Project::where("slug", $slug)->first();
        $validateInput = self::validate_input($request);
        
        if ($validateInput["success"] != true) {
            return response()->json($validateInput);
        }

        $subTask = [
            "name" => $request->input("taskTitle"),
            "task_id" => $request->input("taskList"),
            "image" => $request->file("images") || '',
            "description" => $request->input("taskDescription") || '',
            "assign_to" => $request->input("taskAssignee"), //SubTask::$DEFAULT_ASSIGNEE,
            "attachment" => $request->file("taskAttachments"),
            "due_date" => $request->date("taskDueDate"),
            "created_at" => Carbon::now()
        ];

        $subTaskCreated = SubTask::create($subTask);

        Session::flash('success', 'Create successfully task list ' . $subTaskCreated->name);
        return redirect("project/{$project->slug}/task-list");
    }

    public function update(TasksRequest $request, $id) {
        $subTask = SubTask::findOrFail($id)->first();
        $subTask->name = $request->input("taskTitle");
        $subTask->image = $request->file("images");
        $subTask->description = $request->input("taskDescription");
        $subTask->attachment = $request->file("taskAttachments");
        $subTask->due_date = $request->date("taskDueDate");

        $subTask->save();

        Session::flash("success", "Successfully update sub task");
        return response()->json(["success" => true]);
    }

    public function delete($id) {
        $subTask = SubTask::findOrFail($id)->first();
        if (!$subTask) {
            return response()->json([
                'success' => false,
                'message' => 'Subtask not found'
            ]);
        }

        $subTask->delete();

        Session::flash("success", "Successfully delete sub task");
        return response()->json(["success" => true, "message" => "Sub Task Deleted"]);
    }

    public function re_assign(TasksRequest $request, $id) {
        $subTask = Task::findOrFail($id)->first();
        
    }

    private function validate_input($request) {
        $stTitle = $request->input("taskTitle");

        if (empty($stTitle)) {
            return [
                "success" => false,
                "message" => "Title cannot be empty"
            ];
        }

        $stTaskListId = $request->input("taskList");
        if (empty($stTaskListId)) {
            return [
                "success" => false,
                "message" => "Task list Id cannot be empty"
            ];
        }

        if (!is_int($stTaskListId)) {
            return [
                "success" => false,
                "message" => "Task list Id must be a number"
            ];
        }

        $stAssignee = $request->input("taskAssignee");
        if (empty($stAssignee)) {
            return [
                "success" => false,
                "message" => "Assignee cannot be empty"
            ];
        }

        if (!is_int($stAssignee)) {
            return [
                "success" => false,
                "message" => "Please choose a valid assignee"
            ];
        }

        $stDueDate = $request->date("taskDueDate");
        if (empty($stDueDate)) {
            return [
                "success" => false,
                "message" => "Task due date cannot be empty"
            ];
        }

        return [
            "success" => true,
            "message" => ""
        ];
    }
}
