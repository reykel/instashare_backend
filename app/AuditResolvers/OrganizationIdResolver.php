<?php

namespace App\AuditResolvers;

use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Contracts\Resolver;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class OrganizationIdResolver implements Resolver
{
    public static function resolve(Auditable $auditable)
    {
        $user = User::firstWhere('id', Auth::user()->id);

        return $user->organization_id;
    }
}
