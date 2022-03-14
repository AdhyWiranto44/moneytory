<?php

namespace App\Repositories;

use App\Models\Privilege;
use Illuminate\Support\Facades\DB;

class PrivilegeRepository
{
    public function __construct()
    {
        $this->privilege = new Privilege();
    }
    
    public function get($params)
    {
        return $this->privilege->where($params)->get();
    }

    public function insert($data)
    {
        $this->privilege->insert($data);
    }

    public function delete($params)
    {
        $this->privilege->where($params)->delete();
    }
}