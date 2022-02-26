<?php

namespace App\Facades;

use App\Repositories\MenuRepository;

class MenuService
{
    public function __construct()
    {
        $this->menuRepository = new MenuRepository();
    }

    public function getByRoleId($role_id)
    {
        $menus = $this->menuRepository->getAll()->where('display', '=', 1);
        return $menus;
    }
}