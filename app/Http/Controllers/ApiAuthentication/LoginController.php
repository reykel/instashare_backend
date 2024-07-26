<?php

namespace App\Http\Controllers\ApiAuthentication;

use App\Traits\HasToShowApiTokens;
use App\Traits\HasToAvoidCacheLeaking;
use App\Traits\ManageAccessLogs;
use App\Http\Requests\ApiAuthentication\LoginRequest;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Producto;
use Illuminate\Support\Facades\Cache;

class LoginController
{
    use HasToShowApiTokens, HasToAvoidCacheLeaking, ManageAccessLogs;

    public function __invoke(LoginRequest $request)
    {
        try {
            if(Auth::attempt($request->only(['email', 'password'])) && User::UserState(request('email')) == "Active") {
                $authorization_data = $this->getTokenAndRefreshToken(Auth::user(), request('email'), request('password'), 4);

                DB::table('oauth_access_tokens')
                ->where('user_id', $authorization_data['user']['id'])
                ->update([
                    'organization_id' => $authorization_data['user']['organization_id']
                ]);
                
                $this->clearListingCache();

                $this->AddNewLog(
                    $authorization_data['user']['id'],
                    $authorization_data['user']['organization_id'],
                    'login',
                    'succeded'
                );

                return response()->json($authorization_data, 200);
            }
        } catch (Exception $exception) {
            $this->AddNewLog(1, 1,
                'login',
                $exception->getMessage()
            );

            return response()->json([
                'message' => $exception->getMessage()
            ], 400);
        }
        $this->AddNewLog(1, 1,
            'login',
            'Access error by: '.__('api-authentication.failed'). "-" .request('email')
        );

        return response()->json([
            'message' => __('api-authentication.failed'),
        ], 401);
    }
}