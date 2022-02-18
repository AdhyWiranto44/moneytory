<?php

namespace App\Http\Controllers;

use App\Facades\RoleService;
use App\Facades\UserService;
use App\Helper;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
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
        $users = $this->userService->getAllWithoutUserLogin($user->username);
        $data = [
            'title' => 'Pengguna',
            'users' => $users,
            'menus' => $menus,
            'username' => $user->username,
            'userImage' => $user->image,
            'companyName' => $company->name,
            'companyLogo' => $company->image,
        ];
        return view('users', $data);
    }

    public function create()
    {
        [ $user, $company, $menus ] = $this->helper->getCommonData();
        $roles = $this->roleService->getAll();
        $data = [
            'title' => 'Registrasi Pengguna',
            'roles' => $roles,
            'menus' => $menus,
            'username' => $user->username,
            'userImage' => $user->image,
            'companyName' => $company->name,
            'companyLogo' => $company->image,
        ];
        return view('user_registration', $data);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'phone_number' => 'required|min:8|max:14',
                'username' => 'required|min:5|unique:users',
                'password' => 'required|min:8',
                'password_confirmation' => 'required|same:password',
                'role' => 'required',
                'image' => 'image|max:1024'
            ],
            [
                'required' => 'Kolom ini harus diisi!',
                'min' => 'Kolom ini harus berisi minimal :min karakter!',
                'unique' => 'Username sudah ada!',
                'phone_number.max' => 'Kolom ini harus berisi maximal :max karakter!',
                'same' => 'Kolom konfirmasi password tidak sama!',
                'image.image' => 'File harus berupa gambar (jpg, jpeg, dan png)',
                'image.max' => 'Ukuran gambar maksimal yang diterima adalah sebesar :max MB'
            ]
        );

        try {
            $this->userService->insert();    
            return redirect('/users')->with('success', 'Registrasi Berhasil!');
        } catch(QueryException $ex) {
            return redirect('/users')->with('error', 'Registrasi Gagal!');
        }
    }

    public function deactivate(Request $request, $username)
    {
        if ($username == $request->session()->get('username')) {
            return redirect('/users')->with('error', 'Tidak bisa mengganti status diri sendiri!');
        }

        $status = 1;
        $this->userService->changeStatus($username, $status);
        return redirect('/users');
    }

    public function activate(Request $request, $username)
    {
        if ($username == $request->session()->get('username')) {
            return redirect('/users')->with('error', 'Tidak bisa mengganti status diri sendiri!');
        }

        $status = 2;
        $this->userService->changeStatus($username, $status);
        return redirect('/users');
    }

    public function destroy($username)
    {
        try {
            $this->userService->delete($username);
            return redirect('/users')->with('success', 'Penghapusan pengguna berhasil!');
        } catch(QueryException $ex) {
            return redirect('/users')->with('error', 'Penghapusan pengguna gagal!');
        }
    }

    public function edit($username)
    {
        [ $user, $company, $menus ] = $this->helper->getCommonData();
        $roles = $this->roleService->getAll();
        $userUpdate = $this->userService->getOne($username);
        $data = [
            'title' => 'Ubah Pengguna',
            'roles' => $roles,
            'menus' => $menus,
            'userUpdate' => $userUpdate,
            'username' => $user->username,
            'userImage' => $user->image,
            'companyName' => $company->name,
            'companyLogo' => $company->image,
        ];

        return view('user_edit', $data);
    }

    public function update(Request $request, $username)
    {
        $user = $this->userService->getOne($username);
        $request->validate(
            [
                'name' => 'required',
                'phone_number' => 'required|min:8|max:14',
                'role_id' => 'required',
                'username' => [
                    'required',
                    'min:5',
                    Rule::unique('users')->ignore($user->id),
                ],
                'image' => 'image|max:1024'
            ],
            [
                'required' => 'Kolom ini harus diisi!',
                'min' => 'Kolom ini harus berisi minimal :min karakter!',
                'unique' => 'Username sudah ada!',  
                'phone_number.max' => 'Kolom ini harus berisi maximal :max karakter!',
                'image.image' => 'File harus berupa gambar (jpg, jpeg, dan png)',
                'image.max' => 'Ukuran gambar maksimal yang diterima adalah sebesar :max MB'
            ]
        );

        try {
            $this->userService->update($username, $user);
            return redirect('/users')->with('success', 'Ubah pengguna berhasil!');
        } catch(QueryException $ex) {
            return redirect('/users')->with('error', 'Ubah pengguna gagal!');
        }
    }

    public function updatePassword(Request $request, $username)
    {
        $request->validate(
            [
                'password' => 'required|min:8',
                'password_confirmation' => 'required|same:password',
            ],
            [
                'required' => 'Kolom ini harus diisi!',
                'min' => 'Kolom ini harus berisi minimal :min karakter!',
                'same' => 'Kolom konfirmasi password tidak sama!',
            ]
        );

        try {
            $this->userService->updatePassword($username);
            return redirect('/users')->with('success', 'Ubah Password Berhasil!');
        } catch(QueryException $ex) {
            return redirect('/users')->with('error', 'Ubah Password Gagal!');
        }
    }

    public function editProfile($username)
    {
        [ $user, $company, $menus ] = $this->helper->getCommonData();
        $roles = $this->roleService->getAll();
        $userUpdate = $this->userService->getOne($username);
        $data = [
            'title' => 'Ubah Pengguna',
            'roles' => $roles,
            'menus' => $menus,
            'userUpdate' => $userUpdate,
            'username' => $user->username,
            'userImage' => $user->image,
            'companyName' => $company->name,
            'companyLogo' => $company->image,
        ];

        return view('user_profile_edit', $data);
    }

    public function updateProfile(Request $request, $username)
    {
        $user = $this->userService->getOne($username);
        $request->validate(
            [
                'name' => 'required',
                'phone_number' => 'required|min:8|max:14',
                'username' => [
                    'required',
                    'min:5',
                    Rule::unique('users')->ignore($user->id),
                ],
                'image' => 'image|max:1024'
            ],
            [
                'required' => 'Kolom ini harus diisi!',
                'min' => 'Kolom ini harus berisi minimal :min karakter!',
                'unique' => 'Username sudah ada!',  
                'phone_number.max' => 'Kolom ini harus berisi maximal :max karakter!',
                'image.image' => 'File harus berupa gambar (jpg, jpeg, dan png)',
                'image.max' => 'Ukuran gambar maksimal yang diterima adalah sebesar :max MB'
            ]
        );

        try {
            $this->userService->update($username, $user);
            return redirect('/settings')->with('success', 'Ubah profil pengguna berhasil!');
        } catch(QueryException $ex) {
            return redirect('/settings')->with('error', 'Ubah profil pengguna gagal!');
        }
    }

    public function updateProfilePassword(Request $request, $username)
    {
        $request->validate(
            [
                'password' => 'required|min:8',
                'password_confirmation' => 'required|same:password',
            ],
            [
                'required' => 'Kolom ini harus diisi!',
                'min' => 'Kolom ini harus berisi minimal :min karakter!',
                'same' => 'Kolom konfirmasi password tidak sama!',
            ]
        );

        try {
            $this->userService->updatePassword($username);
            $request->session()->flush();
            return redirect('/login')->with('success', 'Ubah password berhasil! Silakan login kembali.');
        } catch(QueryException $ex) {
            return redirect('/settings')->with('error', 'Ubah password gagal!');
        }
    }
}
