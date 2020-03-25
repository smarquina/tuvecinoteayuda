<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;

class SendEmailVerificationListener {

    /**
     * Handle the event.
     *
     * @param Registered $event
     * @return void
     */
    public function handleRegistered(Registered $event) {
        if (!$event->user->hasVerifiedEmail()) {
            $event->user->sendEmailVerificationNotification();
        }
    }
}
