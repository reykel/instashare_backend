<?php

namespace App\Http\Controllers\ApiAuthentication;

use App\Http\Requests\ApiAuthentication\NewPasswordRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class NewPasswordController
{
    public function __invoke(NewPasswordRequest $request): JsonResponse
    {
        try{
            $user = $request->getCurrentUser();

            $user->update(['password' => Hash::make($request->get('password'))]);
    
            DB::table('password_resets')->where('email', $user->email)->delete();
    
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
