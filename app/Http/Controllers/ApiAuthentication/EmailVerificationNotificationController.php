<?php

namespace App\Http\Controllers\ApiAuthentication;

use App\Notifications\ApiAuthentication\VerifyEmailNotification;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmailVerificationNotificationController
{
    public function __invoke(Request $request)
    {
        if ($request->user('api')->hasVerifiedEmail()) {
            return response(['message'=> __('api-authentication.email_already_verified')]);
        }

        $request->user('api')->notify(new VerifyEmailNotification);

        return response()->json([
            'message' => __('api-authentication.email_sent'),
        ], 200);
    }
}
