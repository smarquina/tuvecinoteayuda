<?php

namespace App\Notifications;

use App\Models\HelpRequest\HelpRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Spatie\Url\Url;

class CancelHelpRequestNotification extends Notification {
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
        $url = Url::fromString(config('app.url_front'))->withPath(config('app.profile_url'));

        return (new MailMessage)
            ->subject(trans('mail.help_request.cancelled_requester.subject'))
            ->greeting(trans('mail.common.hi', []))
            ->line(trans('mail.help_request.cancelled_requester.body', [
                'profileURL'  => config('app.url_front'),
                'name'        => $this->helpRequest->user->name,
                'description' => $this->helpRequest->message,
            ]))
            ->action(trans('mail.help_request.cancelled_requester.act_btn'), $url);
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
