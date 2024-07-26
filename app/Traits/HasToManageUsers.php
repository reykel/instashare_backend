<?php

namespace App\Traits;

use App\Models\Scope;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Traits\HasToManageApiTokens;

trait HasToManageUsers
{
    use HasToManageApiTokens;

    public function revokeUserAccount($id, $_value) { 
        DB::table('users')
            ->where('id', $id)
            ->update([
                'is_active' => $_value
            ]);
        
        if($_value == 1)
            $this->deleteUserTokens($id);

        return response([
            'message' => "User account has been revoked",
        ], 200);
    }

    public function deleteUserAccount($id) { 
        DB::table('users')
            ->where('id', $id)
            ->delete();

        return response([
            'message' => "User account has been deleted",
        ], 200);
    }
    
    public function revokeOrganizationUsersAccount($id, $_value) { 
        DB::table('users')
            ->where('organization_id', $id)
            ->update([
                'is_active' => $_value
            ]);

        return response([
            'message' => "User accounts on this organization have been revoked",
        ], 200);
    }

    public function deleteOrganizationUsersAccount($id) { 
        DB::table('users')
            ->where('organization_id', $id)
            ->delete();

        return response([
            'message' => "User accounts on this organization have been deleted",
        ], 200);
    }
}
