<?php

namespace App\Http\Controllers\ApiAuthentication;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Auditorias;
use App\Models\User;
use App\Traits\HasToRegisterOrganization;
use App\Traits\HasToManageRoles;
use App\Http\Resources\AuditoriasResource;


class ListAuditoriasController
{
    use HasToRegisterOrganization, HasToManageRoles;

    public function __invoke(): JsonResponse
    {
        try{
            $_role = $this->showRole(Auth::user()->id);

            if($_role['id'] == 1 || $_role['id'] == 2)
                $response = Auditorias::orderBy('created_at', 'desc')->get();
            elseif($_role['id'] == 3)
                $response = Auditorias::where('organization_id', $this->getCurrentOrganization())->orderby('created_at', 'desc')->get();
            else
                $response = Auditorias::where('user_id', Auth::user()->id)->orderby('created_at', 'desc')->get();

            return response()->json([
                'auditorias' => AuditoriasResource::collection($response),
                'message' => 'All audits logs values were retrieved',
            ], 200);

        } catch (\Exception $exception) {

            return response()->json([
                'message' => $exception->getMessage()
            ], 400);
        }
    }
}
