<?php

namespace App\Listeners\Users;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\UserEmailVerified;
use App\Mail\ManagerNotifications;
use Illuminate\Support\Facades\Mail;

class MailUserEmailVerifiedEvent
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserEmailVerified $event)
    {
        $_subject = 'Email verified';
        $_body = 'The email: '.$event->user->email.' registered by the user '.$event->user->name.' has been verified at '.$event->user->created_at.'.';
        $url = null;
        $name = null;
        $slot = null;
        $_footer = null;

        Mail::to(config('mail.from.address'))->send(
            new ManagerNotifications($_subject, $_body, $url, $name, $slot, $_footer)
        );
    }
}
