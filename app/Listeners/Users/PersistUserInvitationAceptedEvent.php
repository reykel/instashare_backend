<?php

namespace App\Listeners\Users;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use App\Events\UserInvitationAcepted;

class PersistUserInvitationAceptedEvent
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
        DB::table('notifications')->insert([
            'description' => 'The user '.$event->user->name.' has acepted the invitation made.',
            'level' => "1",
            'scope' => "1",
            'type' => "user",
            'title' => "User Invitation Acepted",
            'viewed' => "",
            'direction' => "",
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
