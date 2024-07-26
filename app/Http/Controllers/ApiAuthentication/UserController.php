<?php

namespace App\Http\Controllers\ApiAuthentication;

use App\Http\Requests\ApiAuthentication\GetUserRequest;
use Illuminate\Http\JsonResponse;
use App\Models\User;

class UserController
{
    public function __invoke(GetUserRequest $request): JsonResponse
    {
        try {
            $user = User::firstWhere('id', $request->get('id'));
            
            if($user !== null)
                return response()->json($user, 200);

        } catch (\Exception $exception) {

            return response()->json([
                'message' => $exception->getMessage()
            ], 400);
        }
            return response()->json([
                'message' => "User not registered."
            ], 401);
    }
}
