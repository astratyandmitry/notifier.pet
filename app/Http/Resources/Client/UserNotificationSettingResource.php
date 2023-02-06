<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\UserNotificationSetting
 */
class UserNotificationSettingResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'category' => new NotificationCategoryResource($this->category),
            'allowed' => $this->allowed,
        ];
    }
}
