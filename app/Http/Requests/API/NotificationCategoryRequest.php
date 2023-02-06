<?php

namespace App\Http\Requests\API;

/**
 * @property string $name
 */
class NotificationCategoryRequest extends Request
{
    public function rules(): array
    {
        $rules = ['name' => ['required', 'max:80']];

        if ($this->isMethod('POST')) {
            $rules['name'][] = 'unique:notification_categories';
        }

        if ($this->isMethod('PUT')) {
            $rules['name'][] = "unique:notification_categories,name,{$this->route('notification_category')}";
        }

        return $rules;
    }
}
