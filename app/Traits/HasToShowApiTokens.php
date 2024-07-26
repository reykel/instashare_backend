<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use App\Traits\HasToManageScopes;

trait HasToShowApiTokens
{
    use HasToManageScopes;

    public function getTokenAndRefreshToken($user, $email, $password, $_initial_scope) { 
        $_scopes = $this->showScopes($user->id) ?? $this->createScopes($user->id, $_initial_scope);

        $response = Http::post(config('app.url').'/oauth/token', [
            'grant_type' => 'password',
            'client_id' =>  config('app.oauth_serve_id'),
            'client_secret' => config('app.oauth_serve_secret'),
            'username' => $email,
            'password' => $password,
            'scope' => $_scopes
        ]);
        $data['message'] = __('api-authentication.success');
        $data['user'] = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'email_verified_at' => $user->email_verified_at,
            'organization_id' => $user->organization_id
        ];
        $data['token'] = $response['access_token'];
        $data['refresh_token'] = $response['refresh_token'];
        $data['token_type'] = $response['token_type'];
        $data['expires_in'] = $response['expires_in'];
        $data['scopes'] = $_scopes;

        return $data;
    }

    public function refresh($refresh_token)
    {
        $response = Http::post(config('app.url').'/oauth/token', [ 
            'grant_type' => 'refresh_token',
            'refresh_token' => $refresh_token,
            'client_id' =>  config('app.oauth_serve_id'),
            'client_secret' => config('app.oauth_serve_secret'),
            'scope' => 'admin-ceo'
        ]);

        $data['message'] = __('api-authentication.success');
        $data['token'] = $response['access_token'];
        $data['refresh_token'] = $response['refresh_token'];
        $data['token_type'] = $response['token_type'];
        $data['expires_in'] = $response['expires_in'];

        return response()->json($data, 200);
    }
}
