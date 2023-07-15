<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

    public function task_detail($slug, $board_id , $task_id)
    {
        $taskDetails = Task::with('assignTo', 'createdBy', 'taskList')->findOrFail($task_id);
        return view('content._partials._modals.modal-task-detail')
            ->with(compact("taskDetails", "slug", "board_id"));
    }
}
