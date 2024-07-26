<?php

namespace App\Http\Controllers\ApiAuthentication;

use App\Traits\HasToManageApiTokens;
use App\Traits\HasToRegisterOrganization;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ApiAuthentication\DeleteTokenRequest;

class DeleteTokenController
{
    use HasToRegisterOrganization, HasToManageApiTokens;

    public function __invoke(DeleteTokenRequest $request)
    {
        try {
            $this->deleteToken($request->get('id'));

            return response([
                'message' => "Token have been deleted",
            ], 200);

        } catch (Exception $exception) {

            return response()->json([
                'message' => $exception->getMessage()
            ], 400);

        }
    }
}

