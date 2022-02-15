<?php

namespace App\Facades;

use App\Repositories\MenuRepository;

class MenuService
{
    static function getByRoleId($role_id)
    {
        $menus = MenuRepository::getAll()->where('role_id', '>=', $role_id);
        return $menus;
    }
}