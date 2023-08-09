<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotiEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $title;
    public $sender;
    public $follower;
    public $desc;
    public $target_url;

    public function __construct($title, $sender, $follower, $desc, $target_url)
    {
        $this->title = $title;
        $this->sender = $sender;
        $this->follower = $follower;
        $this->desc = $desc;
        $this->target_url = $target_url;
    }

    public function broadcastOn()
    {
        return ['my-noti'];
    }

    public function broadcastAs()
    {
        return 'my-noti-event';
    }
}
