<?php

namespace App\Events;

use App\Models\HelpRequest\HelpRequest;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AcceptedHelpRequest
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var HelpRequest $helpRequest */
    public $helpRequest;

    /**
     * Create a new event instance.
     *
     * @param HelpRequest $helpRequest
     */
    public function __construct(HelpRequest $helpRequest) {
        $this->helpRequest = $helpRequest;
    }
}
