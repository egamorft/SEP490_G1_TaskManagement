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
            ->whereNull('deleted_at')->whereHas('taskList.board.project', function ($query) use ($id) {
                $query->where('id', $id);
            })->get();

        $linksData = $this->getTaskDependencies($tasks);

        $project = Project::findOrFail($id);

        // Create the first data item manually
        $startProject = new DateTime($project->start_date);
        $endProject = new DateTime($project->end_date);
        $projectData = [
            'id' => $project->id + 9999,
            'text' => $project->name,
            'readonly' => true,
            'start_date' => \Carbon\Carbon::parse($project->start_date)->format('Y-m-d H:i:s'),
            'duration' => 0,
            'open' => true
        ];
        $tasksData[] = $projectData;
        // dd($tasksData);

        foreach ($tasks as $task) {
            $startTask = new DateTime($task->start_date);
            $endTask = new DateTime($task->due_date);
            $data = [
                'id' => $task->id,
                'text' => $task->title,
                'start_date' => \Carbon\Carbon::parse($task->start_date)->format('Y-m-d H:i:s'),
                'duration' => $startTask->diff($endTask)->days + 1,
                'parent' => $project->id + 9999,
                'progress' => 1,
                'status' => $task->status
            ];
            $tasksData[] = $data;
        }

        // dd($tasksData);

        return response()->json([
            "data" => $tasksData,
            "links" => $linksData
        ]);
    }

    public function getTaskDependencies($tasks)
    {
        $dependencies = [];

        // Loop through each task and its dependencies
        $index = 1;
        foreach ($tasks as $currentTask) {
            $prevTasks = json_decode($currentTask->prev_tasks);

            // Check if $prevTasks is not null and is an array or object
            if (!is_null($prevTasks) && (is_array($prevTasks) || is_object($prevTasks))) {
                foreach ($prevTasks as $prevTaskId) {
                    $prevTask = $tasks->where('id', $prevTaskId)->first();
                    $dependencies[] = [
                        'id' => (string) $index,
                        'source' => (string) $prevTask->id,
                        'target' => (string) $currentTask->id,
                        'type' => '0'
                    ];
                    $index++;
                    // // Recursively add the dependencies of the previous task
                    // $prevTaskDependencies = $this->getTaskDependencies($tasks);
                    // $dependencies = array_merge($dependencies, $prevTaskDependencies);
                }
            }
        }

        return $dependencies;
    }
}
