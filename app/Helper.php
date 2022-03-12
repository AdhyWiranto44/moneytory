<?php

namespace App;

use App\Facades\CompanyProfileService;
use App\Facades\MenuService;
use App\Facades\UserService;
use App\Models\CompanyProfile;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;

class Helper
{
    public function getCurrentDate()
    {
        $dateMin = date("Y-m-d 00:00:00");
        $dateMax = date("Y-m-d 23:59:59");
        if (request()->input("dateMin") && request()->input("dateMin")) {
            $dateMin = strval(request()->input("dateMin")) . " 00:00:00";
            $dateMax = strval(request()->input("dateMax")) . " 23:59:59";
        }

        return [$dateMin, $dateMax];
    }

    public function getCommonData()
    {
        $user = new UserService();
        $company = new CompanyProfileService();
        $menus = new MenuService();
        
        $user = $user->getOne(request()->session()->get('username'));
        $company = $company->getOne();
        $menus = $menus->getByRoleId(request()->session()->get('role_id'));

        return [ $user, $company, $menus ];
    }

    public static function getUserLogin(Request $request)
    {
        $user = User::firstWhere('username', $request->session()->get('username'));
        return $user;
    }

    public static function getCompanyProfile()
    {
        $company = CompanyProfile::first();
        return $company;
    }

    public static function getMenus(Request $request)
    {
        $menus = new MenuService();
        $menus = $menus->getByRoleId(request()->session()->get('role_id'));
        return $menus;
        
        // $role_id = $request->session()->get('role_id');
        // $menus = Menu::where('role_id', '>=', $role_id)->get();
        // return $menus;
    }

    public function uploadFile($imgName)
    {
        request()->image->storeAs('./public/img', $imgName);
    }

    public function createImageName()
    {
        $name = strtotime('now') . '-' . preg_replace('/\s+/', '-', request()->image->getClientOriginalName());
        return $name;
    }
}