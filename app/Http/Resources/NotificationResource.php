<?php

namespace App\Http\Resources;

use App\Http\Resources\NotificationCategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Notification
 */
class NotificationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'title' => $this->title,
            'body' => $this->body,
            'aggregate' => new NotificationAggregateResource($this->aggregate),
            'categories' => NotificationCategoryResource::collection($this->categories),
        ];
    }
}
