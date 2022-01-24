<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IncomeController extends Controller
{
    public function index(Request $request)
    {
        $user = Helper::getUserLogin($request);
        $company = Helper::getCompanyProfile();
        $incomes = DB::table('incomes')
                        ->join('income_statuses', 'incomes.income_status_id', '=', 'income_statuses.id')
                        ->select('incomes.*', 'income_statuses.name as status')
                        ->get();
        $menus = Helper::getMenus($request);
        $data = [
            'title' => 'Pemasukan',
            'menus' => $menus,
            'incomes' => $incomes,
            'username' => $user->username,
            'userImage' => $user->image,
            'companyName' => $company->name,
            'companyLogo' => $company->image,
        ];
        return view('incomes', $data);
    }

    public function deactivate(Request $request, $code)
    {
        $status = 1;
        Income::where('code', $code)->update(['income_status_id' => $status]);
        return redirect('/incomes');
    }

    public function activate(Request $request, $code)
    {
        $status = 2;
        Income::where('code', $code)->update(['income_status_id' => $status]);
        return redirect('/incomes');
    }
}
