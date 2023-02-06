<?php

namespace App\Http\Controllers\API\Client;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\Client\NotificationResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response as FoundationHttp;

class NotificationsController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        // todo: Move to Repository
        // todo: Add Caching of User's Settings

        $notifications = Notification::query()
            ->join('pivot_notification_categories', 'notifications.id', '=', 'pivot_notification_categories.notification_id')
            ->join('notification_categories', 'pivot_notification_categories.category_id', '=', 'notification_categories.id')
            ->join('user_notification_settings', 'notification_categories.id', '=', 'user_notification_settings.category_id')
            ->leftJoin('pivot_notification_users', function ($join) use ($request) {
                $join->on('notifications.id', '=', 'pivot_notification_users.notification_id')
                    ->where('pivot_notification_users.user_id', '=', $request->user()->id);
            })
            ->where('user_notification_settings.user_id', $request->user()->id)
            ->where('user_notification_settings.allowed', true)
            ->whereNull('pivot_notification_users.id')
            ->select('notifications.*')
            ->distinct()->get();

        return NotificationResource::collection($notifications);
    }

    public function read(int $id, Request $request): Response
    {
        // todo: Move to Service

        /** @var \App\Models\Notification $notification */
        $notification = Notification::unreadByUser($request->user())->findOrFail($id);
        $notification->markAsRead($request->user());

        return response()->noContent(FoundationHttp::HTTP_ACCEPTED);
    }
}
