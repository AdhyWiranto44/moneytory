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
        $menus = Helper::getMenus($request);
        $data = [
            'title' => 'Pengaturan',
            'menus' => $menus,
            'username' => $user->username,
            'userFullName' => $user->name,
            'userPhoneNumber' => $user->phone_number,
            'userEmail' => $user->email,
            'userAddress' => $user->address,
            'userImage' => $user->image,
            'userRole' => $user->role_id,
            'companyName' => $company->name,
            'companyPhoneNumber' => $company->phone_number,
            'companyEmail' => $company->email,
            'companyAddress' => $company->address,
            'companyLogo' => $company->image,
        ];
        return view('setting', $data);
    }
}
