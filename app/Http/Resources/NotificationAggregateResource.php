<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\NotificationAggregate
 */
class NotificationAggregateResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'count_views' => $this->count_views,
        ];
    }
}
