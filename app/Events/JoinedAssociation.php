<?php

namespace App\Events;

use App\Models\User\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class JoinedAssociation {

    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var User $association */
    public $association;

    /**
     * Create a new event instance.
     *
     * @param User $association
     */
    public function __construct(User $association) {
        $this->association = $association;
    }
}
