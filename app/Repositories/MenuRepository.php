<?php

namespace App\Repositories;

use App\Models\Menu;

class MenuRepository
{
    static function getAll()
    {
        return Menu::all();
    }
}