<?php

use App\Models\User;
use App\Helpers\Enums\Roles;

// функция на проверку является ли пользователь админом или нет
if (!function_exists('isAdmin'))
{
    function isAdmin(User $user): bool
    {
        return $user->role->name === Roles::Admin->value;
    }
}

