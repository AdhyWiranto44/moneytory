<?php

namespace App\Http\Controllers;

use App\Facades\CompanyProfileService;
use App\Facades\ExpenseService;
use App\Facades\IncomeService;
use App\Facades\DebtService;
use App\Facades\MenuService;
use App\Facades\UserService;
use App\Helper;
use App\Models\CompanyProfile;
use App\Models\Debt;
use App\Models\Expense;
use App\Models\Income;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        /** 
         * Halaman sambutan untuk registrasi perusahaan
         * Akan tampil secara otomatis
         * Saat membuka root route
         * Dan belum ada data profil perusahaan di database
         */
        $companyProfile = CompanyProfileService::getOne();
        if ($companyProfile == null) return redirect('/welcome');
        
        [$dateMin, $dateMax] = Helper::getCurrentDate();
        if ($request->query('tanggal_dari') && $request->query('tanggal_ke') == '') {
            $dateMin = $request->query('tanggal_dari') . ' 00:00:00';
        } else if ($request->query('tanggal_dari') == '' && $request->query('tanggal_ke')) {
            $dateMax = $request->query('tanggal_ke') . ' 23:59:59';
        } else if ($request->query('tanggal_dari') && $request->query('tanggal_ke')) {
            $dateMin = $request->query('tanggal_dari') . ' 00:00:00';
            $dateMax = $request->query('tanggal_ke') . ' 23:59:59';
        }
        $incomes = IncomeService::getByDate($dateMin, $dateMax);
        $expenses = ExpenseService::getByDate($dateMin, $dateMax);
        $debts = DebtService::getByDate($dateMin, $dateMax);

        $user = UserService::getUserLogin($request->session()->get('username'));
        $company = CompanyProfileService::getOne();
        $menus = MenuService::getByRoleId($request->session()->get('role_id'));
        $data = [
            'title' => 'Dashboard',
            'menus' => $menus,
            'username' => $user->username,
            'userImage' => $user->image,
            'companyName' => $company->name,
            'companyLogo' => $company->image,
            'incomes' => $incomes,
            'expenses' => $expenses,
            'debts' => $debts,
        ];
        return view('dashboard', $data);
    }
}
