<?php

namespace App\Http\Controllers\ApiAuthentication;

use App\Traits\HasToShowApiTokens;
use App\Http\Requests\ApiAuthentication\RefreshRequest;
use Exception;
use Illuminate\Support\Facades\Auth;

class RefreshController
{
    use HasToShowApiTokens;

    public function __invoke(RefreshRequest $request)
    {
        try {

            return $this->refresh(request('refresh_token'));

        } catch (Exception $exception) {

            return response()->json([
                'message' => $exception->getMessage()
            ], 400);

        }
    }
}