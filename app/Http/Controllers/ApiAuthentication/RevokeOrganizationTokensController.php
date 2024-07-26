<?php

namespace App\Http\Controllers\ApiAuthentication;

use App\Traits\HasToManageApiTokens;
use App\Traits\HasToRegisterOrganization;
use App\Traits\HasToManageUsers;
use Exception;
use App\Http\Requests\ApiAuthentication\OrganizationTokensRequest;

class RevokeOrganizationTokensController
{
    use HasToRegisterOrganization, HasToManageApiTokens, HasToManageUsers;

    public function __invoke(OrganizationTokensRequest $request)
    {
        try {
            $this->revokeOrganizationTokens($request->get('id'), $request->get('_value'));
            $this->revokeOrganizationUsersAccount($request->get('id'), $request->get('_value'));
            $this->revokeOrganization($request->get('id'), $request->get('_value'));

            return response([
                'message' => "All tokens have been revoked",
            ], 200);

        } catch (Exception $exception) {

            return response()->json([
                'message' => $exception->getMessage()
            ], 400);

        }
    }
}

