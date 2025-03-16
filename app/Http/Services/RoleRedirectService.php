<?php

namespace App\Http\Services;

use App\Models\User;
class RoleRedirectService
{
    public function getRedirectRoute($role)
    {
        return match ($role) {
//            User::TYPE_ADMIN => '/admin/dashboard',
            User::TYPE_SUPPLIER => '/supplier/profile',
            User::TYPE_BUYER => '/buyer/profile',
            User::TYPE_ADMIN => '/admin/dashboard',
            default => '/home',

        };
    }
}
