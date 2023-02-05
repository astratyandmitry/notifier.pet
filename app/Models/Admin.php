<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;

/**
 * @property string $email
 * @property string $password
 */
class Admin extends Model
{
    use HasApiTokens;

    protected $fillable = ['email', 'password',];

    protected $hidden = ['password'];
}
