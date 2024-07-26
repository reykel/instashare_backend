<?php

namespace App\Http\Controllers\ApiAuthentication;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ApiAuthentication\ListNotificationsRequest;
use App\Models\Notification;
use App\Http\Resources\ListNotificationResource;

class ListNotificationsController
{
    public function __invoke(ListNotificationsRequest $request): JsonResponse
    {
        try{
            $response = Notification::leftJoin('viewed_notifications', function($join){
                $join->on('notifications.id', '=', 'viewed_notifications.notification_id');
            })->where([
                ['level', '=',  $request->get('level')],
                ['scope', '=',  $request->get('scope')],
            ])->orderby('notifications.id', 'DESC')->limit(10)
            ->get();

            return response()->json([
                'notifications' => ListNotificationResource::collection(
                    $response
                )
            ], 200);

        } catch (\Exception $exception) {

            return response()->json([
                'message' => $exception->getMessage()
            ], 400);
        }
    }
}
