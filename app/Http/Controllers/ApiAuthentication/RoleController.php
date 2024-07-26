<?php

namespace App\Http\Controllers\ApiAuthentication;

use App\Traits\HasToManageRoles;
use App\Http\Requests\ApiAuthentication\GetRoleRequest;
use Illuminate\Http\JsonResponse;

class RoleController
{
    use HasToManageRoles;

    public function __invoke(GetRoleRequest $request): JsonResponse
    {
        try {
            $response = [
                'message' => "role retrived",
                'role' => $this->showRole($request->get('user_id')),
            ];

            return response()->json($response, 200);

        } catch (\Exception $exception) {

            return response()->json([
                'message' => $exception->getMessage()
            ], 400);

        }
    }
}
