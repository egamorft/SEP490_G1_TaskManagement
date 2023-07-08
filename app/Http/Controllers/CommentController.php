<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\SubTask;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function store(CommentRequest $request, $slug, $taskId) {
        $task = SubTask::where("id", $taskId)->first();
        if (empty($request->input("commentContent"))) {
            return back();
        }

        $comment = [
            "sub_task_id" => $task->id,
            "content" => $request->input("commentContent"),
            "visible" => 1,
            "created_by" => Auth::user()->id
        ];

        Comment::create($comment);
        return back();
    }

    public function reply(CommentRequest $request, $slug, $parentId) {
        // $parentComment = Commenet
    }
}
