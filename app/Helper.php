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
    public static function getCurrentDate()
    {
        $dateMin = date("Y-m-d 00:00:00");
        $dateMax = date("Y-m-d 23:59:59");
        if (request()->input("dateMin") && request()->input("dateMin")) {
            $dateMin = strval(request()->input("dateMin")) . " 00:00:00";
            $dateMax = strval(request()->input("dateMax")) . " 23:59:59";
        }

        return [$dateMin, $dateMax];
    }

    public static function getCommonData()
    {
        $user = UserService::getUserLogin(request()->session()->get('username'));
        $company = CompanyProfileService::getOne();
        $menus = MenuService::getByRoleId(request()->session()->get('role_id'));

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
        $role_id = $request->session()->get('role_id');
        $menus = Menu::where('role_id', '>=', $role_id)->get();
        return $menus;
    }

    public static function uploadfile($imgName)
    {
        request()->image->storeAs('./public/img', $imgName);
    }
}