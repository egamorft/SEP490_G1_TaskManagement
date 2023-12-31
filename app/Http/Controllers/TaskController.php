<?php

namespace App\Http\Controllers;

use App\Enums\TaskStatus;
use App\Http\Requests\AddTaskRequest;
use App\Models\Board;
use App\Models\Comment;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskList;
use App\Services\UploadServices;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class TaskController extends Controller
{
    private $uploadServices;
    private $notiController;

    public function __construct(NotiController $notiController)
    {
        $this->notiController = $notiController;
        $this->uploadServices = new UploadServices();
    }

    public $rowPerPage = 20;

    public function moveTaskToTaskList(Request $request)
    {
        $task_id = $request->input('task_id');
        $taskList_id = $request->input('taskList_id');
        $parts = explode('_', $taskList_id);
        $taskListId = end($parts);
        $task = Task::findOrFail($task_id);
        $task->taskList_id = $taskListId;
        $task->save();

        return response()->json(['success' => true, 'message' => 'Success move ' . $task->title]);
    }

    public function addTaskList(Request $request)
    {
        $title = $request->input('title');
        $board_id = $request->input('board_id');

        $taskList = TaskList::create([
            'title' => $title,
            'board_id' => $board_id
        ]);

        Session::flash('success', 'Success create new task list ');
        return response()->json(['success' => true, 'id' => $taskList->id]);
    }

    public function editTitleTaskList(Request $request)
    {
        $newTitle = $request->input('newTitle');
        $taskListDataId = $request->input('taskListDataId');
        $parts = explode('_', $taskListDataId);
        $taskListId = end($parts);

        $task = TaskList::findOrFail($taskListId);
        $task->title = $newTitle;
        $task->save();

        return response()->json(['success' => true, 'message' => 'Success change task list name']);
    }

    public function addTaskKanban(Request $request)
    {
        $task_title = $request->input('task_title');
        $taskListDataId = $request->input('taskListDataId');
        $parts = explode('_', $taskListDataId);
        $taskListId = end($parts);
        //Pending update task columns
        $task = Task::create([
            'title' => $task_title,
            'created_by' => Auth::id(),
            'taskList_id' => $taskListId
        ]);

        return response()->json(['success' => true, 'id' => $task->id, 'message' => 'Success create new task']);
    }

    public function task_detail($slug, $board_id, $task_id)
    {
        $project = Project::where('slug', $slug)->first();

        $current_role = $project->userCurrentRole();

        $memberAccount = Project::findOrFail($project->id)
            ->findAccountWithRoleNameAndStatus('member', 1)
            ->get();

        $allAccInProject = Project::findOrFail($project->id)
            ->findAccountInProjectWithStatus(1)
            ->get();

        $taskLists = TaskList::where('board_id', $board_id)->get();
        $taskListIds = $taskLists->pluck('id')->toArray();
        $tasksInBoard = Task::whereIn('taskList_id', $taskListIds)->get();

        $taskDetails = Task::with('assignTo', 'createdBy', 'taskList')->findOrFail($task_id);

        $comments = Comment::with('createdBy')->where('task_id', $taskDetails->id)->get();

        //Pending check all Task xem có task nào mà prev_task là $details->id không
        if ($taskDetails->start_date && $taskDetails->due_date) {
            $afterTasksDate = [];
            $allTasksAfter = Task::all();
            foreach ($allTasksAfter as $allTask) {
                if ($allTask->prev_tasks) {
                    if (in_array($taskDetails->id, json_decode($allTask->prev_tasks))) {
                        //Current task have after task
                        $afterTasksDate[] = $allTask->start_date;
                    }
                }
            }

            $prev_task = $taskDetails->prev_tasks;

            if (empty($afterTasksDate)) {
                if ($prev_task && !empty(json_decode($prev_task))) {
                    $tasksInPrev = Task::find(json_decode($prev_task));
                    $prev_end = $tasksInPrev->pluck('due_date')->toArray();
                    $avaiableStart = date('Y-m-d', strtotime(max($prev_end) . ' +1 day'));
                    $avaiableEnd = $project->end_date;
                } else {
                    $avaiableStart = $project->start_date;
                    $avaiableEnd = $project->end_date;
                }
            } else {
                if ($prev_task) {
                    $tasksInPrev = Task::find(json_decode($prev_task));
                    $prev_end = $tasksInPrev->pluck('due_date')->toArray();
                    $avaiableStart = date('Y-m-d', strtotime(max($prev_end) . ' +1 day'));
                    $avaiableEnd = min($afterTasksDate);
                } else {
                    $avaiableStart = $project->start_date;
                    $avaiableEnd = min($afterTasksDate);
                }
            }
        } else {
            $avaiableStart = $project->start_date;
            $avaiableEnd = $project->end_date;
        }


        return view('content._partials._modals.modal-task-detail')
            ->with(compact(
                "taskDetails",
                "slug",
                "board_id",
                "memberAccount",
                "project",
                "comments",
                "allAccInProject",
                "tasksInBoard",
                "current_role",
                "avaiableStart",
                "avaiableEnd"
            ));
    }

    public function view_task($slug, $task_id)
    {
        $project = Project::where('slug', $slug)->first();

        $memberAccount = Project::findOrFail($project->id)
            ->findAccountWithRoleNameAndStatus('member', 1)
            ->get();
        $taskDetails = Task::with('assignTo', 'createdBy', 'taskList')->findOrFail(1);
        $board_id = 1;
        return view('content._partials._modals.modal-task-detail')
            ->with(compact(
                "taskDetails",
                "slug",
                "board_id",
                "memberAccount",
                "project"
            ));
    }

    public function view_task_list($slug, $taskList_id)
    {
        $project = Project::where('slug', $slug)->first();

        $memberAccount = Project::findOrFail($project->id)
            ->findAccountWithRoleNameAndStatus('member', 1)
            ->get();

        $tasks = Task::with('assignTo', 'createdBy', 'taskList')->where('taskList_id', $taskList_id)->get();

        $taskLists = TaskList::findOrFail($taskList_id);

        return view('content._partials._modals.modal-taskList-confirmation')
            ->with(compact(
                "tasks",
                "memberAccount",
                "project",
                "taskLists"
            ));
    }

    public function moveTaskCalendar(Request $request)
    {
        $task_id = $request->input('task_id');
        $days_diff = $request->input('days_diff');
        $task = Task::findOrFail($task_id);

        $start_date = Carbon::parse($task->start_date);
        $due_date = Carbon::parse($task->due_date);

        if ($days_diff >= 0) {
            $new_start_date = $start_date->addDays($days_diff);
            $new_due_date = $due_date->addDays($days_diff);
        } else {
            $new_start_date = $start_date->subDays(abs($days_diff));
            $new_due_date = $due_date->subDays(abs($days_diff));
        }

        $task->start_date = $new_start_date;
        $task->due_date = $new_due_date;
        $task->save();

        return response()->json(['success' => true, 'message' => 'Success move task ' . $task->title]);
    }

    public function add_task_calendar_modal(AddTaskRequest $request)
    {
        // dd($request->all());
        $dates = [];
        $duration = $request->input('modalAddTaskDuration');
        if (preg_match('/^\d{4}-\d{2}-\d{2}\s+to\s+\d{4}-\d{2}-\d{2}$/', $duration)) {
            $dates = $this->extractDatesFromDuration($duration);
        }
        // Check if the input matches the pattern "YYYY-MM-DD"
        else if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $duration)) {
            $dates = [
                'start_date' => $duration,
                'end_date' => $duration,
            ];
        } else {
            return response()->json(['error' => true, 'message' => 'Something went wrong']);
        }

        $start_date = $dates['start_date'];
        $end_date = $dates['end_date'];

        $endDateCarbon = Carbon::createFromFormat('Y-m-d', $end_date)->startOfDay();
        // Get the current date as a Carbon instance
        $now = Carbon::now()->startOfDay()->format('Y-m-d');
        // dd($endDateCarbon, $now);
        // Check if the end date is smaller than or equal to the current date
        if ($endDateCarbon->lt($now)) {
            // Return an error response with a 422 Unprocessable Entity status code
            return response()->json([
                'errors' => [
                    'modalAddTaskDuration' => [
                        'The end date must be later than the current date.'
                    ]
                ]
            ], 422);
        }

        $taskList_id = $request->input('modalAddTaskList');
        $taskTitle = $request->input('modalAddTaskTitle');
        $taskAssignee = $request->input('modalAddTaskAssignee');
        $previousTask = $request->input('modalAddPreviousTask');
        $description = $request->input('description');

        $dataTask = [
            'taskList_id' => $taskList_id,
            'title' => $taskTitle,
            'start_date' => $start_date,
            'due_date' => $end_date,
            'created_by' => Auth::id(),
            'assign_to' => $taskAssignee,
            'status' => TaskStatus::DOING,
            'description' => $description,
        ];

        if ($previousTask) {
            $dataTask['prev_tasks'] = json_encode($previousTask);
        }


        $task = Task::create($dataTask);
        Session::flash('success', 'Create successfully task ' . $task->title);
        // Return a response indicating the success of the operation
        return response()->json(['success' => true]);
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

    public function add_task_in_list_modal(Request $request, $slug, $board_id)
    {
        $dates = [];
        $duration = $request->input('modalAddTaskDuration');
        if (preg_match('/^\d{4}-\d{2}-\d{2}\s+to\s+\d{4}-\d{2}-\d{2}$/', $duration)) {
            $dates = $this->extractDatesFromDuration($duration);
        }
        // Check if the input matches the pattern "YYYY-MM-DD"
        else if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $duration)) {
            $dates = [
                'start_date' => $duration,
                'end_date' => $duration,
            ];
        } else {
            return response()->json(['error' => true, 'message' => 'Something went wrong']);
        }


        $start_date = $dates['start_date'];
        $end_date = $dates['end_date'];

        $endDateCarbon = Carbon::createFromFormat('Y-m-d', $end_date)->startOfDay();
        // Get the current date as a Carbon instance
        $now = Carbon::now()->startOfDay()->format('Y-m-d');
        // dd($endDateCarbon, $now);
        // Check if the end date is smaller than or equal to the current date
        if ($endDateCarbon->lt($now)) {
            // Return an error response with a 422 Unprocessable Entity status code
            return response()->json([
                'errors' => [
                    'modalAddTaskDuration' => [
                        'The end date must be later than the current date.'
                    ]
                ]
            ], 422);
        }

        $taskList_id = $request->input('modalAddTaskList');
        $taskTitle = $request->input('modalAddTaskTitle');
        $taskAssignee = $request->input('modalAddTaskAssignee');
        $previousTask = $request->input('modalAddPreviousTask');
        $description = $request->input('description');

        $dataTask = [
            'taskList_id' => $taskList_id,
            'title' => $taskTitle,
            'start_date' => $start_date,
            'due_date' => $end_date,
            'created_by' => Auth::id(),
            'assign_to' => $taskAssignee,
            'status' => TaskStatus::DOING,
            'description' => $description,
        ];

        if ($previousTask) {
            $dataTask["prev_tasks"] = json_encode($previousTask);
        }

        $task = Task::create($dataTask);
        Session::flash('success', 'Create successfully task ' . $task->title);
        // Return a response indicating the success of the operation
        return response()->json(['success' => true]);
    }

    public function commentTask(Request $request)
    {
        $task = Task::findOrFail($request->input("id"));
        $comment = Comment::create([
            'task_id' => $request->input("id"),
            'content' => $request->input("content"),
            'created_by' => Auth::id(),
        ]);

        if ($comment) {
            $this->notiController->createNotiContent("New comment", Auth::id(), $task->assign_to, Auth::user()->name . " have comment to your task. Check it out!", URL::previous());
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    public function uploadFiles(Request $request)
    {
        $allowedFormats = ['xlsx', 'docx', 'png', 'jpg', 'pptx', 'pdf'];
        $maxFileSize = 2 * 1024 * 1024; // 5 MB in bytes
        // Get the uploaded file(s)
        $files = $request->file('files');

        // Store each file in the storage
        $newUrls = [];
        foreach ($files as $file) {
            if (!in_array($file->getClientOriginalExtension(), $allowedFormats)) {
                return response()->json(['error' => true, 'message' => 'Wrong format'], 404);
            }
            if ($file->getSize() > $maxFileSize) {
                return response()->json(['error' => true, 'message' => 'Your file is over 2MB. Choose another ones'], 404);
            }
            // $filename = $file->getClientOriginalName();
            // $customFilename = 'attachment_' . time() . '_' . $filename;
            // $path = $file->storeAs('public/tasks/attachments', $customFilename);
            // $url = '/storage/app/' . $path;
            // $newUrls[] = $url;
            $url = $this->uploadServices->uploadFileToRemoteHost($file);
            $newUrls[] = $url;
        }
        // Get the task record to update
        $task = Task::find($request->input('id'));

        // Update the attachments column of the task record with the updated array
        $task->update(['attachments' => json_encode($newUrls)]);

        // Return the file URLs as a JSON response
        return response()->json(['success' => true]);
    }

    public function deleteFiles(Request $request)
    {
        $id = $request->input('id');
        $key_expect = $request->input('key');
        $taskDetails = Task::with('assignTo', 'createdBy', 'taskList')->findOrFail($id);

        // Decode the attachments array
        $attachments = json_decode($taskDetails->attachments, true);
        // If the key exists, delete the attachment at that key
        if (array_key_exists($key_expect, $attachments)) {
            unset($attachments[$key_expect]);
            
            $attachments = array_values($attachments);
            $taskDetails->attachments = json_encode($attachments);
            $taskDetails->save();
            return response()->json(['success' => true]);
        } else {

            return response()->json(['error' => true, 'message' => 'Something went wrong, try again later.'], 404);
        }
    }

    public function selectPrevTask(Request $request)
    {
        $prev_task_id = $request->input('prev_task_id');
        $task_id = $request->input('task_id');

        $taskDetails = Task::with('assignTo', 'createdBy', 'taskList')->findOrFail($task_id);

        // Convert the prev_tasks string to an array
        $prev_tasks_array = json_decode($taskDetails->prev_tasks);

        if (is_null($prev_tasks_array) || empty($prev_tasks_array)) {
            // Create a new array with the new task ID
            $prev_tasks_array = array($prev_task_id);
        } else {
            // Add the new task ID to the array
            array_push($prev_tasks_array, $prev_task_id);
        }
        // Encode the array back to a JSON string
        $prev_tasks_json = json_encode($prev_tasks_array);

        // Update the task's prev_tasks attribute in the database
        $taskDetails->prev_tasks = $prev_tasks_json;
        $taskDetails->save();

        return response()->json(['success' => true]);
    }

    public function unselectPrevTask(Request $request)
    {
        $prev_task_id = $request->input('prev_task_id');
        $task_id = $request->input('task_id');

        $taskDetails = Task::with('assignTo', 'createdBy', 'taskList')->findOrFail($task_id);

        // Convert the prev_tasks string to an array
        $prev_tasks_array = json_decode($taskDetails->prev_tasks);
        // Check if the array is null or empty
        if (count($prev_tasks_array) > 1) {
            // Remove the task ID from the array
            $prev_tasks_array = array_diff($prev_tasks_array, [$prev_task_id]);

            // Convert the associative array to an indexed array
            $prev_tasks_array = array_values($prev_tasks_array);

            // Encode the array back to a JSON string
            $prev_tasks_json = json_encode($prev_tasks_array);

            // Update the task's prev_tasks attribute in the database
            $taskDetails->prev_tasks = $prev_tasks_json;
            // dd($taskDetails->prev_tasks);
            $taskDetails->save();
            return response()->json(['success' => true]);
        } elseif (count($prev_tasks_array) == 1) {
            $taskDetails->prev_tasks = null;
            $taskDetails->save();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => true]);
        }
    }

    public function changeDesc(Request $request)
    {
        $description = $request->input('description');
        $task_id = $request->input('id');

        $taskDetails = Task::findOrFail($task_id);
        if ($taskDetails) {
            $taskDetails->description = $description;
            $taskDetails->save();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => true]);
        }
    }

    public function changeAssignee(Request $request)
    {
        $user_id = $request->input('user_id');
        $task_id = $request->input('task_id');

        $taskDetails = Task::findOrFail($task_id);
        if ($taskDetails) {
            if ($taskDetails->due_date) {
                $taskDetails->status = TaskStatus::DOING;
            }
            $taskDetails->assign_to = $user_id;
            $taskDetails->save();

            $this->notiController->createNotiContent(
                "New task",
                Auth::id(),
                $user_id,
                Auth::user()->name . " have assign you new task! Check it out",
                URL::previous()
            );

            $getNewTask = Task::with('assignTo')->findOrFail($task_id);
            return response()->json(['success' => true, 'name' => $getNewTask->assignTo->name, 'avatar' => $getNewTask->assignTo->avatar]);
        } else {
            return response()->json(['error' => true]);
        }
    }

    public function changeReviewer(Request $request)
    {
        $user_id = $request->input('user_id');
        $task_id = $request->input('task_id');

        $taskDetails = Task::findOrFail($task_id);
        if ($taskDetails) {
            $taskDetails->created_by = $user_id;
            $taskDetails->save();

            $this->notiController->createNotiContent(
                "New task you will be review",
                Auth::id(),
                $user_id,
                "New task need you to reviewing",
                URL::previous()
            );

            $getNewTask = Task::with('createdBy')->findOrFail($task_id);
            return response()->json(['success' => true, 'name' => $getNewTask->createdBy->name, 'avatar' => $getNewTask->createdBy->avatar]);
        } else {
            return response()->json(['error' => true]);
        }
    }

    public function changeDuration(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $task_id = $request->input('task_id');

        $taskDetails = Task::findOrFail($task_id);
        if ($taskDetails) {
            if ($taskDetails->assign_to) {
                $taskDetails->status = TaskStatus::DOING;
            }
            $taskDetails->start_date = $start_date;
            $taskDetails->due_date = $end_date;
            $taskDetails->save();

            //Set up noti
            //Assignee
            $this->notiController->createNotiContent(
                "Duration change",
                Auth::id(),
                $taskDetails->assign_to,
                $taskDetails->title . " have change duration! Check it now",
                URL::previous()
            );

            //Reviewer
            $this->notiController->createNotiContent(
                "Duration change",
                Auth::id(),
                $taskDetails->created_by,
                $taskDetails->title . " have change duration! Check it now",
                URL::previous()
            );

            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => true]);
        }
    }

    public function deleteTask(Request $request)
    {
        $task_id = $request->input('task_id');
        $slug = $request->input('slug');
        $board_id = $request->input('board_id');

        $taskDetails = Task::findOrFail($task_id);
        $taskDetails->deleted_at = now();
        $taskDetails->save();

        return response()->json(['success' => true, 'newRoute' => route('view.board.kanban', ["slug" => $slug, "board_id" => $board_id])]);
    }

    public function get_task_info(Request $request, $slug, $board_id)
    {
        $start = $request->get("start");
        $role = $request->get("role");

        $project = Project::where('slug', $slug)->first();
        $accounts = $project->accounts()->get();
        $disabledProject = $this->checkDisableProject($project);

        $pmAccount = Project::findOrFail($project->id)
            ->findAccountWithRoleNameAndStatus('pm', 1)
            ->first();

        $supervisorAccount = Project::findOrFail($project->id)
            ->findAccountWithRoleNameAndStatus('supervisor', 1)
            ->first();

        $memberAccount = Project::findOrFail($project->id)
            ->findAccountWithRoleNameAndStatus('member', 1)
            ->get();

        $board = Board::findOrFail($board_id);

        //Bind data for kanban
        $taskLists = TaskList::where('board_id', $board_id)->get();
        $taskListsId = [];
        $taskListsArray = [];
        foreach ($taskLists as $taskList) {
            $taskListsId[] = $taskList->id;
            $taskListsArray[$taskList->id] = $taskList;
        }

        $user = Auth::user();

        $tasksInProject = [];
        $tasksInProjectBuilder = Task::whereIn("taskList_id", $taskListsId);
        if ($role == 'creator') {
            $tasksInProjectBuilder = $tasksInProjectBuilder->where("created_by", $user->id);
        }

        if ($role == 'assignee') {
            $tasksInProjectBuilder = $tasksInProjectBuilder->where("assign_to", $user->id);
        }
        $tasksInProject = $tasksInProjectBuilder
            ->skip($start)
            ->take($this->rowPerPage)
            ->get();

        $html = "";

        foreach ($tasksInProject as $task) {
            $status = $task->status;
            $statusView = [
                'text' => '',
                'class' => '',
            ];
            switch ($status) {
                case 1:
                    $statusView = [
                        'text' => 'Doing',
                        'class' => 'badge-light-primary',
                    ];
                    break;

                case 2:
                    $statusView = [
                        'text' => 'Reviewing',
                        'class' => 'badge-light-warning',
                    ];
                    break;

                case 3:
                    $statusView = [
                        'text' => 'Done Ontime',
                        'class' => 'badge-light-success',
                    ];
                    break;

                case -1:
                    $statusView = [
                        'text' => 'Done Late',
                        'class' => 'badge-light-secondary',
                    ];
                    break;

                case 0:
                    $statusView = [
                        'text' => 'Todo',
                        'class' => 'badge-light-info',
                    ];
                    break;

                default:
                    $statusView = [
                        'text' => 'Todo',
                        'class' => 'badge-light-info',
                    ];
                    break;
            }
            if (($status == 0 || $status == 1) && strtotime($task->due_date) < time()) {
                $statusView = [
                    'text' => 'Overdue',
                    'class' => 'badge-light-danger',
                ];
            }

            $taskList = $taskLists[$task->taskList_id] ?? (object)[
                "title" => ""
            ];
            $account = null;
            foreach ($accounts as $acc) {
                $acc = (object) $acc;
                if ($acc->id == $task->assign_to) {
                    $account = $acc;
                }
            }
            $start++;
            $date = date('D, M d, Y', strtotime($task->due_date));
            $html .= `<tr data-id="{$task->id}">
                <td>{$start}</td>
                <td>
                    <a
                        href="{$_SERVER['REQUEST_URI']}?show=task&id={$task->id}">{$task->title}</a>
                </td>
                <td>
                    <span
                        class="badge rounded-pill {$statusView['class']}">{$statusView['text']}</span>
                </td>
                <td>
                    <span
                        class="badge rounded-pill {$statusView['class']}">{$date}</span>
                </td>
                <td>{$taskList->title}</td>
                <td>
                    {($account ?
                        '<a href="{{ route('view.project.member', ['slug' => $project->slug, 'user_id' => 0]) }}"
                            data-bs-toggle="tooltip" data-popup="tooltip-custom"
                            data-bs-placement="bottom" title="{{ $account->name }}"
                            class="avatar pull-up">
                            <img src="{{ asset('images/avatars/' . $account->avatar) }}" alt="Avatar"
                                width="33" height="33" />
                        </a>' : '<div>Not assign yet</div>')}
                </td>
            </tr>`;
        }
        $data['html'] = $html;

        return response()->json($data);
    }

    public function setTaskDone(Request $request)
    {
        $task_id = $request->input('task_id');

        $taskDetails = Task::findOrFail($task_id);
        $taskDetails->status = TaskStatus::REVIEWING;
        $taskDetails->save();

        //Set up noti
        $this->notiController->createNotiContent(
            "Need to review",
            Auth::id(),
            $taskDetails->created_by,
            $taskDetails->title . " need your review! Check it now",
            URL::previous()
        );

        return response()->json(['success' => true]);
    }

    public function setTaskFinish(Request $request)
    {
        $task_id = $request->input('task_id');

        $taskDetails = Task::findOrFail($task_id);
        // Get the current date and time
        $currentDate = Carbon::now();
        // Create a Carbon instance from the given string
        $dueDate = Carbon::createFromFormat('Y-m-d', $taskDetails->due_date);
        if ($currentDate->lt($dueDate)) {
            $taskDetails->status = TaskStatus::DONE;
        } else {
            $taskDetails->status = TaskStatus::DONELATE;
        }

        $taskDetails->save();

        //Set up noti
        $this->notiController->createNotiContent(
            "Your task has finished",
            Auth::id(),
            $taskDetails->assign_to,
            $taskDetails->title . " has finished",
            URL::previous()
        );

        return response()->json(['success' => true]);
    }

    public function rejectTask(Request $request)
    {
        $validatedData = $request->validate([
            'modalRejectAssignTo' => 'required',
            'modalRejectReason' => 'required',
            'task-id' => 'required'
        ]);

        $taskDetails = Task::findOrFail($validatedData['task-id']);
        if ($taskDetails) {
            Comment::create([
                'task_id' => $validatedData['task-id'],
                'content' => $validatedData['modalRejectReason'],
                'created_by' => Auth::id()
            ]);
            $taskDetails->assign_to = $validatedData['modalRejectAssignTo'];
            $taskDetails->status = TaskStatus::DOING;
            $taskDetails->save();

            Session::flash('success', 'You have reject the task');
            
            //Set up noti
            $this->notiController->createNotiContent(
                "Your task has been rejected",
                Auth::id(),
                $taskDetails->assign_to,
                $taskDetails->title . "needs to be redone! Check it now",
                URL::previous()
            );

            return response()->json(['success' => true]);
        }
        return response()->json(['error' => true], 500);
    }

    public function ganttStore(Request $request)
    {
        $project_id = $request->parent;
        $project = Project::findOrFail($project_id);
        // $taskListIds = $project->taskLists()->pluck('id')->toArray();
        $projectTaskList_ids = $project->taskLists->pluck('id')->toArray();

        $ganttTaskStartDate = Carbon::parse($request->start_date);
        $ganttTaskEndDate = Carbon::parse($request->end_date);

        $projectStartDate = Carbon::parse($project->start_date);
        $projectEndDate = Carbon::parse($project->end_date);

        if ($ganttTaskStartDate->lessThan($projectStartDate)) {
            //Before
            return response()->json([
                "action" => "error",
                'msg' => "Task's start date is sooner than project's start date. Try again!!"
            ]);
        }

        if ($ganttTaskEndDate->greaterThan($projectEndDate)) {
            //After
            return response()->json([
                "action" => "error",
                'msg' => "Task's end date is greater than project's end date. Try again!!"
            ]);
        }

        $task = Task::create([
            'taskList_id' => max($projectTaskList_ids),
            'title' => $request->text,
            'start_date' => date('Y-m-d', strtotime($request->start_date)),
            'due_date' => date('Y-m-d', strtotime($request->end_date . ' -1 day')),
            'created_by' => Auth::id(),
            'assign_to' => Auth::id(),
            'status' => TaskStatus::DOING,
            'attachments' => null,
            'prev_tasks' => null,
            'description' => null,
        ]);

        if (!$task) {
            return response()->json([
                "action" => "error",
                'msg' => "Something went wrong here"
            ]);
        }

        return response()->json([
            "action" => "inserted",
            'msg' => "Success create new task",
            "tid" => $task->id
        ]);
    }

    public function ganttUpdate($id, Request $request)
    {
        $project_id = $request->parent;
        $project = Project::findOrFail($project_id);

        $ganttTaskStartDate = Carbon::parse($request->start_date);
        $ganttTaskEndDate = Carbon::parse($request->end_date);

        $projectStartDate = Carbon::parse($project->start_date);
        $projectEndDate = Carbon::parse($project->end_date);

        if ($ganttTaskStartDate->lessThan($projectStartDate)) {
            //Before
            return response()->json([
                "action" => "error",
                'msg' => "Task's start date is sooner than project's start date. Try again!!"
            ]);
        }

        if ($ganttTaskEndDate->greaterThan($projectEndDate)) {
            //After
            return response()->json([
                "action" => "error",
                'msg' => "Task's end date is greater than project's end date. Try again!!"
            ]);
        }

        $task = Task::findOrFail($id);

        if (!$task) {
            return response()->json([
                "action" => "error",
                'msg' => "Something went wrong here"
            ]);
        }

        // $duration_add = $request->duration > 1 ? ' +' . $request->duration . ' days' : ' +' . $request->duration . ' day';

        $task->title = $request->text;
        $task->start_date = date('Y-m-d', strtotime($request->start_date));
        $task->due_date = date('Y-m-d', strtotime($ganttTaskEndDate->subDay()->format('Y-m-d')));
        $task->save();



        return response()->json([
            "action" => "updated",
            'msg' => "Success edit task"
        ]);
    }

    public function ganttDelete($id)
    {
        $task = Task::findOrFail($id);
        $task->deleted_at = now();
        $task->save();

        return response()->json([
            "action" => "deleted",
            'msg' => "Success delete task"
        ]);
    }

    public function linkStore(Request $request)
    {
        $source_id = $request->source;
        $target_id = $request->target;
        $source = Task::findOrFail($source_id);
        $target = Task::findOrFail($target_id);

        if ($source && $target) {
            $prev_tasks_array = json_decode($target->prev_tasks);

            if (is_null($prev_tasks_array) || empty($prev_tasks_array)) {
                // Create a new array with the new task ID
                $prev_tasks_array = array($source_id);
            } else {
                // Add the new task ID to the array
                array_push($prev_tasks_array, $source_id);
            }
            // Encode the array back to a JSON string
            $prev_tasks_json = json_encode($prev_tasks_array);

            // Update the task's prev_tasks attribute in the database
            $target->prev_tasks = $prev_tasks_json;
            $target->save();

            return response()->json([
                "action" => "inserted",
                'msg' => "Success create link between " . $source->title . " and " . $target->title
            ]);
        }
        return response()->json([
            "action" => "error",
            'msg' => "Something went wrong here"
        ]);
    }

    public function linkDelete($source_id, $target_id)
    {
        $source = Task::findOrFail($source_id);
        $target = Task::findOrFail($target_id);

        // Convert the prev_tasks string to an array
        $prev_tasks_array = json_decode($target->prev_tasks);
        // Check if the array is null or empty
        if (count($prev_tasks_array) > 1) {
            // Remove the task ID from the array
            $prev_tasks_array = array_diff($prev_tasks_array, [$source_id]);

            // Convert the associative array to an indexed array
            $prev_tasks_array = array_values($prev_tasks_array);

            // Encode the array back to a JSON string
            $prev_tasks_json = json_encode($prev_tasks_array);

            // Update the task's prev_tasks attribute in the database
            $target->prev_tasks = $prev_tasks_json;
            $target->save();

            return response()->json([
                "action" => "deleted",
                'msg' => "Success delete link from " . $source->title . " to " . $target->title
            ]);
        } elseif (count($prev_tasks_array) == 1) {
            $target->prev_tasks = null;
            $target->save();

            return response()->json([
                "action" => "deleted",
                'msg' => "Success delete link from " . $source->title . " to " . $target->title
            ]);
        }
        return response()->json([
            "action" => "error",
            'msg' => "Something went wrong here"
        ]);
    }

    public function changeTaskDesc(Request $request)
    {
        $task = Task::findOrFail($request->id);

        $task->description = $request->description;
        $task->save();

        if ($task) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
}
