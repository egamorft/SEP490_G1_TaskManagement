<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskList;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function get_taskList_task($board_id)
    {
        $taskLists = TaskList::where('board_id', $board_id)->get();
        $data = [];

        foreach ($taskLists as $taskList) {
            $tasks = Task::where('taskList_id', $taskList->id)->get();
            $taskItems = [];

            foreach ($tasks as $task) {
                $attachmentsCount = $task->attachments ? count($task->attachments) : 0;
                $flags = $this->checkDueDate($task->due_date);

                $taskItem = [
                    'id' => $task->id,
                    'title' => $task->title,
                    'comments' => '3', // replace with actual comments count
                    'badge-text' => $task->due_date, // replace with actual badge text
                    'badge' => $flags['badgeColor'],
                    'due-date' => $task->due_date, // replace with actual due date
                    'attachments' => $attachmentsCount, // replace with actual attachments count
                    'assigned' => $task->assign_to, // replace with actual assigned members
                    'members' => ['Bruce', 'Dianna'] // replace with actual members
                ];

                $taskItems[] = $taskItem;
            }

            $data[] = [
                'id' => $taskList->id,
                'title' => $taskList->title,
                'item' => $taskItems
            ];
        }

        return response()->json($data);
    }
    
    public function checkDueDate($dueDate)
    {
        $now = Carbon::now()->format('Y-m-d');
        $daysDifference = Carbon::parse($now)->diffInDays(Carbon::parse($dueDate), false);
        $onGoingDue = false;
        $warningDue = false;
        $overDue = false;

        if ($daysDifference > 0) {
            // Due date is in the future
            if ($daysDifference == 1) {
                $warningDue = true;
            } elseif ($daysDifference > 1) {
                $onGoingDue = true;
            }
        } elseif ($daysDifference == 0) {
            // Due date is today
            $warningDue = true;
        } else {
            // Due date is in the past
            $overDue = true;
        }

        $badgeColor = $onGoingDue ? 'success' : ($warningDue ? 'warning' : ($overDue ? 'danger' : ''));
        return compact('onGoingDue', 'warningDue', 'overDue', 'badgeColor');
    }
}
