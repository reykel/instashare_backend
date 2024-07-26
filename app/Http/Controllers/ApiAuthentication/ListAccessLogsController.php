<?php

namespace App\Http\Controllers\ApiAuthentication;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\AccessLogs;
use App\Models\User;
use App\Traits\HasToRegisterOrganization;
use App\Traits\HasToManageRoles;
use App\Http\Resources\AccessesResource;


class ListAccessLogsController
{
    use HasToRegisterOrganization, HasToManageRoles;

    public function __invoke(): JsonResponse
    {
        try{
            $_role = $this->showRole(Auth::user()->id);

            if($_role['id'] == 1 || $_role['id'] == 2)
                $response = AccessLogs::orderBy('created_at', 'desc')->get();
            elseif($_role['id'] == 3)
                $response = AccessLogs::where('organization_id', $this->getCurrentOrganization())->orderby('created_at', 'desc')->get();
            else
                $response = AccessLogs::where('user_id', Auth::user()->id)->orderby('created_at', 'desc')->get();

            return response()->json([
                'access_logs' => AccessesResource::collection($response),
                'message' => 'All access logs values were retrieved',
            ], 200);

        } catch (\Exception $exception) {

            return response()->json([
                'message' => $exception->getMessage()
            ], 400);
        }
    }
}
