<?php

namespace App\Http\Controllers\ApiAuthentication;

use App\Traits\HasToManageRoles;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UsersController
{
    use HasToManageRoles;

    public function __invoke(): JsonResponse
    {
        try {
            $_role = $this->showRole(Auth::user()->id);

            if($_role['id'] == 1 || $_role['id'] == 2)
                $users = User::with('organizations')->whereHas('scopes', function(Builder $query){
                    $query->where('role_id', '>', '2');
                })->with('scopes.roles')->get();
            elseif($_role['id'] == 3)
                $users = User::with('organizations')->whereHas('scopes', function(Builder $query){
                        $query->where('role_id', '>', '3');
                    })->where('organization_id', Auth::user()->organization_id)
                    ->with('scopes.roles')->get();
            else
                $users = null;
    
            return response()->json($users, 200);

        } catch (\Exception $exception) {

            return response()->json([
                'message' => $exception->getMessage()
            ], 400);

        }
    }
}
