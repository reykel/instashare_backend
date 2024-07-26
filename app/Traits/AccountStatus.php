<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use App\Models\User;

trait AccountStatus {

    public static function UserState($_email){
        $user = User::firstWhere('email', $_email);
        return $user->is_active;
    }

    public function updateUserState($_email, $_state) { 
        DB::table('users')
            ->where('email', $_email)
            ->update([
                'is_active' => $_state
            ]);

        return response([
            'message' => "The account has been updated",
        ], 200);
    }
}