<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Partida;
use App\Observers\ProductoObserver;
use App\Observers\CategoriaObserver;
use App\Observers\PartidaObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Producto::observe(ProductoObserver::class); 
        Categoria::observe(CategoriaObserver::class); 
    }
}
