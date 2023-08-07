<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotiController extends Controller
{
    //
    public function updateUnseenNoti()
    {
        $unseenCounter = Notification::where('follower', '=', Auth::id())->where('seen', 0)->count();
        return response()->json(['unseenCounter' => $unseenCounter]);
    }
}
