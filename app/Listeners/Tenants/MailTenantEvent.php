<?php

namespace App\Listeners\Tenants;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\NewUserAdded;
use App\Mail\ManagerNotifications;
use Illuminate\Support\Facades\Mail;

class MailTenantEvent
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
    public function handle(NewUserAdded $event)
    {
        $_subject = 'New User Registered';
        $_body = 'The user '.$event->user->name.' was registered with email: '.$event->user->email.' at '.$event->user->created_at.' running the role of '.$event->user->scopes->roles->role.'.';
        $url = null;
        $name = null;
        $slot = null;
        $_footer = null;

        Mail::to(config('mail.from.address'))->send(
            new ManagerNotifications($_subject, $_body, $url, $name, $slot, $_footer)
        );
    }
}
