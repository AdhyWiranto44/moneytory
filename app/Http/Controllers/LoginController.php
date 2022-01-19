<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $companyProfile = CompanyProfile::first();
        if ($companyProfile == null) {
            return redirect('/welcome');
        }

        if ($request->session()->get('username')) {
            return redirect('/');
        }

        $data = [
            'title' => 'Login'
        ];
        return view('login', $data);
    }

    public function login(Request $request)
    {
        $request->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ],
            [
                'required' => 'Kolom ini harus diisi!'
            ]
        );

        $username = $request->input('username');
        $password = $request->input('password');
        $userData = User::firstWhere('username', $username);

        if (!$userData) {
            return redirect(url()->previous())->with('error', 'Username / password salah!');
        } 
        
        if($userData->status_id == 1) {
            return redirect('/login')->with('error', 'Akun tersebut tidak aktif!');
        }
        
        if (
            $username == $userData['username'] 
            && Hash::check($password, $userData['password'])
        ) {
            $request->session()->put([
                'username' => $username, 
                'role_id' => $userData['role_id']
            ]);
            return redirect('/')->with('success', 'Login berhasil!');
        } else {
            return redirect('/login')->with('error', 'Username / password salah!');
        }
    }
}
