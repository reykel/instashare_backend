<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

trait HasToAvoidCacheLeaking {

    public function clearListingCache() { 
        Cache::forget('productos');
        Cache::forget('categorias');
        Cache::forget('empresas');
        Cache::forget('contratos');
        Cache::forget('ejecutores');
        Cache::forget('ofertas');
        Cache::forget('partidas');
    }
}