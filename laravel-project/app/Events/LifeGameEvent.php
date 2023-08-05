<?php

namespace App\Events;

use App\Models\Game;
use App\Models\GameUser;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LifeGameEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $game;
    public $users;
    public $eventname;

    /**
     * Create a new event instance.
     *
     * @param  Game  $game
     * @param  iterable  $users
     * @return void
     */
    public function __construct(Game $game, iterable $users , string $eventname)
    {
        $this->game = $game;
        $this->users = $users;
        $this->eventname = $eventname;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('lifegame'.$this->game->game_id);
    }
}
