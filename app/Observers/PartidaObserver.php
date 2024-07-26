<?php

namespace App\Observers;

use App\Models\Partida;
use Illuminate\Support\Facades\Cache;

class PartidaObserver
{
    /**
     * Handle the Partida "created" event.
     *
     * @param  \App\Models\Partida  $partida
     * @return void
     */
    public function created(Partida $partida)
    {
        Cache::forget('partidas');
    }

    /**
     * Handle the Partida "updated" event.
     *
     * @param  \App\Models\Partida  $partida
     * @return void
     */
    public function updated(Partida $partida)
    {
        Cache::forget('partidas');
    }

    /**
     * Handle the Partida "deleted" event.
     *
     * @param  \App\Models\Partida  $partida
     * @return void
     */
    public function deleted(Partida $partida)
    {
        Cache::forget('partidas');
    }

    /**
     * Handle the Partida "restored" event.
     *
     * @param  \App\Models\Partida  $partida
     * @return void
     */
    public function restored(Partida $partida)
    {
        Cache::forget('partidas');
    }

    /**
     * Handle the Partida "force deleted" event.
     *
     * @param  \App\Models\Partida  $partida
     * @return void
     */
    public function forceDeleted(Partida $partida)
    {
        Cache::forget('partidas');
    }
}
