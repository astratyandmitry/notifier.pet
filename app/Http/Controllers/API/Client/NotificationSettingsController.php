<?php

namespace App\Http\Controllers\API\Client;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\UserNotificationSetting;
use App\Http\Requests\API\Client\NotificationSettingsRequest;
use App\Http\Resources\Client\UserNotificationSettingResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response as FoundationResponse;

class NotificationSettingsController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        // todo: Move to Repository

        $settings = UserNotificationSetting::query()
            ->where('user_id', $request->user()->id)
            ->with('category')->get();

        return UserNotificationSettingResource::collection($settings);
    }

    public function update(NotificationSettingsRequest $request): Response
    {
        // todo: Move to Service

        collect($request->settings)->each(function (array $setting) use ($request) {
            UserNotificationSetting::query()
                ->where('user_id', $request->user()->id)
                ->where('category_id', $setting['category_id'])
                ->update(['allowed' => $setting['allowed']]);
        });

        return response()->noContent(FoundationResponse::HTTP_ACCEPTED);
    }

    public function unsubscribe(int $categoryId, Request $request): Response
    {
        // todo: Move to Service

        $setting = UserNotificationSetting::query()
            ->where('user_id', $request->user()->id)
            ->where('category_id', $categoryId)
            ->firstOrFail();

        $setting->update(['allowed' => false]);

        return response()->noContent(FoundationResponse::HTTP_ACCEPTED);
    }
}
