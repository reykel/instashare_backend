<?php

namespace App\Listeners\Users;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use App\Events\OfertaEnviada;

class PersistOfferSendedEvent
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
    public function handle(OfertaEnviada $event)
    {
        DB::table('notifications')->insert([
            'description' => 'La oferta comercial '.$event->oferta->id. ' ha sido enviada a '.$event->oferta->short_contact_person. ' al correo '.$event->oferta->mail,
            'level' => "2",
            'scope' => $event->oferta->organization_id,
            'type' => "user",
            'title' => "New offer sended",
            'viewed' => "",
            'direction' => "",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        //'The user '.$event->user->name.' has been invited.',
    }
}
