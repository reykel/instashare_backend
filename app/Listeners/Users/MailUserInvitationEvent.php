<?php

namespace App\Listeners\Users;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\NewUserInvited;
use App\Mail\ManagerNotifications;
use Illuminate\Support\Facades\Mail;

class MailUserInvitationEvent
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
    public function handle(NewUserInvited $event)
    {
        $_subject = 'New User Invited';
        $_body = 'The user '.$event->user->name.' with the email: '.$event->user->email.' has been invited at '.$event->user->created_at.'.';
        $url = null;
        $name = null;
        $slot = null;
        $_footer = null;

        Mail::to(config('mail.from.address'))->send(
            new ManagerNotifications($_subject, $_body, $url, $name, $slot, $_footer)
        );
    }
}
