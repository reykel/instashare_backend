<?php

namespace App\Listeners\Users;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use App\Events\UserEmailVerified;

class PersistUserEmailVerifiedEvent
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
        DB::table('notifications')->insert([
            'description' => 'The email '.$event->user->email.' has been verified.',
            'level' => "1",
            'scope' => "1",
            'type' => "user",
            'title' => "Email Verified",
            'viewed' => "",
            'direction' => "",
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
