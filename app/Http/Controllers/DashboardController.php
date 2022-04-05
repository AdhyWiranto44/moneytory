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
        [ $dateMin, $dateMax ] = $this->helper->getDate();

        // Arahkan ke halaman pendaftaran jika perusahaan belum terdaftar
        if ($company == null) return redirect('/welcome');

        $incomes = $this->incomeService->getPriceSumByDate($dateMin, $dateMax);
        $expenses = $this->expenseService->getCostSUmByDate($dateMin, $dateMax);
        $debts = $this->debtService->getPriceSumByDate($dateMin, $dateMax);
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
