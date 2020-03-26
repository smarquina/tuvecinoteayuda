<?php

namespace App\Notifications;

use App\Models\HelpRequest\HelpRequest;
use App\Models\User\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Spatie\Url\Url;

class JoinedAssociationNotification extends Notification {
    use Queueable;

    /** @var User $association */
    public $association;

    /**
     * Create a new notification instance.
     *
     * @param User $association
     */
    public function __construct(User $association) {
        $this->association = $association;
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
            ->subject(trans('mail.association.user_joined.subject'))
            ->greeting(trans('mail.common.hi_user', ['user' => \Auth::user()->name]))
            ->line(trans('mail.association.user_joined.body', [
                'profileURL'  => config('app.url_front'),
                'name'        => ucfirst(\Auth::user()->name),
                'association' => ucfirst($this->association->corporate_name),
            ]))
            ->action(trans('mail.association.user_joined.act_btn'), $url);
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
