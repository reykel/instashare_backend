<?php

namespace App\Http\Controllers\ApiAuthentication;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ListSettingController
{
    public function __invoke(): JsonResponse
    {
        try{
            $response = DB::table('settings')->get();

            return response()->json([
                'setting' => $response,
                'message' => 'All Setting values were retrieved',
            ], 200);

        } catch (\Exception $exception) {

            return response()->json([
                'message' => $exception->getMessage()
            ], 400);
        }
    }
}
