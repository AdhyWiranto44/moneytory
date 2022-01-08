<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function registerCompany()
    {
        return view('company_registration');
    }

    public function registerUser()
    {
        return view('user_registration');
    }
}
