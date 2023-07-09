<?php

namespace App\Http\Controllers;

use App\Helpers\Commons;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubTaskRequest;
use App\Http\Requests\TasksRequest;
use App\Models\Account;
use App\Models\AccountProject;
use App\Models\Comment;
use App\Models\Project;
use App\Models\SubTask;
use App\Models\Task;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Nette\Utils\Json;

class SubTaskController extends Controller
{
    public function index($slug, $subTaskId) {
        $project = Project::where("slug", $slug)->first();
        $tasksQuery = Task::where("project_id", $project->id);
        $tasks = $tasksQuery->orderBy('id', 'desc')->get();
        $subTask = SubTask::where("id", $subTaskId)->first();
        $task = Task::where("id", $subTask->task_id)->first();
        $breadcrumbs = [['link' => "javascript:void(0)", 'name' => "Doing"]];

        $taskIds = $tasksQuery->addSelect("id")->get();
        $subTasksView = SubTask::whereIn("task_id", $taskIds)->orderBy("id", "desc")->get();
        $subTasksRelease = [];
        foreach ($tasks as $task) {
            if (isset($subTasksRelease[$task->id])) {
                continue;
            }
            $subTasksRelease[$task->id] = [];
        }

        foreach($subTasksView as $subTaskView) {
            if (!isset($subTasksRelease[$subTaskView->task_id])) {
                $subTask[$subTaskView->task_id] = [$subTaskView]; 
                continue;
            }
            array_push($subTasksRelease[$subTaskView->task_id], $subTaskView);
        }

        $commentsQuery = Comment::where("sub_task_id", $subTask->id)
            ->where("visible", 1)->where("parent_id", 0)
            ->orderBy("id", "desc");
        $replyCommentsQuery = Comment::where("sub_task_id", $subTask->id)
            ->where("visible", 1)->where("parent_id", "<>", 0)
            ->orderBy("id", "desc");

        $accountReplyId = $replyCommentsQuery->select("id")->distinct()->get();

		$pageConfigs = [
            'pageHeader' => true,
            'pageClass' => 'todo-application',
        ];

        $accountsProject = AccountProject::where('project_id', $project->id)->get();
        
        $accountIds = [];
        foreach($accountsProject as $accProj) {
            $accountIds[] = $accProj->account_id;
        }

        $assignee = Account::where("id", $subTask->assign_to)->first();
        $reviewer = Account::where("id", $subTask->review_by)->first();

        $accounts = Account::whereIn("id", $accountIds)->get();
        
        return view('task.index', ['breadcrumbs' => $breadcrumbs, 'pageConfigs' => $pageConfigs, 'page' => 'task-list'])
            ->with(compact(
                "subTask", 
                "tasks", 
                "project", 
                "task", 
                "accounts", 
                "subTasksRelease",
                "assignee",
                "reviewer"
            ));
    }

	public function filter(Request $request) {

        $subTasks = SubTask::where("name", $request->q)->get();
        return response()->json([
			'q' => $request->q,
			'role' => $request->role,
			'todo' => $request->todo,
			'doing' => $request->doing,
			'reviewing' => $request->reviewing,
			'ontime' => $request->ontime,
			'late' => $request->late,
			'overdue' => $request->overdue,

		]);
    }

    public function create(SubTaskRequest $request, $slug) {
        $project = Project::where("slug", $slug)->first();
        $dates = self::extractDatesFromDuration($request->input('duration'));
        $startDate = $dates['start_date'];
		$endDate = $dates['end_date'];
        if (strtotime($startDate) < strtotime($project->start_date)) {
            return response()->json([
                "success" => false,
                "message" => "Task start date must be greater than project start date"
            ], 404);
        }

        if (strtotime($endDate) > strtotime($project->end_date)) {
            return response()->json([
                "success" => false,
                "message" => "Task due date must be less than project end date"
            ], 404);
        }

        if (strtotime($startDate) < strtotime(Carbon::now())) {
            return response()->json([
                "success" => false,
                "message" => "Task due date must be greater than today"
            ], 404); 
        }

        $validateInput = self::validate_input($request);

        if ($validateInput["success"] != true) {
            return response()->json($validateInput, 404);
        }

        $files = Commons::uploadFile($request, "taskAttachments");
        if ($files) {
            $files = $files->getClientOriginalName();
        }
        
        $subTask = [
            "name" => $request->input("taskName"),
            "task_id" => $request->input("taskList"),
            "image" => $request->file("images") ? $request->file("images") : '',
            "description" => $request->input("taskDescription") ? $request->input("taskDescription") : '',
            "assign_to" => $request->input("taskAssignee"),
            "review_by" => $request->input("taskReviewer"),
            "created_by" => Auth::user()->id,
            "status" => SubTask::$STATUS_DOING,
            "attachment" => $files,
            "start_date" => $startDate,
            "due_date" => $endDate,
            "created_at" => Carbon::now()
        ];

        $subTaskCreated = SubTask::create($subTask);

        Session::flash('success', 'Create successfully task list ' . $subTaskCreated->name);
        return redirect(URL::previous());
    }

    public function update(SubTaskRequest $request, $slug, $id) {
        $project = Project::where("slug", $slug)->first();
        $dates = self::extractDatesFromDuration($request->input('duration'));
        $startDate = $dates['start_date'];
		$endDate = $dates['end_date'];
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        if (strtotime($startDate) < strtotime($project->start_date)) {
            return response()->json([
                "success" => false,
                "message" => "Task start date must be greater than project start date"
            ], 404);
        }

        if (strtotime($endDate) > strtotime($project->end_date)) {
            return response()->json([
                "success" => false,
                "message" => "Task due date must be less than project end date"
            ], 404);
        }

        if (strtotime("today", strtotime($startDate)) < time()) {
            return response()->json([
                "success" => false,
                "message" => "Task start date must be greater than today"
            ], 404); 
        }

        $validateInput = self::validate_input($request);

        if ($validateInput["success"] != true) {
            return response()->json($validateInput, 404);
        }

        $files = Commons::uploadFile($request, "taskAttachments");
        if ($files) {
            $files = $files->getClientOriginalName();
        }

        $subTask = SubTask::findOrFail($id);
        $subTask->name = $request->input("taskName");
        $subTask->image = $request->file("images");
        $subTask->description = $request->input("taskDescription");
        $subTask->assign_to = $request->input("taskAssignee");
        $subTask->review_by = $request->input("taskReviewer");
        $subTask->status = SubTask::$STATUS_DOING;
        $subTask->attachment = $files;
        $subTask->start_date = $startDate;
        $subTask->due_date = $endDate;
        $subTask->save();

        Session::flash("success", "Successfully update task " . $subTask->name);
        return redirect(URL::previous());
    }

    public function remove($slug, $id) {
        $subTask = SubTask::findOrFail($id);
        $stName = $subTask->name;
        $subTask->delete();

        Session::flash("success", "Successfully delete sub task " . $stName);
        return redirect("/project/" . $slug . "/task-list");
    }

    public function assign_assignee(Request $request, $slug) {
        $subTaskQuery = SubTask::findOrFail($request->input("task_id"));
        $subTask = $subTaskQuery->first();
        if ($subTask == null) {
            return response()->json(['message' => 'Cannot found task'], 404);
        }

        $accountId = $request->input("acc_id");
        $account = (object) [
            "id" => $accountId
        ];
        if ($accountId != 0) {
            $account = Account::where("id", $accountId)->first();
            if ($account == null) {
                return response()->json(['message' => 'Cannot found account'], 404);
            }
        }
        
        if ($subTask->status == SubTask::$STATUS_DONE_ONTIME || $subTask->status == SubTask::$STATUS_DONE_LATE) {
            return response()->json(['message' => "Cannot assign task has already done to another assignee"], 404);
        }

        if ($account->id == $subTask->review_by && $subTask->review_by != 0) {
            return response()->json(['message' => "Cannot assign task to another reviewer"], 404);
        }

        $subTaskQuery->assign_to = $accountId;
        if ($subTaskQuery->assign_to != 0 && $subTaskQuery->review_by != 0) {
            $subTaskQuery->status = SubTask::$STATUS_DOING;
        }
        $subTaskQuery->save();
        return back();
    }

    public function remove_assignee(Request $request, $slug, $id) {
        $subTaskQuery = SubTask::findOrFail($id);
        $subTask = $subTaskQuery->first();
        if ($subTask == null) {
            return response()->json(['message' => "Cannot found task"], 404);
        }

        $subTaskQuery->assign_to = SubTask::$DEFAULT_ASSIGNEE;
        if ($subTaskQuery->review_by == 0 || $subTaskQuery->assign_to == 0) {
            $subTaskQuery->status = SubTask::$STATUS_TODO;
        }
        $subTaskQuery->save();

        Session::flash("success", "Remove assignee successfully");
        return redirect(URL::previous());
    }

    public function assign_reviewer(Request $request, $slug) {
        $subTaskQuery = SubTask::findOrFail($request->input("task_id"));
        $subTask = $subTaskQuery->first();
        if ($subTask == null) {
            return response()->json(['message' => 'Cannot found task'], 404);
        }

        $accountId = $request->input("acc_id");
        $account = (object) [
            "id" => $accountId
        ];
        if ($accountId != 0) {
            $account = Account::where("id", $accountId)->first();
            if ($account == null) {
                return response()->json(['message' => 'Cannot found account'], 404);
            }
        }
        
        if ($subTask->status == SubTask::$STATUS_DONE_ONTIME || $subTask->status == SubTask::$STATUS_DONE_LATE) {
            return response()->json(['message' => "Cannot assign task has already done to another reviewer"], 404);
        }

        if ($account->id == $subTask->assign_to && $subTask->assign_to != 0) {
            return response()->json(['message' => "Cannot assign task to another assignee"], 404);
        }

        $subTaskQuery->review_by = $accountId;
        if ($subTaskQuery->assign_to != 0 && $subTaskQuery->review_by != 0) {
            $subTaskQuery->status = SubTask::$STATUS_DOING;
        }
        $subTaskQuery->save();
        return back();
    }

    public function remove_reviewer(Request $request, $slug, $id) {
        $subTaskQuery = SubTask::findOrFail($id);
        $subTask = $subTaskQuery->first();
        if ($subTask == null) {
            return response()->json(['message' => "Cannot found task"], 404);
        }

        $subTaskQuery->review_by = SubTask::$DEFAULT_ASSIGNEE;
        if ($subTaskQuery->review_by == 0 || $subTaskQuery->assign_to == 0) {
            $subTaskQuery->status = SubTask::$STATUS_TODO;
        }

        $subTaskQuery->save();

        Session::flash("success", "Remove reviewer successfully");
        return redirect(URL::previous());
    }

    public function change_status(Request $request) {
        $subTaskQuery = SubTask::findOrFail($request->input("task_id"));
        $subTask = $subTaskQuery->first();
        if ($subTask == null) {
            return response()->json(['message' => "Cannot found task"], 404);
        }

        $status = $request->input("status");
        if ($status == SubTask::$STATUS_DONE_ONTIME && strtotime($subTask->due_date) < time()) {
            $status = SubTask::$STATUS_DONE_LATE;
        }

        $subTaskQuery->status = $status;
        $subTaskQuery->save();

        Session::flash("succcess", "Update status successfully");
        return redirect(URL::previous());
    }

    private function validate_input($request) {
        $stTitle = $request->input("taskName");

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

        if (filter_var($stTaskListId, FILTER_VALIDATE_INT) === false) {
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

        if (filter_var($stAssignee, FILTER_VALIDATE_INT) === false) {
            return [
                "success" => false,
                "message" => "Please choose a valid assignee"
            ];
        }

        $stReviewBy = $request->input("taskReviewer");
        if (empty($stAssignee)) {
            return [
                "success" => false,
                "message" => "Reviewer cannot be empty"
            ];
        }

        if (filter_var($stReviewBy, FILTER_VALIDATE_INT) === false) {
            return [
                "success" => false,
                "message" => "Please choose a valid reviewer"
            ];
        }

        if ($stAssignee === $stReviewBy) {
            return [
                "success" => false,
                "message" => "Reviewer and Assignee cannot be the same account"
            ];
        }

        $duration = $request->input("duration");
        if (empty($duration)) {
            return [
                "success" => false,
                "message" => "Duration cannot be empty"
            ];
        }

        return [
            "success" => true,
            "message" => ""
        ];
    }
    
	public function extractDatesFromDuration($duration)
	{
		$startDate = '';
		$endDate = '';

		// Extract start date and end date
		if (strpos($duration, ' to ') !== false) {
			[$startDate, $endDate] = explode(' to ', $duration);
		}

		return [
			'start_date' => $startDate,
			'end_date' => $endDate,
		];
	}
}
