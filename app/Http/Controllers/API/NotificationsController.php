<?php

namespace App\Http\Controllers\API;

use App\Models\Notification;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Http\Requests\API\NotificationRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class NotificationsController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $notifications = Notification::query()->with('aggregate')->latest()->get();

        // todo: Implement Pagination

        return NotificationResource::collection($notifications);
    }

    public function store(NotificationRequest $request): JsonResponse
    {
        /** @var \App\Models\Notification $notification */
        $notification = Notification::query()->create($request->except('categories'));
        $notification->categoriesSync($request->categories);

        // todo: broadcast event

        return response()->json([
            'message' => 'Notification created successfully',
            'data' => new NotificationResource($notification),
        ], 201);
    }

    public function show(int $id): NotificationResource
    {
        $notification = Notification::query()->findOrFail($id);

        return new NotificationResource($notification);
    }

    public function update(NotificationRequest $request, int $id): JsonResponse
    {
        /** @var \App\Models\Notification $notification */
        $notification = Notification::query()->findOrFail($id);
        $notification->update($request->except('categories'));
        $notification->categoriesSync($request->categories);

        return response()->json([
            'message' => 'Notification updated successfully',
            'data' => new NotificationResource($notification),
        ], 200);
    }

    public function destroy(int $id): JsonResponse
    {
        /** @var \App\Models\Notification $notification */
        $notification = Notification::query()->findOrFail($id);
        $notification->delete();

        return response()->json([
            'message' => 'Notification deleted successfully',
        ], 200);
    }
}
