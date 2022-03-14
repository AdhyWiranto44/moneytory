<?php

namespace App\Http\Middleware;

use App\Facades\MenuService;
use App\Facades\UserService;
use App\Models\Privilege;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class IsLoggedIn
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
        /**
         * Redirect ke halaman login jika belum login
         */
        if (!$request->session()->get('username')) {
            return redirect('/login')->with('error', 'Anda belum login!');
        }

        $routeName = Route::currentRouteName();

        if ($routeName) {
            $user = new UserService();
            $menu = new MenuService();

            $user = $user->getOne($request->session()->get('username'));
            $menu = $menu->getOne($routeName);

            $privilege = Privilege::firstWhere([
                'role_id' => $user->role_id,
                'menu_id' => $menu->id,
            ]);

            if ($privilege == null) {
                return redirect('/settings')->with('error', 'Tidak memiliki hak akses!');
            }
        }
        
        return $next($request);
    }
}
