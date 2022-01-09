<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class CompanyRegistrationController extends Controller
{
    public function index()
    {
        return view('company_registration');
    }
}
