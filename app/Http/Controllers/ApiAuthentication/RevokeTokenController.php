<?php

namespace App\Http\Controllers\ApiAuthentication;

use App\Traits\HasToManageApiTokens;
use App\Traits\HasToRegisterOrganization;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ApiAuthentication\RevokeTokenRequest;

class RevokeTokenController
{
    use HasToRegisterOrganization, HasToManageApiTokens;

    public function __invoke(RevokeTokenRequest $request)
    {
        try {
            $this->revokeToken($request->get('id'), $request->get('int_value'));

            return response([
                'message' => "Token have been revoked",
            ], 200);

        } catch (Exception $exception) {

            return response()->json([
                'message' => $exception->getMessage()
            ], 400);

        }
    }
}

