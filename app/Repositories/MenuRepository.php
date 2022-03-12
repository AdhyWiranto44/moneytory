<?php

namespace App\Repositories;

use App\Models\Menu;
use Illuminate\Support\Facades\DB;

class MenuRepository
{
    public function __construct()
    {
        $this->menu = new Menu();
    }

    public function getAll()
    {
        return $this->menu->all();
    }

    public function getAllJoinWithPrivileges($params)
    {
        return DB::table('menus')
                ->join('privileges', 'menus.id', '=', 'privileges.menu_id')
                ->select('menus.*')
                ->where('privileges.role_id', '=', $params['role_id'])
                ->where('menus.display', '=', 1)
                ->get();
    }

    public function get($params)
    {
        return $this->menu->where($params)->get();
    }
}