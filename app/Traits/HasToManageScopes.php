<?php

namespace App\Traits;

use App\Models\Scope;
use Illuminate\Support\Facades\DB;

trait HasToManageScopes
{
    public function showScopes($user_id)
    {
        $scopes_set = Scope::firstWhere('user_id', $user_id);

        $_scopes = array();
        $_scopes = $scopes_set ? explode(",", $scopes_set->roles->scopes) : null;

        return $_scopes;
    }

    private function createScopes($user_id, $role_id)
    {
        DB::table('scopes')->insert([
            'user_id' => $user_id,
            'role_id' => $role_id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $scopes_set = Scope::firstWhere('user_id', $user_id)->roles->scopes;

        $_scopes = array();
        $_scopes = explode(",", $scopes_set);

        return $_scopes;
    }
}
