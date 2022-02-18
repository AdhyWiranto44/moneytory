<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    public function __construct()
    {
        $this->user = new User();
    }

    public function getAll()
    {
        return DB::table('users')
                ->join('roles', 'users.role_id', '=', 'roles.id')
                ->join('statuses', 'users.status_id', '=', 'statuses.id')
                ->select('users.*', 'roles.name as role_name', 'statuses.name as status_name');
    }
    
    public function get($params)
    {
        return $this->user->where($params)->get();
    }

    public function insert($data)
    {
        $this->user->create($data)->save();
    }

    public function update($params, $update)
    {
        $this->user->where($params)->update($update);
    }

    public function delete($params)
    {
        $this->user->where($params)->delete();
    }
}