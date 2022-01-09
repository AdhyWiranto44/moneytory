<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        /** 
         * Halaman sambutan untuk registrasi perusahaan
         * Akan tampil secara otomatis
         * Saat membuka root route
         * Dan belum ada data profil perusahaan di database
         */
        $companyProfile = CompanyProfile::first();
        if ($companyProfile == null) {
            return redirect('/welcome');
        }

        /**
         * Redirect ke halaman login jika belum login
         */
        if (!$request->session()->get('username')) {
            return redirect('/login');
        }

        $username = User::firstWhere('username', $request->session()->get('username'))->username;
        $data = [
            'username' => $username
        ];
        return view('dashboard', $data);
    }
}
