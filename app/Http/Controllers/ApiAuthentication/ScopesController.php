<?php

namespace App\Http\Controllers\ApiAuthentication;

use App\Traits\HasToManageScopes;
use App\Http\Requests\ApiAuthentication\GetScopesRequest;
use Illuminate\Http\JsonResponse;

class ScopesController
{
    use HasToManageScopes;

    public function __invoke(GetScopesRequest $request): JsonResponse
    {
        try {
            $response = [
                'message' => "scopes retrived",
                'scopes' => $this->showScopes($request->get('user_id')),
            ];

            return response()->json($response, 200);

        } catch (\Exception $exception) {

            return response()->json([
                'message' => $exception->getMessage()
            ], 400);

        }
    }
}
