<?php

namespace App\Http\Controllers\ApiAuthentication;

use App\Http\Requests\ApiAuthentication\SetPasswordRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Events\UserInvitationAcepted;
use App\Events\MemberInvitationAcepted;

class SetPasswordController
{
    public function __invoke(SetPasswordRequest $request): JsonResponse
    {
        try{
            $user = $request->getCurrentUser();

            $user->update(['password' => Hash::make($request->get('password'))]);
    
            DB::table('password_resets')->where('email', $request->get('email'))->delete();

            event(new UserInvitationAcepted($user));
            event(new MemberInvitationAcepted($user, $user->organization_id));
    
            return response()->json([
                'message' => __('api-authentication.password_updated'),
            ], 200);

        } catch (\Exception $exception) {

            return response()->json([
                'message' => $exception->getMessage()
            ], 400);
        }
    }
}
