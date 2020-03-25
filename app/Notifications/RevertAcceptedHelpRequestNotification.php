<?php

namespace App\Notifications;

use App\Models\HelpRequest\HelpRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RevertAcceptedHelpRequestNotification extends Notification
{
    use Queueable;

    /** @var HelpRequest $helpRequest */
    public $helpRequest;

    /**
     * Create a new notification instance.
     *
     * @param HelpRequest $helpRequest
     */
    public function __construct(HelpRequest $helpRequest) {
        $this->helpRequest = $helpRequest;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable) {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param HelpRequest $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable) {
        return (new MailMessage)
            ->subject(trans('mail.help_request.cancelled_volunteer.subject'))
            ->greeting(trans('mail.common.hi_user', ['user' => $this->helpRequest->user->name]))
            ->line(trans('mail.help_request.cancelled_volunteer.body', [
                'profileURL'  => config('app.url_front'),
                'name'        => \Auth::user()->name,
                'description' => $this->helpRequest->message,
            ]))
            ->action(trans('mail.help_request.cancelled_volunteer.act_btn'), config('app.url_front'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
