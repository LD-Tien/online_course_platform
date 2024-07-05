<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Log;

class MyEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct($message)
    {
        $this->message = $message;
        Log::info('MyEvent constructed with message: ' . $message);
    }

    public function broadcastOn()
    {
        Log::info('Broadcasting on channel: my-channel');
        return ['my-channel'];
    }

    public function broadcastAs()
    {
        Log::info('Broadcasting as: my-event');
        return 'my-event';
    }
}
