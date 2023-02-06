<?php

namespace App\Http\Requests\API;

/**
 * @property string $title
 * @property string $body
 * @property array $categories
 */
class NotificationRequest extends Request
{
    public function rules(): array
    {
        return [
            'title' => 'required|max:200',
            'body' => 'required',
            'categories' => 'required|array',
            'categories.*' => 'required|exists:notification_categories,id',
        ];
    }
}
