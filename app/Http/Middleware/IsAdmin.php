<?php

namespace App\Http\Middleware;

use App\Helper;
use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->get('username')) {
            return redirect('/login')->with('error', 'Anda belum login!');
        }

        $user = Helper::getUserLogin($request);
        if ($user->role_id != 1) {
            return redirect('/')->with('error', 'Tidak bisa mengakses selain admin!');
        }

        return $next($request);
    }
}
