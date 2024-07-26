<?php

namespace App\Http\Controllers\ApiAuthentication;

use App\Traits\HasToManageApiTokens;
use App\Traits\HasToRegisterOrganization;
use Exception;

class ListTokensController
{
    use HasToManageApiTokens, HasToRegisterOrganization;

    public function __invoke()
    {
        try {
            //return $this->getTokensList($this->getCurrentOrganization());

            return response()->json([
                'tokens' => $this->getTokensList($this->getCurrentOrganization()),
                'message' => 'All tokens were retrieved',
            ], 200);

        } catch (Exception $exception) {

            return response()->json([
                'message' => $exception->getMessage()
            ], 400);

        }
    }
}

