<?php

namespace App\Http\Controllers;

use App\Facades\MenuService;
use App\Facades\PrivilegeService;
use App\Facades\RoleService;
use App\Facades\UserService;
use App\Helper;
use App\Models\Privilege;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PrivilegeController extends Controller
{
    public function __construct()
    {
        $this->userService = new UserService();
        $this->roleService = new RoleService();
        $this->helper = new Helper();
        $this->menuService = new MenuService();
        $this->privilegeService = new PrivilegeService();
    }
    
    public function edit($name)
    {
        [ $user, $company, $menus ] = $this->helper->getCommonData();
        $role = $this->roleService->getOne($name);
        $menu_privileges = $this->menuService->getAll();
        $role_id = $role->id;
        $privileges = $this->privilegeService->getByRoleId($role_id);
        $data = [
            'title' => 'Ubah',
            'role' => $role,
            'role_id' => $role_id,
            'privileges' => $privileges,
            'menus' => $menus,
            'menu_privileges' => $menu_privileges,
            'username' => $user->username,
            'userImage' => $user->image,
            'companyName' => $company->name,
            'companyLogo' => $company->image,
        ];
        
        return view('privilege_edit', $data);
    }

    public function update(Request $request, $name)
    {
        $role = $this->roleService->getOne($name);
        $role_id = $request->input('role');
        
        // remove all current privileges
        try {
            $this->privilegeService->delete($role_id);
        } catch(QueryException $ex) {
            return redirect('/roles')->with('error', 'Ubah hak akses gagal!');
        }

        // then add new privileges
        try {
            $this->privilegeService->insert();
            return redirect('/roles')->with('success', 'Ubah hak akses berhasil!');
        } catch(QueryException $ex) {
            return redirect('/roles')->with('error', 'Ubah hak akses gagal!');
        }
    }
}
