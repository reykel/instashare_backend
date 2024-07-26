<?php

namespace App\Http\Controllers\ApiAuthentication;

use App\Traits\HasToManageApiTokens;
use App\Traits\HasToRegisterOrganization;
use Exception;
use Illuminate\Support\Facades\Auth;

class RevokeUserTokensController
{
    use HasToRegisterOrganization, HasToManageApiTokens;

    public function __invoke()
    {
        try {
            $this->revokeUserTokens(auth()->id());

            return response([
                'message' => "All user tokens have been revoked",
            ], 200);

        } catch (Exception $exception) {

            return response()->json([
                'message' => $exception->getMessage()
            ], 400);

        }
    }
}

