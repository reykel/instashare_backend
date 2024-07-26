<?php

namespace App\Listeners\Users;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\MemberInvitationAcepted;
use App\Mail\ManagerNotifications;
use Illuminate\Support\Facades\Mail;
use App\Traits\HasToRegisterOrganization;

class MailMemberInvitationAceptedEvent
{
    use HasToRegisterOrganization;
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
    public function handle(MemberInvitationAcepted $event)
    {
        $_tenant = $this->getOrganizationTenant($event->user->organization_id);

        $_subject = 'Member Invitation Acepted';
        $_body = 'The member '.$event->user->name.' with the email: '.$event->user->email.' has acepted the invitation at '.$event->user->created_at.'.';
        $url = null;
        $name = null;
        $slot = null;
        $_footer = null;

        Mail::to($_tenant->email)->send(
            new ManagerNotifications($_subject, $_body, $url, $name, $slot, $_footer)
        );
    }
}
