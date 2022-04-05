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
    public function getDate()
    {
        $dateMin = date("Y-m-d 00:00:00");
        $dateMax = date("Y-m-d 23:59:59");

        if (request()->query('tanggal_dari') && request()->query('tanggal_ke') == '') {
          $dateMin = request()->query('tanggal_dari') . ' 00:00:00';
        } else if (request()->query('tanggal_dari') == '' && request()->query('tanggal_ke')) {
            $dateMax = request()->query('tanggal_ke') . ' 23:59:59';
        } else if (request()->query('tanggal_dari') && request()->query('tanggal_ke')) {
            $dateMin = request()->query('tanggal_dari') . ' 00:00:00';
            $dateMax = request()->query('tanggal_ke') . ' 23:59:59';
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

    public static function getMenus()
    {
        $menus = new MenuService();
        $menus = $menus->getByRoleId(request()->session()->get('role_id'));
        return $menus;
    }

    public function uploadFile($imageName)
    {
      if (request()->image && $imageName != null) {
        request()->image->storeAs('./public/img', $imageName);
      }
    }

    public function createImageName()
    {
      $imageName = null;

      if (request()->image != null) {
        $imageName = strtotime('now') . '-' . preg_replace('/\s+/', '-', request()->image->getClientOriginalName());
      }

      return $imageName;
    }

    public function generateCode($prefix, $lastRow)
    {
        $nextId = 1;
        if ($lastRow != null) $nextId = $lastRow->id + 1;
        $newCode = $prefix . $nextId;
        
        return $newCode;
    }
}