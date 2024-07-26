<?php

namespace App\Http\Controllers\ApiAuthentication;

use App\Http\Requests\Settings\GetSettingRequest;
use App\Traits\HasToManageSettings;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class GetSettingController
{
    use HasToManageSettings;

    public function __invoke(GetSettingRequest $request): JsonResponse
    {
        try{
            $response = DB::table('settings')->where('key', $request->get('key'))->first();

            return response()->json([
                'setting' => $response,
                'message' => 'Setting value retrieved',
            ], 200);

        } catch (\Exception $exception) {

            return response()->json([
                'message' => $exception->getMessage()
            ], 400);
        }
    }
}
