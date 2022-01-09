<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use App\Models\Role;
use Illuminate\Http\Request;

class UserRegistrationController extends Controller
{
    public function index()
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
