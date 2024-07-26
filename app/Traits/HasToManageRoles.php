<?php

namespace App\Traits;

use App\Models\Scope;

trait HasToManageRoles
{
    public function showRole($user_id)
    {
        $role = Scope::firstWhere('user_id', $user_id)->roles;

        $response = [
            'id' => $role->id,
            'description' => $role->scopes
        ];

        return $response;
    }
}
