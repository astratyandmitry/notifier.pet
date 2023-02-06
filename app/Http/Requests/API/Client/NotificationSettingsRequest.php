<?php

namespace App\Http\Requests\API\Client;

use App\Http\Requests\API\Request;

/**
 * @property array $settings
 */
class NotificationSettingsRequest extends Request
{
    public function rules(): array
    {
        return  [
            'settings' => 'required|array',
            'settings.*.category_id' => 'required|exists:notification_categories,id',
            'settings.*.allowed' => 'required|boolean',
        ];
    }
}
