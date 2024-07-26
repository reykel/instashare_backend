<?php

namespace App\Traits;

use App\Models\AccessLogs;
use Illuminate\Support\Facades\Request;

trait ManageAccessLogs
{
    public function AddNewLog($user_id, $organization_id, $action, $state)
    {
        AccessLogs::query()->create([
            'user_id' => $user_id,
            'action' => $action,
            'succeded' => $state,
            'ip_address' => Request::getClientIp(true),
            'user_agent' => Request::header('User-Agent', 'N/A'),
            'organization_id' => $organization_id,
        ]);
    }
}
