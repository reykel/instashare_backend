<?php

namespace App\Http\Controllers\ApiAuthentication;

use Exception;
use App\Http\Requests\ApiAuthentication\UpdateAccountStatusRequest;
use Illuminate\Support\Facades\DB;

class UpdateAccountStatusController
{
    public function __invoke(UpdateAccountStatusRequest $request)
    {
        try {
            DB::table('users')
                ->where('email', $request->get('email'))
                ->update([
                    'is_active' => $request->get('account_state')
                ]
            );

            return response([
                'message' => "Account status updated",
            ], 200);

        } catch (Exception $exception) {

            return response()->json([
                'message' => $exception->getMessage()
            ], 400);

        }
    }
}

