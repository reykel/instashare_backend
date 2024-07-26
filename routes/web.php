<?php

use Illuminate\Support\Facades\Route;

Route::get('{any}', function () {
    return redirect(config('app.url'));
})->where('any', '.*');
