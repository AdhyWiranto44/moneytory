<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\CompanyProfile;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = DB::table('users')
                ->join('roles', 'users.role_id', '=', 'roles.id')
                ->join('statuses', 'users.status_id', '=', 'statuses.id')
                ->select('users.*', 'roles.name as role_name', 'statuses.name as status_name')
                ->get();
        $user = Helper::getUserLogin($request);
        $company = Helper::getCompanyProfile();
        $data = [
            'title' => 'Pengguna',
            'users' => $users,
            'username' => $user->username,
            'userImage' => $user->image,
            'companyName' => $company->name,
            'companyLogo' => $company->image,
        ];
        return view('users', $data);
    }
}
