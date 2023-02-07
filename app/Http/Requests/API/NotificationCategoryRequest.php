<?php

namespace App\Http\Requests\API;

/**
 * @property string $name
 */
class NotificationCategoryRequest extends Request
{
    public function rules(): array
    {
        $rules = ['title' => ['required', 'max:80']];

        if ($this->isMethod('POST')) {
            $rules['title'][] = 'unique:notification_categories';
        }

        if ($this->isMethod('PUT')) {
            $rules['title'][] = "unique:notification_categories,title,{$this->route('notification_category')}";
        }

        return $rules;
    }
}
