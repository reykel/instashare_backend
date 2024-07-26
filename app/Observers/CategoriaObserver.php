<?php

namespace App\Observers;

use App\Models\Categoria;
use Illuminate\Support\Facades\Cache;

class CategoriaObserver
{
    /**
     * Handle the Categoria "created" event.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return void
     */
    public function created(Categoria $categoria)
    {
        Cache::forget('categorias');
    }

    /**
     * Handle the Categoria "updated" event.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return void
     */
    public function updated(Categoria $categoria)
    {
        Cache::forget('categorias');
    }

    /**
     * Handle the Categoria "deleted" event.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return void
     */
    public function deleted(Categoria $categoria)
    {
        Cache::forget('categorias');
    }

    /**
     * Handle the Categoria "restored" event.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return void
     */
    public function restored(Categoria $categoria)
    {
        Cache::forget('categorias');
    }

    /**
     * Handle the Categoria "force deleted" event.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return void
     */
    public function forceDeleted(Categoria $categoria)
    {
        Cache::forget('categorias');
    }
}
