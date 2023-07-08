<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\SubTask;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function store(CommentRequest $request, $slug, $taskId) {
        $task = SubTask::where("id", $taskId)->first();
        
    }
}
