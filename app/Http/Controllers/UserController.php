<?php

namespace App\Http\Controllers;

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
    public function index(Request $request)
    {   
        $user = Helper::getUserLogin($request);
        $company = Helper::getCompanyProfile();
        $users = DB::table('users')
                ->join('roles', 'users.role_id', '=', 'roles.id')
                ->join('statuses', 'users.status_id', '=', 'statuses.id')
                ->select('users.*', 'roles.name as role_name', 'statuses.name as status_name')
                ->where('users.username', '!=', $user->username)
                ->get();
        $menus = $this->getMenus($request);
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

    public function create(Request $request)
    {
        $roles = Role::all();
        $user = Helper::getUserLogin($request);
        $company = Helper::getCompanyProfile();
        $menus = $this->getMenus($request);
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
            $formInput = [
                'role_id' => $request->input('role'),
                'status_id' => 2,
                'username' => $request->input('username'),
                'password' => Hash::make($request->input('password'), ['rounds' => 10]),
                'name' => $request->input('name'),
                'phone_number' => $request->input('phone_number'),
                'email' => $request->input('email'),
                'address' => $request->input('address'),
                'created_at' => now(),
                'updated_at' => now()
            ];

            // Kalau ada gambar yang di-upload
            if ($request->image) {
                $imgName = strtotime('now') . '-' . preg_replace('/\s+/', '-', $request->image->getClientOriginalName());
                $formInput['image'] = $imgName;
                $request->image->storeAs('./public/img', $imgName);
            }

            $user = User::create($formInput);
            $user->save();
    
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
        User::where('username', $username)->update(['status_id' => $status]);
        return redirect('/users');
    }

    public function activate(Request $request, $username)
    {
        if ($username == $request->session()->get('username')) {
            return redirect('/users')->with('error', 'Tidak bisa mengganti status diri sendiri!');
        }

        $status = 2;
        User::where('username', $username)->update(['status_id' => $status]);
        return redirect('/users');
    }

    public function destroy($username)
    {
        try {
            User::where('username', $username)->delete();
            return redirect('/users')->with('success', 'Penghapusan pengguna berhasil!');
        } catch(QueryException $ex) {
            return redirect('/users')->with('error', 'Penghapusan pengguna gagal!');
        }
    }

    public function edit(Request $request, $username)
    {
        $userUpdate = User::firstWhere('username', $username);
        $user = Helper::getUserLogin($request);
        $company = Helper::getCompanyProfile();
        $roles = Role::all();
        $menus = $this->getMenus($request);
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
        $user = User::firstWhere('username', $username);
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
            $formInput = [
                'role_id' => $request->input('role_id') != null ? $request->input('role_id') : $user->role_id,
                'username' => $request->input('username') != null ? $request->input('username') : $user->username,
                'name' => $request->input('name') != null ? $request->input('name') : $user->name,
                'phone_number' => $request->input('phone_number') != null ? $request->input('phone_number') : $user->phone_number,
                'email' => $request->input('email') != null ? $request->input('email') : $user->email,
                'address' => $request->input('address') != null ? $request->input('address') : $user->address,
                'updated_at' => now()
            ];
    
            // Kalau ada gambar yang di-upload
            if ($request->image) {
                $imgName = strtotime('now') . '-' . preg_replace('/\s+/', '-', $request->image->getClientOriginalName());
                $formInput['image'] = $imgName;
                $request->image->storeAs('./public/img', $imgName);
            }
    
            User::where('username', $username)->update($formInput);
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
            $formInput = [
                'password' => Hash::make($request->input('password'), ['rounds' => 10]),
                'updated_at' => now()
            ];

            User::where('username', $username)->update($formInput);
            return redirect('/users')->with('success', 'Ubah Password Berhasil!');
        } catch(QueryException $ex) {
            return redirect('/users')->with('error', 'Ubah Password Gagal!');
        }
    }

    public function editProfile(Request $request, $username)
    {
        $userUpdate = User::firstWhere('username', $username);
        $user = Helper::getUserLogin($request);
        $company = Helper::getCompanyProfile();
        $menus = $this->getMenus($request);
        $data = [
            'title' => 'Ubah Profil Pengguna',
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
        $user = User::firstWhere('username', $username);
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
            $formInput = [
                'username' => $request->input('username') != null ? $request->input('username') : $user->username,
                'name' => $request->input('name') != null ? $request->input('name') : $user->name,
                'phone_number' => $request->input('phone_number') != null ? $request->input('phone_number') : $user->phone_number,
                'email' => $request->input('email') != null ? $request->input('email') : $user->email,
                'address' => $request->input('address') != null ? $request->input('address') : $user->address,
                'updated_at' => now()
            ];
    
            // Kalau ada gambar yang di-upload
            if ($request->image) {
                $imgName = strtotime('now') . '-' . preg_replace('/\s+/', '-', $request->image->getClientOriginalName());
                $formInput['image'] = $imgName;
                $request->image->storeAs('./public/img', $imgName);
            }
    
            User::where('username', $username)->update($formInput);
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
            $formInput = [
                'password' => Hash::make($request->input('password'), ['rounds' => 10]),
                'updated_at' => now()
            ];
            User::where('username', $username)->update($formInput);

            // Hapus session login
            $request->session()->flush();
            return redirect('/login')->with('success', 'Ubah password berhasil! Silakan login kembali.');
        } catch(QueryException $ex) {
            return redirect('/settings')->with('error', 'Ubah password gagal!');
        }
    }

    private function getMenus(Request $request)
    {
        $menus = Helper::getMenus($request);
        return $menus;
    }
}
