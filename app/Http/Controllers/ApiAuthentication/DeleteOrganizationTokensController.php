<?php

namespace App\Http\Controllers\ApiAuthentication;

use App\Traits\HasToManageApiTokens;
use App\Traits\HasToRegisterOrganization;
use Exception;
use App\Http\Requests\ApiAuthentication\OrganizationTokensRequest;

class DeleteOrganizationTokensController
{
    use HasToRegisterOrganization, HasToManageApiTokens;

    public function __invoke(OrganizationTokensRequest $request)
    {
        try {
            $this->deleteOrganizationTokens($this->getCurrentOrganizationId($request->get('id')));

            return response([
                'message' => "All tokens have been deleted",
            ], 200);

        } catch (Exception $exception) {

            return response()->json([
                'message' => $exception->getMessage()
            ], 400);

        }
    }
}

