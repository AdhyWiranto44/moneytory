<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $user = Helper::getUserLogin($request);
        $company = Helper::getCompanyProfile();
        $products = DB::table('products')
                ->join('statuses', 'products.status_id', '=', 'statuses.id')
                ->join('units', 'products.unit_id', '=', 'units.id')
                ->select('products.*', 'statuses.name as status', 'units.name as unit')
                ->get();
        $menus = $this->getMenus($request);
        $data = [
            'title' => 'Barang Jadi',
            'menus' => $menus,
            'products' => $products,
            'username' => $user->username,
            'userImage' => $user->image,
            'companyName' => $company->name,
            'companyLogo' => $company->image,
        ];
        return view('products', $data);
    }

    public function deactivate(Request $request, $code)
    {
        $status = 1;
        Product::where('code', $code)->update(['status_id' => $status]);
        return redirect('/products');
    }

    public function activate(Request $request, $code)
    {
        $status = 2;
        Product::where('code', $code)->update(['status_id' => $status]);
        return redirect('/products');
    }

    private function getMenus(Request $request)
    {
        $menus = Helper::getMenus($request);
        return $menus;
    }
}
