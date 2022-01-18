<?php

namespace App\Http\Controllers;

use App\Helper;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $user = Helper::getUserLogin($request);
        $company = Helper::getCompanyProfile();
        $data = [
            'title' => 'Pengaturan',
            'username' => $user->username,
            'userImage' => $user->image,
            'companyName' => $company->name,
            'companyPhoneNumber' => $company->phone_number,
            'companyEmail' => $company->email,
            'companyAddress' => $company->address,
            'companyLogo' => $company->image,
        ];
        return view('setting', $data);
    }
}
