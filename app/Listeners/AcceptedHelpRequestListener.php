<?php

namespace App\Listeners;

use App\Events\CancelHelpRequest;
use App\Models\User\User;
use App\Notifications\AcceptedRequesterHelpRequestNotification;
use App\Notifications\AcceptedVolunteerHelpRequestNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

/**
 * Class AcceptedHelpRequestListener
 * @package App\Listeners
 */
class AcceptedHelpRequestListener {

    /**
     * Create the event listener.
     *
     * @param CancelHelpRequest $event
     */
    public function __construct(CancelHelpRequest $event) {
        /** @var User $user */
        $user = \Auth::user();

        //Notification to volunteer that accepted
        $user->notify(new AcceptedVolunteerHelpRequestNotification($event->helpRequest));

        //Notification to requester that created help request
        $event->helpRequest->user->notify(new AcceptedRequesterHelpRequestNotification($event->helpRequest));
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event) {
        //
    }
}
