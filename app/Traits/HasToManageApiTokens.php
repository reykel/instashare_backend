<?php

namespace App\Traits;

use App\Http\Revokers\PassportRevoker;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Laravel\Passport\Passport;
use Laravel\Passport\TokenRepository;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\TokensResource;

trait HasToManageApiTokens
{
    public function getTokensList($organization_id) { 

    $response = DB::table('oauth_access_tokens')
        ->join('organizations', 'oauth_access_tokens.organization_id', '=', 'organizations.id')
        ->join('users', 'oauth_access_tokens.user_id', '=', 'users.id')
        ->join('oauth_clients', 'oauth_access_tokens.client_id', '=', 'oauth_clients.id')
        ->select('oauth_access_tokens.*', 'organizations.name as organization', 'users.email as email', 'oauth_clients.name as client')
        ->where('oauth_access_tokens.organization_id', $organization_id)
        ->get();
        return $response;
    }

    public function revokeOrganizationTokens($organization_id, $_value) { 
        DB::table('oauth_access_tokens')
            ->where('organization_id', $organization_id)
            ->update([
                'revoked' => $_value
            ]);
            
        return response([
            'message' => "All organization tokens have been revoked",
        ], 200);
    }

    public function deleteOrganizationTokens($organization_id) { 
        DB::table('oauth_access_tokens')
            ->where('user_id', $organization_id)
            ->delete();

        return response([
            'message' => "All organization tokens have been deleted",
        ], 200);
    }    

    public function revokeUserTokens($user_id) { 
        DB::table('oauth_access_tokens')
            ->where('user_id', $user_id)
            ->update([
                'revoked' => true
            ]);

        return response([
            'message' => "All user tokens have been revoked",
        ], 200);
    }

    public function deleteUserTokens($user_id) { 
        DB::table('oauth_access_tokens')
            ->where('user_id', $this->user->id)
            ->delete();

        return response([
            'message' => "All user tokens have been deleted",
        ], 200);
    }

    public function revokeToken($id, $int_value) { 
        DB::table('oauth_access_tokens')
            ->where('id', $id)
            ->update([
                'revoked' => $int_value
            ]);

        return response([
            'message' => "Token have been revoked",
        ], 200);
    }

    public function deleteToken($id) { 
        DB::table('oauth_access_tokens')
        ->where('id', $id)
            ->delete();

        return response([
            'message' => "Token have been deleted",
        ], 200);
    }
}