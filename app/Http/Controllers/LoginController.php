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
        return view('login');
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

        if ($username == $userData['username'] && Hash::check($password, $userData['password'])) {
            $request->session()->put('username', $username);
            return redirect('/');
        } else {
            return redirect('/login')->with('error', 'Username / password salah!');
        }
    }
}
