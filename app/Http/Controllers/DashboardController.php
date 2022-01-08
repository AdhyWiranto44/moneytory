<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->session()->get('username')) {
            return redirect('/login');
        }

        $username = User::firstWhere('username', $request->session()->get('username'))->username;
        $data = [
            'username' => $username
        ];
        return view('dashboard', $data);
    }
}
