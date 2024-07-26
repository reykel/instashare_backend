<?php

namespace App\Http\Controllers\ApiAuthentication;

use App\Http\Requests\ApiAuthentication\ChangePasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

use App\Models\User;

class ChangePasswordController
{

    public function __invoke(ChangePasswordRequest $request): JsonResponse
    {
        try{
            $user = User::firstWhere('id', Auth::user()->id);

            if(!(Hash::check($request->get('old_password'), $user->password))){
                return response()->json([
                    'errors' => ['old_password' => 
                        ["Error on current password"]
                    ]
                ], 400);
            }

            $user->update(['password' => Hash::make($request->get('password'))]);

            return response()->json([
                'message' => __('api-authentication.password_updated'),
            ], 200);

        } catch (\Exception $exception) {

            return response()->json([
                'message' => $exception->getMessage()
            ], 400);
        }
    }
}
