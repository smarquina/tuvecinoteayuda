<?php

namespace App\Notifications;

use App\Models\User\User;
use App\Models\User\UserType;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmailNotification extends VerifyEmail {
    use Queueable;

    /**
     * Get the mail representation of the notification.
     *
     * @param User $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable) {
        $verificationUrl = $this->verificationUrl($notifiable);

        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $verificationUrl);
        }

        $profileURL = config('app.url_front');

        $message = (new MailMessage)
            ->subject(trans('mail.auth.newUser.subject'))
            ->greeting(trans('mail.common.welcome', ['user' => $notifiable->name]));

        switch ($notifiable->user_type_id) {
            case UserType::USER_TYPE_VOLUNTEER:
                $message = $message->line(trans('mail.auth.newUser.body_volunteer', compact('profileURL')));
                break;
            case UserType::USER_TYPE_REQUESTER:
                $message = $message->line(trans('mail.auth.newUser.body_requester', compact('profileURL')));
                break;
            case UserType::USER_TYPE_ASSOCIATION:
                $message = $message->line(trans('mail.auth.newUser.body_association', compact('profileURL')));
                break;
        }
        return $message->action(trans('mail.auth.newUser.act_btn'), $verificationUrl);
    }
}
