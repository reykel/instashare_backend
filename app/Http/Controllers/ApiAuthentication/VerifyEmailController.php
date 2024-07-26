<?php

namespace App\Http\Controllers\ApiAuthentication;

use App\Http\Requests\ApiAuthentication\EmailVerificationRequest;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;

use App\Events\UserEmailVerified;
use App\Events\MemberEmailVerified;
use App\Events\OwnEmailVerified;

class VerifyEmailController
{
    public function __invoke(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            if($request->wantsJson()) {
                return response()->json([
                    'message' => __('api-authentication.email_already_verified'),
                ], 200);
            }
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        event(new UserEmailVerified($request->user()));
        event(new MemberEmailVerified($request->user()));
        //event(new OwnEmailVerified($request->user()));

        if($request->wantsJson()) {
            return response()->json([
                'message' => __('api-authentication.email_verified'),
            ], 200);
        }
        return redirect()->to(config('api-authentication.email_account_verified_url'));
    }
}
