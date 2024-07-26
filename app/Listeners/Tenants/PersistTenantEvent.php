<?php

namespace App\Listeners\Tenants;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use App\Events\NewUserAdded;

class PersistTenantEvent
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
        DB::table('notifications')->insert([
            'description' => 'The user '.$event->user->name.' has been registered.',
            'level' => "1",
            'scope' => "1",
            'type' => "user",
            'title' => "New user registered",
            'viewed' => "",
            'direction' => "",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        //$event->user->scopes->roles->role
    }
}
