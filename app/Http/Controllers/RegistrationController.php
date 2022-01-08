<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use App\Models\Role;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function registerCompany()
    {
        return view('company_registration');
    }

    public function registerUser()
    {
        $companyProfile = CompanyProfile::first();
        if ($companyProfile == null) {
            return redirect('/registration/company');
        }
        
        $roles = Role::all();
        $data = [
            'roles' => $roles
        ];
        return view('user_registration', $data);
    }
}
