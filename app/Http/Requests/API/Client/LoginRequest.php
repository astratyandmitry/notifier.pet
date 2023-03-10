<?php

namespace App\Http\Requests\API\Client;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $email
 * @property string $password
 */
class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required',
            'password' => 'required',
        ];
    }
}
