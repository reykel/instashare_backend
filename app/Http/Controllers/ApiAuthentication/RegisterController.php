<?php

namespace App\Http\Controllers\ApiAuthentication;

use App\Traits\HasToShowApiTokens;
use App\Traits\HasToRegisterOrganization;
use App\Traits\HasToAvoidCacheLeaking;
use App\Traits\ManageAccessLogs;
use App\Http\Requests\ApiAuthentication\RegisterRequest;
use App\Notifications\ApiAuthentication\VerifyEmailNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

use App\Events\NewUserAdded;
//use App\Events\Register;

class RegisterController
{
    use HasToShowApiTokens, HasToRegisterOrganization, HasToAvoidCacheLeaking, ManageAccessLogs;

    public function __invoke(RegisterRequest $request): JsonResponse
    {
        try {
            $user = User::query()->create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
                'organization_id' => $this->createOrganization(),
            ]);

            //if($user instanceof MustVerifyEmail && ! $user->hasVerifiedEmail()) {
            $user->notify(new VerifyEmailNotification);
            //}

            $authorization_data = $this->getTokenAndRefreshToken($user, $request->get('email'), $request->get('password'), 3);

            DB::table('oauth_access_tokens')
            ->where('user_id', $authorization_data['user']['id'])
            ->update([
                'organization_id' => $authorization_data['user']['organization_id']
            ]);

            $this->clearListingCache();

            $this->AddNewLog(
                $authorization_data['user']['id'],
                $authorization_data['user']['organization_id'],
                'register',
                '-1'
            );

            event(new NewUserAdded($user));

            return response()->json($authorization_data, 200);

        } catch (\Exception $exception) {
/*
            $this->AddNewLog(
                $authorization_data['user']['id'],
                $authorization_data['user']['organization_id'],
                'register',
                $exception->getMessage()
            );
*/
            return response()->json([
                'message' => $exception->getMessage()
            ], 400);

        }
    }
}
