<?php

namespace App\Listeners;

use App\Events\CancelHelpRequest;
use App\Models\User\User;
use App\Notifications\CancelHelpRequestNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CancelHelpRequestListener {

    /**
     * Create the event listener.
     *
     * @param CancelHelpRequest $event
     */
    public function __construct(CancelHelpRequest $event) {
        $event->helpRequest->assignedUser->each(function (User $user) use ($event) {
            $user->notify(new CancelHelpRequestNotification($event->helpRequest));
        });
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
