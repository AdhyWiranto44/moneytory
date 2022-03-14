<?php

namespace App\Http\Controllers;

use App\Facades\RoleService;
use App\Facades\UserService;
use App\Helper;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->userService = new UserService();
        $this->roleService = new RoleService();
        $this->helper = new Helper();
    }
    
    public function index()
    {
        [ $user, $company, $menus ] = $this->helper->getCommonData();
        $roles = $this->roleService->getAll();
        $data = [
            'title' => 'Role',
            'roles' => $roles,
            'menus' => $menus,
            'username' => $user->username,
            'userImage' => $user->image,
            'companyName' => $company->name,
            'companyLogo' => $company->image,
        ];
        return view('roles', $data);
    }

    public function create()
    {
        [ $user, $company, $menus ] = $this->helper->getCommonData();
        $data = [
            'title' => 'Tambah',
            'menus' => $menus,
            'username' => $user->username,
            'userImage' => $user->image,
            'companyName' => $company->name,
            'companyLogo' => $company->image,
        ];
        return view('role_add', $data);
    }

    public function store(Request $request)
    {
        $request->validate(
            [ 'name' => 'required|unique:roles' ],
            [
                'required' => 'Kolom ini harus diisi!',
                'unique' => 'Role sudah ada!',
            ]
        );

        try {
            $this->roleService->insert();
            return redirect('/roles')->with('success', 'Tambah Role Berhasil!');
        } catch(QueryException $ex) {
            return redirect('/roles')->with('error', 'Tambah Role Gagal!');
        }
    }

    public function edit($name)
    {
        [ $user, $company, $menus ] = $this->helper->getCommonData();
        $role = $this->roleService->getOne($name);
        $data = [
            'title' => 'Ubah',
            'role' => $role,
            'menus' => $menus,
            'username' => $user->username,
            'userImage' => $user->image,
            'companyName' => $company->name,
            'companyLogo' => $company->image,
        ];

        return view('role_edit', $data);
    }

    public function update(Request $request, $name)
    {
        $role = $this->roleService->getOne($name);
        $request->validate(
            [
                'name' => [
                    'required',
                    Rule::unique('roles')->ignore($role->id),
                ]
            ],
            [
                'required' => 'Kolom ini harus diisi!',
                'unique' => 'Kode barang sudah ada!',
            ]
        );

        try {
            $this->roleService->update($name, $role);
            return redirect('/roles')->with('success', 'Ubah role berhasil!');
        } catch(QueryException $ex) {
            return redirect('/roles')->with('error', 'Ubah role gagal!');
        }
    }

    public function destroy($name)
    {
        try {
            $this->roleService->delete($name);
            return redirect('/roles')->with('success', 'Penghapusan role berhasil!');
        } catch(QueryException $ex) {
            return redirect('/roles')->with('error', 'Penghapusan role gagal!');
        }
    }
}
