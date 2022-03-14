<?php

namespace App\Facades;

use App\Helper;
use App\Repositories\PrivilegeRepository;
use Illuminate\Support\Facades\Hash;

class PrivilegeService
{
    public function __construct()
    {
        $this->privilegeRepository = new PrivilegeRepository();
        $this->helper = new Helper();
    }

    public function getByRoleId(int $role_id = 0)
    {
        $params = [ 'role_id' => $role_id ];
        return $this->privilegeRepository->get($params);
    }

    public function insert()
    {
        $role_id = request()->input('role');
        $privileges = array_filter(request()->input(), function($key) {
            return $key != "_token" && $key != "_method" && $key != "role";
        }, ARRAY_FILTER_USE_KEY);
        $data = [];
        foreach($privileges as $key => $value) {
            array_push($data, [
                'role_id' => $role_id,
                'menu_id' => $value,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        $this->privilegeRepository->insert($data);
    }

    public function delete(int $role_id = 0)
    {
        $params = [ 'role_id' => $role_id ];
        $this->privilegeRepository->delete($params);
    }
}