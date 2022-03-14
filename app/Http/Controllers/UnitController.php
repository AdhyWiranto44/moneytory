<?php

namespace App\Http\Controllers;

use App\Facades\RoleService;
use App\Facades\UnitService;
use App\Facades\UserService;
use App\Helper;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UnitController extends Controller
{
    public function __construct()
    {
        $this->userService = new UserService();
        $this->roleService = new RoleService();
        $this->helper = new Helper();
        $this->unitService = new UnitService();
    }
    
    public function index()
    {
        [ $user, $company, $menus ] = $this->helper->getCommonData();
        $units = $this->unitService->getAll();
        $data = [
            'title' => 'Satuan',
            'units' => $units,
            'menus' => $menus,
            'username' => $user->username,
            'userImage' => $user->image,
            'companyName' => $company->name,
            'companyLogo' => $company->image,
        ];
        return view('units', $data);
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
        return view('unit_add', $data);
    }

    public function store(Request $request)
    {
        $request->validate(
            [ 'name' => 'required|unique:units' ],
            [
                'required' => 'Kolom ini harus diisi!',
                'unique' => 'Satuan sudah ada!',
            ]
        );

        try {
            $this->unitService->insert();
            return redirect('/units')->with('success', 'Tambah Satuan Berhasil!');
        } catch(QueryException $ex) {
            return redirect('/units')->with('error', 'Tambah Satuan Gagal!');
        }
    }

    public function edit($name)
    {
        [ $user, $company, $menus ] = $this->helper->getCommonData();
        $unit = $this->unitService->getOne($name);
        $data = [
            'title' => 'Ubah',
            'unit' => $unit,
            'menus' => $menus,
            'username' => $user->username,
            'userImage' => $user->image,
            'companyName' => $company->name,
            'companyLogo' => $company->image,
        ];

        return view('unit_edit', $data);
    }

    public function update(Request $request, $name)
    {
        $unit = $this->unitService->getOne($name);
        $request->validate(
            [
                'name' => [
                    'required',
                    Rule::unique('units')->ignore($unit->id),
                ]
            ],
            [
                'required' => 'Kolom ini harus diisi!',
                'unique' => 'Satuan sudah ada!',
            ]
        );

        try {
            $this->unitService->update($name, $unit);
            return redirect('/units')->with('success', 'Ubah satuan berhasil!');
        } catch(QueryException $ex) {
            return redirect('/units')->with('error', 'Ubah satuan gagal!');
        }
    }

    public function destroy($name)
    {
        try {
            $this->unitService->delete($name);
            return redirect('/units')->with('success', 'Penghapusan satuan berhasil!');
        } catch(QueryException $ex) {
            return redirect('/units')->with('error', 'Penghapusan satuan gagal!');
        }
    }
}
