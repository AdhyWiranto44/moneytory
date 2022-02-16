<?php

namespace App\Repositories;

use App\Models\Menu;

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
}