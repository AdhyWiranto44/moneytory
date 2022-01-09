<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $companyProfile = CompanyProfile::first();
        if ($companyProfile == null) {
            return view('welcome');
        }

        if (!$request->session()->get('username')) {
            return redirect('/login');
        }

        $company = CompanyProfile::first();
        $username = User::firstWhere('username', $request->session()->get('username'))->username;
        $data = [
            'username' => $username,
            'companyName' => $company->name,
            'companyLogo' => $company->image,
        ];
        return view('dashboard', $data);
    }
}
