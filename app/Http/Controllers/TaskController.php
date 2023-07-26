<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddTaskRequest;
use App\Models\Comment;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
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

        $memberAccount = Project::findOrFail($project->id)
            ->findAccountWithRoleNameAndStatus('member', 1)
            ->get();
        $taskDetails = Task::with('assignTo', 'createdBy', 'taskList')->findOrFail($task_id);

        $comments = Comment::with('createdBy')->where('task_id', $taskDetails->id)->get();

        return view('content._partials._modals.modal-task-detail')
            ->with(compact(
                "taskDetails",
                "slug",
                "board_id",
                "memberAccount",
                "project",
                "comments"
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

        $task = Task::create([
            'taskList_id' => $taskList_id,
            'title' => $taskTitle,
            'start_date' => $start_date,
            'due_date' => $end_date,
            'created_by' => Auth::id(),
            'assign_to' => $taskAssignee,
            'status' => 1,
            'prev_tasks' => json_encode($previousTask),
            'description' => $description,
        ]);
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

        $task = Task::create([
            'taskList_id' => $taskList_id,
            'title' => $taskTitle,
            'start_date' => $start_date,
            'due_date' => $end_date,
            'created_by' => Auth::id(),
            'assign_to' => $taskAssignee,
            'status' => 1,
            'prev_tasks' => json_encode($previousTask),
            'description' => $description,
        ]);
        Session::flash('success', 'Create successfully task ' . $task->title);
        // Return a response indicating the success of the operation
        return response()->json(['success' => true]);
    }

    public function commentTask(Request $request)
    {
        $comment = Comment::create([
            'task_id' => $request->input("id"),
            'content' => $request->input("content"),
            'created_by' => Auth::id(),
        ]);

        if ($comment) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    public function uploadFiles(Request $request)
    {
        // Get the uploaded file(s)
        $files = $request->file('files');

        // Store each file in the storage
        $newUrls = [];
        foreach ($files as $file) {
            $filename = $file->getClientOriginalName();
            $customFilename = 'attachment_' . time() . '_' . $filename;
            $path = $file->storeAs('public/tasks/attachments', $customFilename);
            $url = Storage::url($path);
            $newUrls[] = $url;
        }
        // Get the task record to update
        $task = Task::find($request->input('id'));

        // Retrieve the existing array of attachments
        $existingUrls = json_decode($task->attachments, true);

        if (!$existingUrls) {
            $existingUrls = [];
        }

        // Add the new URLs to the existing array
        $updatedUrls = array_merge($existingUrls, $newUrls);

        // Update the attachments column of the task record with the updated array
        $task->update(['attachments' => json_encode($updatedUrls)]);

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
            $path = $attachments[$key_expect];
            unset($attachments[$key_expect]);
            $fullpath = str_replace('/storage/', '', $path);
            if (Storage::disk('public')->exists($fullpath)) {
                Storage::disk('public')->delete($fullpath);
            }
            $attachments = array_values($attachments);
            $taskDetails->attachments = json_encode($attachments);
            $taskDetails->save();
            return response()->json(['success' => true]);
        } else {

            return response()->json(['error' => true, 'message' => 'Something went wrong, try again later.'], 404);
        }
    }
}
