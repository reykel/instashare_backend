<?php

namespace App\Notifications\ApiAuthentication;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Lang;

class SetPasswordNotification extends ResetPassword
{
    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = $this->getNotificationEndpoint($notifiable);
        return (new MailMessage)
            ->subject(Lang::get('You have been invited'))
            ->line(Lang::get('You are receiving this email because you have been invited to be part of '.env('APP_NAME')))
            ->action(Lang::get('Set Your Password'), $url)
            ->line(Lang::get('This password setting link will expire in :count minutes.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]));
    }

    public function getNotificationEndpoint($notifiable)
    {
        if(! $endpoint = config('api-authentication.set_password_form_url')) {
            throw ValidationException::withMessages([
                'message' => 'There is no domain set for set_password_form_url. Please add a frontend endpoint in config file.'
            ]);
        }
        //return config('api-authentication.frontend_app_url') .'/set-password' . "/token={$this->token}/email={$notifiable->getEmailForPasswordReset()}";
        return $endpoint . "/token={$this->token}/email={$notifiable->getEmailForPasswordReset()}";

    }
}
