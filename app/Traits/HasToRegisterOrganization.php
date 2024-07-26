<?php

namespace App\Traits;

use App\Models\Organization;
use App\Models\user;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait HasToRegisterOrganization
{
    public function createOrganization()
    {
        $organization = Organization::query()->create([
            'name' => 'Unknown'
        ]);

        return $organization->id;
    }

    public function deleteOrganization($id)
    {
        DB::table('organizations')
            ->where('id', $id)
            ->delete();

        return response([
            'message' => "Organization has been revoked",
        ], 200);
    }

    public function revokeOrganization($id, $_value)
    {
        DB::table('organizations')
            ->where('id', $id)
            ->update([
                'is_active' => $_value
            ]);

        return response([
            'message' => "Organization has been revoked",
        ], 200);
    }

    public function getCurrentOrganization()
    {
        return self::Organization(auth()->id());
    }

    public function getCurrentOrganizationId($id)
    {
        return self::Organization($id);
    }

    public function getCurrentOrganizationUsers()
    {
        return self::OrganizationUsers(auth()->id());
    }

    public function getOrganizationUsers($id)
    {
        return self::OrganizationUsers($id);
    }

    private static function Organization($id){
        $user = User::findOrFail($id);
        return $user->organization_id;
    }

    private static function OrganizationUsers($id){
        $users = User::where('organization_id', self::Organization($id))->get();
        return $users;
    }

    public function getOrganizationTenant($id)
    {
        $data = DB::select('SELECT users.* 
        FROM users 
        INNER JOIN scopes ON users.id = scopes.user_id
        INNER JOIN roles ON roles.id = scopes.role_id
        WHERE
        users.organization_id = '.$id.' AND
        roles.role = "Tenant"');
        
        return $data[0];
    }
}
