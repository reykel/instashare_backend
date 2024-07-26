<?php

namespace App\Http\Controllers\ApiAuthentication;

use App\Http\Requests\ApiAuthentication\UpdateUserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UpdateUserController
{
    public function __invoke(UpdateUserRequest $request): JsonResponse
    {
        try {
            $user = User::firstWhere('id', $request->get('id'));

            $user->update([
                'name' => $request->get('name'),
                'email' => $request->get('email')
            ]);

            return response()->json($user, 200);


        } catch (\Exception $exception) {

            return response()->json([
                'message' => $exception->getMessage()
            ], 400);

        }
    }
}
