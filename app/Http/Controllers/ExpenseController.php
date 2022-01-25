<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $user = Helper::getUserLogin($request);
        $company = Helper::getCompanyProfile();
        $expenses = Expense::all();
        $menus = Helper::getMenus($request);
        $data = [
            'title' => 'Pengeluaran',
            'menus' => $menus,
            'expenses' => $expenses,
            'username' => $user->username,
            'userImage' => $user->image,
            'companyName' => $company->name,
            'companyLogo' => $company->image,
        ];
        return view('expenses', $data);
    }
}
