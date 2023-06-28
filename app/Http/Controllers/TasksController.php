<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function index($id) {
		$pageConfigs = ['pageHeader' => false];
        $task = Task::findOrFail($id);
        return view('tasks.index', ['pageConfigs' => $pageConfigs])->with(compact('task'));
	}
}
