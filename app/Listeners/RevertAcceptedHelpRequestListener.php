<?php

namespace App\Listeners;

use App\Events\RevertAcceptedHelpRequest;
use App\Notifications\RevertAcceptedHelpRequestNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RevertAcceptedHelpRequestListener
{
    /**
     * Create the event listener.
     *
     * @param RevertAcceptedHelpRequest $event
     */
    public function __construct(RevertAcceptedHelpRequest $event)
    {
        $event->helpRequest->user->notify(new RevertAcceptedHelpRequestNotification($event->helpRequest));
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //
    }
}
