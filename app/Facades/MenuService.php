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
        $params = [
            'role_id' => $role_id,
            'display' => 1
        ];
        $menus = $this->menuRepository->getAllJoinWithPrivileges($params);
        return $menus;
    }

    public function getOne(String $slug = "")
    {
        $params = [ 'slug' => $slug ];
        return $this->menuRepository->get($params)->first();
    }
}