<?php

namespace App\Http\Controllers\ApiAuthentication;

use App\Traits\HasToManageUsers;
use Exception;
use App\Http\Requests\ApiAuthentication\RevokeUserRequest;

class RevokeUserController
{
    use HasToManageUsers;

    public function __invoke(RevokeUserRequest $request)
    {
        try {
            $this->revokeUserAccount($request->get('id'), $request->get('int_value'));

            return response([
                'message' => "User have been revoked",
            ], 200);

        } catch (Exception $exception) {

            return response()->json([
                'message' => $exception->getMessage()
            ], 400);

        }
    }
}

