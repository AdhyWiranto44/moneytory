<?php

namespace App\Http\Controllers;

use App\Facades\ExpenseService;
use App\Facades\IncomeService;
use App\Facades\DebtService;
use App\Helper;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->expenseService = new ExpenseService();
        $this->incomeService = new IncomeService();
        $this->debtService = new DebtService();
        $this->helper = new Helper();
    }

    public function index(Request $request)
    {
        /** 
         * Halaman sambutan untuk registrasi perusahaan
         * Akan tampil secara otomatis
         * Saat membuka root route
         * Dan belum ada data profil perusahaan di database
         */
        [ $user, $company, $menus ] = $this->helper->getCommonData();
        [ $dateMin, $dateMax ] = $this->helper->getCurrentDate();
        $incomes = $this->incomeService->getPriceSumByDate($dateMin, $dateMax);
        $expenses = $this->expenseService->getCostSUmByDate($dateMin, $dateMax);
        $debts = $this->debtService->getPriceSumByDate($dateMin, $dateMax);

        // Arahkan ke halaman pendaftaran jika perusahaan belum terdaftar
        if ($company == null) return redirect('/welcome');
        
        // Mendapatkan tanggal
        if ($request->query('tanggal_dari') && $request->query('tanggal_ke') == '') {
            $dateMin = $request->query('tanggal_dari') . ' 00:00:00';
        } else if ($request->query('tanggal_dari') == '' && $request->query('tanggal_ke')) {
            $dateMax = $request->query('tanggal_ke') . ' 23:59:59';
        } else if ($request->query('tanggal_dari') && $request->query('tanggal_ke')) {
            $dateMin = $request->query('tanggal_dari') . ' 00:00:00';
            $dateMax = $request->query('tanggal_ke') . ' 23:59:59';
        }

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
