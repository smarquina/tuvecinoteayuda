<?php
/**
 * Created for tuvecinoteayuda.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 24/03/2020
 * Time: 9:08
 */

namespace App\Notifications;


use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Spatie\Url\Url;

class SendResetPasswordNotification extends ResetPassword {
    /**
     * Build the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable) {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

        $url = static::$createUrlCallback
            ? call_user_func(static::$createUrlCallback, $notifiable, $this->token)
            : Url::fromString(config('app.url_front'))
                 ->withPath('password/reset')
                 ->withQueryParameter('token', $this->token)
                 ->withQueryParameter('email', $notifiable->getEmailForPasswordReset());

        return (new MailMessage)
            ->subject(__('mail.auth.resetPassword.subject'))
            ->greeting(trans('mail.common.hi'))
            ->line(__('mail.auth.resetPassword.body'))
            ->action(__('mail.auth.resetPassword.act_btn'), $url)
            ->line(__('mail.auth.resetPassword.expiration',
                      ['count' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')]));
    }
}
