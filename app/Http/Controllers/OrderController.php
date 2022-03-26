<?php

namespace App\Http\Controllers;

use App\Facades\ProductService;
use App\Facades\RoleService;
use App\Facades\UserService;
use App\Helper;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->userService = new UserService();
        $this->roleService = new RoleService();
        $this->helper = new Helper();
        $this->productService = new ProductService();
    }

    public function index()
    {
        [ $user, $company, $menus ] = $this->helper->getCommonData();
        $products = $this->productService->getAllIfStockAvailable();
        $data = [
            'title' => 'Order',
            'products' => $products,
            'menus' => $menus,
            'username' => $user->username,
            'userImage' => $user->image,
            'companyName' => $company->name,
            'companyLogo' => $company->image,
        ];
        return view('order_page', $data);
    }
}
