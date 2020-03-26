<?php

namespace App\Listeners;

use App\Events\JoinedAssociation;
use App\Notifications\JoinedAssociationNotification;

class JoinedAssociationListener {
    /**
     * Create the event listener.
     *
     * @param JoinedAssociation $event
     */
    public function __construct(JoinedAssociation $event) {
        $event->association->notify(new JoinedAssociationNotification($event->association));
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
