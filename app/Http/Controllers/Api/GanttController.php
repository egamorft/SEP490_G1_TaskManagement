<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Task;
use DateTime;
use Illuminate\Http\Request;

class GanttController extends Controller
{
    public function get($id)
    {
        $tasksData = [];
        $tasks = Task::where('status', '<>', '0')
            ->whereNull('deleted_at')
            ->get();

        $project = Project::findOrFail($id);

        // Create the first data item manually
        $startProject = new DateTime($project->start_date);
        $endProject = new DateTime($project->end_date);
        $projectData = [
            'id' => 1,
            'text' => $project->name,
            'readonly' => true,
            'start_date' => $project->start_date,
            'duration' => $startProject->diff($endProject)->days + 1,
            'open' => true,
            'type' => 'project',
        ];
        $tasksData[] = $projectData;
        // dd($tasksData);

        $id = 2;
        foreach ($tasks as $key => $task) {
            $startTask = new DateTime($task->start_date);
            $endTask = new DateTime($task->due_date);
            $data = [
                'id' => $id,
                'text' => $task->title,
                'start_date' => $task->start_date,
                'duration' => $startTask->diff($endTask)->days + 1,
                'parent' => 1,
                'progress' => 1,
                'status' => $task->status
            ];
            $tasksData[] = $data;
            $id++;
        }

        return response()->json([
            "data" => $tasksData,
            // "links" => $links
        ]);
    }
}
