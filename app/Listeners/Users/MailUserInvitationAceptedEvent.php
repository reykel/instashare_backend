<?php

namespace App\Listeners\Users;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\UserInvitationAcepted;
use App\Mail\ManagerNotifications;
use Illuminate\Support\Facades\Mail;

class MailUserInvitationAceptedEvent
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
    public function handle(UserInvitationAcepted $event)
    {
        $_subject = 'User Invitation Acepted';
        $_body = 'The user '.$event->user->name.' with the email: '.$event->user->email.' has acepted the invitation at '.$event->user->created_at.'.';
        $url = null;
        $name = null;
        $slot = null;
        $_footer = null;

        Mail::to(config('mail.from.address'))->send(
            new ManagerNotifications($_subject, $_body, $url, $name, $slot, $_footer)
        );
    }
}
