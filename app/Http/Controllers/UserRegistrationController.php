<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\CompanyProfile;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserRegistrationController extends Controller
{
    public function index(Request $request)
    {
        $companyProfile = CompanyProfile::first();
        if ($companyProfile == null) {
            return redirect('/welcome');
        }
        
        $roles = Role::all();
        $user = Helper::getUserLogin($request);
        $company = Helper::getCompanyProfile();
        $data = [
            'title' => 'Registrasi Pengguna',
            'roles' => $roles,
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
                'full_name' => 'required',
                'phone_number' => 'required|min:8|max:14',
                'username' => 'required|min:5|unique:users',
                'password' => 'required|min:8',
                'password_confirmation' => 'required|same:password',
                'role' => 'required',
            ],
            [
                'required' => 'Kolom ini harus diisi!',
                'min' => 'Kolom ini harus berisi minimal :min karakter!',
                'unique' => 'Username sudah ada!',
                'max' => 'Kolom ini harus berisi maximal :max karakter!',
                'same' => 'Kolom konfirmasi password tidak sama!'
            ]
        );

        try {
            $user = User::create([
                'role_id' => $request->input('role'),
                'status_id' => 2,
                'username' => $request->input('username'),
                'password' => Hash::make($request->input('password'), ['rounds' => 10]),
                'name' => $request->input('full_name'),
                'phone_number' => $request->input('phone_number'),
                'email' => $request->input('email'),
                'address' => $request->input('address'),
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $user->save();
    
            return redirect('/users')->with('success', 'Registrasi Berhasil!');
        } catch(QueryException $ex) {
            return redirect('/users')->with('error', 'Registrasi Gagal!');
        }
    }
}
