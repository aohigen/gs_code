<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

//Laravel Echo追加時に「implements ShouldBroadcast」を追記
class PublicEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        //Laravel Echo導入時に以下の初期値をコメントアウト
        // return new PrivateChannel('channel-name');

        //Laravel Echo追加時に以下を追記
        return new Channel('public-event');
    }

    //LaravelEcho実装時に以下を追加
    public function broadcastWith()
    {
        return [
            'message' => 'PUBLIC',
        ];
    }
}
