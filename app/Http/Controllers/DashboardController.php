<?php

namespace App\Http\Controllers;

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
        $companyProfile = CompanyProfile::first();
        if ($companyProfile == null) {
            return redirect('/welcome');
        }
        
        [$dateMin, $dateMax] = Helper::getCurrentDate();
        if ($request->query('tanggal_dari') && $request->query('tanggal_ke') == '') {
            $dateMin = $request->query('tanggal_dari') . ' 00:00:00';
        } else if ($request->query('tanggal_dari') == '' && $request->query('tanggal_ke')) {
            $dateMax = $request->query('tanggal_ke') . ' 23:59:59';
        } else if ($request->query('tanggal_dari') && $request->query('tanggal_ke')) {
            $dateMin = $request->query('tanggal_dari') . ' 00:00:00';
            $dateMax = $request->query('tanggal_ke') . ' 23:59:59';
        }
        $incomes = $this->getIncome($dateMin, $dateMax);
        $expenses = $this->getExpense($dateMin, $dateMax);
        $debts = $this->getDebt($dateMin, $dateMax);
        

        $user = Helper::getUserLogin($request);
        $company = Helper::getCompanyProfile();
        $menus = Helper::getMenus($request);
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

    private function getIncome($from, $to)
    {
        $incomes = Income::where([["income_status_id", "=", 2], ["created_at", ">=", $from], ["created_at", "<=", $to]])->sum('total_price');

        return $incomes;
    }

    private function getExpense($from, $to)
    {
        $expenses = Expense::where([["created_at", ">=", $from], ["created_at", "<=", $to]])->sum('cost');

        return $expenses;
    }

    private function getDebt($from, $to)
    {
        $debts = Debt::where([["debt_status_id", "=", 2], ["created_at", ">=", $from], ["created_at", "<=", $to]])->sum('price');

        return $debts;
    }
}
