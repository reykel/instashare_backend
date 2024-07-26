<?php

namespace App\Http\Interfaces;

interface Revoker
{
    public function revokeOnlyCurrentToken();

    public function revokeAllTokens();

    public function deleteCurrentToken();

    public function deleteAllTokens();
}
