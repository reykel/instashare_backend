<?php

namespace App\Http\Revokers;

use Illuminate\Support\Facades\Auth;

class RevokerFactory
{
    public function make()
    {
        return new PassportRevoker(Auth::user());
    }
}