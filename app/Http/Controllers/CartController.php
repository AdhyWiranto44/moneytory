<?php

namespace App\Http\Controllers;

use App\Facades\ProductService;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Exception\SessionNotFoundException;

class CartController extends Controller
{
    public function __construct()
    {
        $this->productService = new ProductService();
    }

    public function index(Request $request) {
        $sessionCart = $request->session()->get('cart');
        $cart = [];
        if ($sessionCart != null) {
            foreach ($sessionCart as $item) {
                $product = $this->productService->getOne($item["code"]);
                $newCartItem = [
                    'code' => $item["code"],
                    'amount' => $item["amount"],
                    'name' => $product->name,
                    'stock' => $product->stock,
                    'price' => $product->base_price+$product->profit,
                    'discount' => $product->discount,
                    'image' => $product->image,
                ];
                array_push($cart, $newCartItem);
            }
        }

        return $cart;
    }

    public function store(Request $request)
    {
        try {
            $currentCart = $request->session()->get('cart');
            $this->productForCart = [
                'code' => $request->input('product-code'),
                'amount' => (int) $request->input('amount')
            ];
            
            if ($currentCart == null) { // add to cart if cart empty
                $request->session()->put([
                    'cart' => [$this->productForCart]
                ]);
            } else if (array_filter($currentCart, function($item) {
                return $item["code"] == $this->productForCart["code"];
            }) != null) { // increase amount only by 1 if cart product already available
                for ($i=0; $i < count($currentCart); $i++) { 
                    if($currentCart[$i]['code'] == $this->productForCart['code']) {
                        $currentCart[$i]['amount'] += 1;
                    }
                }
                $this->resetCartSession($request, $currentCart);
            } else { // add new product to cart
                array_push($currentCart, $this->productForCart);
                $this->resetCartSession($request, $currentCart);
            }

            return redirect('/products/order')->with('success', 'Tambah keranjang berhasil!');
        } catch(SessionNotFoundException $ex) {
            return redirect('/products/order')->with('error', 'Tambah keranjang gagal.');
        }
    }

    public function changeAmount(Request $request, $code, $action)
    {
        try {
            $cart = $request->session()->get('cart');
            for ($i = 0; $i < count($cart); $i++) { 
                if ($cart[$i]["code"] == $code) {
                    $newAmount = 0;
                    if ($action == "decrease") {
                        $newAmount = $cart[$i]["amount"] - 1;
                    } else if ($action == "increase") {
                        $newAmount = $cart[$i]["amount"] + 1;
                    }
                    $cart[$i]["amount"] = $newAmount;
                }
            }
            $this->resetCartSession($request, $cart);
            return redirect('/products/order')->with('success', 'Hapus keranjang berhasil!');
        } catch(SessionNotFoundException $ex) {
            return redirect('/products/order')->with('error', 'Hapus keranjang gagal.');
        }
    }

    public function destroy(Request $request)
    {
        try {
            $request->session()->remove('cart');
            return redirect('/products/order')->with('success', 'Hapus keranjang berhasil!');
        } catch(SessionNotFoundException $ex) {
            return redirect('/products/order')->with('error', 'Hapus keranjang gagal.');
        }
    }

    public function removeOne(Request $request, $code)
    {
        try {
            $this->code = $code;
            $cart = $request->session()->get('cart');
            $cart = array_filter($cart, function($item) {
                return $item["code"] != $this->code;
            });
            $this->resetCartSession($request, $cart);
            return redirect('/products/order')->with('success', 'Hapus keranjang berhasil!');
        } catch(SessionNotFoundException $ex) {
            return redirect('/products/order')->with('error', 'Hapus keranjang gagal.');
        }
    }

    public function resetCartSession(Request $request, $newCart) {
        $request->session()->remove('cart');
        $request->session()->put([
            'cart' => $newCart
        ]);
    }
}
