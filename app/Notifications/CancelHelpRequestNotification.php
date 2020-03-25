<?php

namespace App\Notifications;

use App\Models\HelpRequest\HelpRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CancelHelpRequestNotification extends Notification {
    use Queueable;

    /** @var HelpRequest $helpRequest */
    public $helpRequest;

    /**
     * Create a new notification instance.
     *
     * @return void
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
            ->subject(trans('mail.help_request.cancelled_requester.subject'))
            ->greeting(trans('mail.common.hi', []))
            ->line(trans('mail.help_request.cancelled_requester.body', [
                'profileURL'  => config('app.url_front'),
                'name'        => $notifiable->user->name,
                'description' => $notifiable->message,
            ]))
            ->action(trans('mail.help_request.cancelled_requester.act_btn'), config('app.url_front'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable) {
        return [
            //
        ];
    }
}
