<?php

namespace App\Http\Revokers;

use App\Http\Interfaces\Revoker;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PassportRevoker implements Revoker
{
    private User $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function revokeOnlyCurrentToken()
    {
        $this->user->token()->revoke();
    }

    public function revokeAllTokens()
    {
        DB::table('oauth_access_tokens')
            ->where('user_id', $this->user->id)
            ->update([
                'revoked' => true
            ]);
    }

    public function deleteCurrentToken()
    {
        return $this->user->token()->delete();
    }

    public function deleteAllTokens()
    {
        $this->user->tokens->each(function ($token, $key) {
            $token->delete();
        });
    }
}
