<?php

namespace App\Http\Controllers;

use App\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DebtController extends Controller
{
    public function index(Request $request)
    {
        $user = Helper::getUserLogin($request);
        $company = Helper::getCompanyProfile();
        $debts = DB::table('debts')
                ->join('debt_types', 'debts.debt_type_id', '=', 'debt_types.id')
                ->join('debt_statuses', 'debts.debt_status_id', '=', 'debt_statuses.id')
                ->select('debts.*', 'debt_types.name as type', 'debt_statuses.name as status')
                ->get();
        $menus = Helper::getMenus($request);
        $data = [
            'title' => 'Hutang',
            'menus' => $menus,
            'debts' => $debts,
            'username' => $user->username,
            'userImage' => $user->image,
            'companyName' => $company->name,
            'companyLogo' => $company->image,
        ];
        return view('debts', $data);
    }
}
