<?php

namespace App\Http\Controllers\ApiAuthentication;

use App\Http\Requests\Settings\SetSettingRequest;
use App\Traits\HasToManageSettings;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class SetSettingController
{
    use HasToManageSettings;

    public function __invoke(SetSettingRequest $request): JsonResponse
    {
        try{

            DB::table('settings')
            ->where('key', $request->get('key'))
            ->update([
                'value' => $request->get('value')
            ]);

            //$this->setSettingValue($request->get('key'), $request->get('value'));

            return response()->json([
                'message' =>'Setting value updated',
            ], 200);

        } catch (\Exception $exception) {

            return response()->json([
                'message' => $exception->getMessage()
            ], 400);
        }
    }
}
