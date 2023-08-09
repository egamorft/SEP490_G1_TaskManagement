<?php

namespace App\Http\Controllers;

use App\Events\NotiEvent;
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

    public function createNotiContent($title, $sender, $follower, $desc, $target_url)
    {
        Notification::create([
            'title' => $title,
            'sender_id' => $sender,
            'follower' => $follower,
            'description' => $desc,
            'target_url' => $target_url,
            'created_at' => now()
        ]);
        
        event(new NotiEvent($title, $sender, $follower, $desc, $target_url));
    }

    public function seen($id){
        $noti = Notification::findOrFail($id);
        $noti->seen = 1;
        $noti->save();

        return response()->json(['success' => true]);
    }
}
