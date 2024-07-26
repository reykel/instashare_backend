<?php

namespace App\Listeners\Users;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use App\Events\OfertaAceptada;

class PersistOfferAceptedEvent
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
    public function handle(OfertaAceptada $event)
    {
        DB::table('notifications')->insert([
            'description' => 'La oferta comercial '.$event->oferta->id. ' ha sido aceptada por '.$event->oferta->short_contact_person,
            'level' => "2",
            'scope' => $event->oferta->organization_id,
            'type' => "user",
            'title' => "Offer accepted",
            'viewed' => "",
            'direction' => "",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        //'The user '.$event->user->name.' has been invited.',
    }
}
