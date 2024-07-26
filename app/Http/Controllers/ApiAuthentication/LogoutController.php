<?php

namespace App\Http\Controllers\ApiAuthentication;

use App\Http\Revokers\RevokerFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class LogoutController
{
    public function __invoke(Request $request): Response
    {
        (new RevokerFactory)->make()->{$this->applyRevokeStrategy()}();

        return response([
            'message' => __('api-authentication.logout'),
        ], 200);
    }

    public function applyRevokeStrategy(): string
    {
        $methods = [
            'revoke_only_current_token',
            'revoke_all_tokens',
            'delete_current_token',
            'delete_all_tokens',
        ];

        foreach ($methods as $method) {
            if(config('api-authentication.' . $method)) {
                return (string) Str::of($method)->camel();
            }
        }

        return (string) Str::of($methods[3])->camel();
    }
}
