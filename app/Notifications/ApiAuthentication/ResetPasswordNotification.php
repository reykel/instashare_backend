<?php

namespace App\Notifications\ApiAuthentication;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Validation\ValidationException;

class ResetPasswordNotification extends ResetPassword
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
        return $this->buildMailMessage($url);
    }

    /**
     * Here the method guess your frontend endpoint to show a form to update the user password.
     * @param $notifiable
     * @return string
     * @throws ValidationException
     */
    public function getNotificationEndpoint($notifiable)
    {
        if(! $endpoint = config('api-authentication.new_password_form_url')) {
            throw ValidationException::withMessages([
                'message' => 'There is no domain set for new_password_form_url. Please add a frontend endpoint in config file.'
            ]);
        }
        return $endpoint . "/token={$this->token}/email={$notifiable->getEmailForPasswordReset()}";
    }
}
