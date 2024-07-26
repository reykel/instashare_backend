<?php

namespace App\Listeners\Users;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use App\Events\UserInvitationAcepted;

class UserEmailVerifiedEvent
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
        /*
        $user = DB::table('users')->where('id', $event->user->id)->first();
        $user->email_verified_at = now();
        $user->save();
        */

        DB::table('users')
        ->where('id', $event->user->id)
        ->update([
            'email_verified_at' => now()
        ]);
/*
        DB::table('users')->update([
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
*/
    }
}
