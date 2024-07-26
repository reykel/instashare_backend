<?php

namespace App\Http\Controllers\ApiAuthentication;

use App\Traits\HasToManageUsers;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ApiAuthentication\DeleteUserRequest;

class DeleteUserController
{
    use HasToManageUsers;

    public function __invoke(DeleteUserRequest $request)
    {
        try {
            $this->deleteUserAccount($request->get('id'));

            return response([
                'message' => "User have been deleted",
            ], 200);

        } catch (Exception $exception) {

            return response()->json([
                'message' => $exception->getMessage()
            ], 400);

        }
    }
}

