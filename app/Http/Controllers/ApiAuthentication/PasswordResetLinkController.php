<?php

namespace App\Http\Controllers\ApiAuthentication;

use App\Http\Requests\ApiAuthentication\PasswordResetLinkRequest;
use App\Models\User;
use App\Notifications\ApiAuthentication\ResetPasswordNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PasswordResetLinkController
{
    public function __invoke(PasswordResetLinkRequest $request): JsonResponse
    {
        try{
            $user = $request->getCurrentUser();
            $token = Str::random(60);
    
            DB::table('password_resets')->insert([
                'email' => $user->email,
                'token' => $token,
                'created_at' => now()
            ]);
    
            $user->notify(new ResetPasswordNotification($token));
    
            return response()->json([
                'message' => __('api-authentication.check_your_email'),
            ], 200);

        } catch (\Exception $exception) {

            return response()->json([
                'message' => $exception->getMessage()
            ], 400);
        }
    }
}
