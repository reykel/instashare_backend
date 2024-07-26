<?php

namespace App\Listeners\Users;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use App\Events\MemberEmailVerified;

class PersistMemberEmailVerifiedEvent
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
    public function handle(MemberEmailVerified $event)
    {
        DB::table('notifications')->insert([
            'description' => 'Your email '.$event->user->email.' has been verified.',
            'level' => "2",
            'scope' => $event->user->organization_id,
            'type' => "user",
            'title' => "Email Verified",
            'viewed' => "",
            'direction' => "",
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
