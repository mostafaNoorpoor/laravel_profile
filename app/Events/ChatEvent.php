<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ChatEvent implements ShouldBroadcast
{

    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public $userId ;

    public function __construct($message , $userId)
    {

        $this->message = $message;

        $this->userId = $userId;
    }

    public function broadcastOn()
    {

        //return new PrivateChannel('chatChannel' . $this->userId);
        return new Channel('chat.' . $this->userId);

    }

    public function broadcastAs()
    {

        return 'new.message';

    }

    public function broadcastWith()
    {

        return ['message' => $this->message];

    }

}
