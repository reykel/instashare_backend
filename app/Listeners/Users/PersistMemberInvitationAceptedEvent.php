<?php

namespace App\Listeners\Users;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use App\Events\MemberInvitationAcepted;

class PersistMemberInvitationAceptedEvent
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
    public function handle(MemberInvitationAcepted $event)
    {
        DB::table('notifications')->insert([
            'description' => 'The member '.$event->user->name.' has acepted the invitation made.',
            'level' => "2",
            'scope' => $event->user->organization_id,
            'type' => "user",
            'title' => "Member Invitation Acepted",
            'viewed' => "",
            'direction' => "",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        //$event->user->scopes->roles->role
    }
}
