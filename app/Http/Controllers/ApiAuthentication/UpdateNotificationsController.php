<?php

namespace App\Http\Controllers\ApiAuthentication;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ApiAuthentication\UpdateNotificationsRequest;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class UpdateNotificationsController
{
    public function __invoke(UpdateNotificationsRequest $request): JsonResponse
    {
        try{
            $data = $this->newNotifications($request->get('level'), $request->get('scope'));

            foreach ($data as $item){
                DB::table('viewed_notifications')
                ->insert([
                    'notification_id' => $item['id'],
                    'user_id' => Auth::user()->id,
                    'created_at' => now()
                ]);                
            }

            return response()->json([
                'notifications' => 'success',
            ], 200);

        } catch (\Exception $exception) {

            return response()->json([
                'message' => $exception->getMessage()
            ], 400);
        }
    }


    private function newNotifications($_level, $_scope)
    {
        try{
            $data = Notification::leftJoin('viewed_notifications', function($join){
                $join->on('notifications.id', '=', 'viewed_notifications.notification_id');
            })->where([
                ['level', '=',  $_level],
                ['scope', '=',  $_scope],
            ])->where([
                ['viewed_notifications.notification_id', '=', null]
            ])->select('notifications.*')->get();

            return $data;

        } catch (\Exception $exception) {

            return response()->json([
                'message' => $exception->getMessage()
            ], 400);
        }
    }
}
