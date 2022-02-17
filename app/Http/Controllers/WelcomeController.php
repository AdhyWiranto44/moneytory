<?php

namespace App\Http\Controllers;

use App\Facades\CompanyProfileService;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $this->companyProfileService = new CompanyProfileService();
        $isCompanyRegistered = $this->companyProfileService->isCompanyUnregistered();
        if (!$isCompanyRegistered) return redirect('/login');

        $data = [
            'title' => 'Welcome Page'
        ];
        return view('welcome', $data);
    }
}
