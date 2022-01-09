<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $companyProfile = CompanyProfile::first();
        if ($companyProfile != null) {
            return redirect('/login');
        }
        return view('welcome');
    }
}
