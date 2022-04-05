<?php

namespace App\Facades;

use App\Helper;
use App\Repositories\IncomeRepository;

class IncomeService
{
    public function __construct()
    {
        $this->helper = new Helper();
        $this->productService = new ProductService();
        $this->incomeRepository = new IncomeRepository();
    }

    public function getOne($code)
    {
        $params = [ 'code' => $code ];
        return $this->incomeRepository->get($params)->first();
    }

    public function getPriceSumByDate($from, $to)
    {
        $params = [
            [ "income_status_id", "=", 2 ], 
            [ "created_at", ">=", $from ], 
            [ "created_at", "<=", $to ]
        ];
        return $this->incomeRepository->get($params)->sum('total_price');
    }

    public function getLastRow()
    {
        return $this->incomeRepository->getLastRow();
    }

    public function getByDate($code, $from, $to)
    {
        $params = [
            "code" => $code, 
            "from" => $from, 
            "to" => $to
        ];
        return $this->incomeRepository->getByDate($params);
    }

    public function getLatestIncome()
    {
      $latestIncome = $this->incomeRepository->getLastRow();
      return $latestIncome;
    }

    public function insert()
    {
        // untuk input base_prices data incomes
        $basePrices = [];

        $inputPrices = request()->input('prices');
        $inputProducts = request()->input('products');
        $inputAmounts = request()->input('amounts');
        $inputDiscounts = request()->input('discounts');
        $inputExtraCharge = request()->input('extra_charge') ? request()->input('extra_charge') : 0;
        $prices = explode(',', $inputPrices);
        $products = explode(',', $inputProducts);
        $amounts = explode(',', $inputAmounts);
        $discounts = explode(',', $inputDiscounts);
        $total_price = 0;

        // cek apakah panjang array harga, kode produk, dan jumlah sama
        if ((count($prices) + count($products) + count($amounts) + count($discounts)) % 4 > 0) {
            return "Banyaknya harga, kode produk, jumlah, dan diskon tidak sama!";
        }

        // cek apakah jumlah ada yang minus
        foreach ($amounts as $amount) {
            if ((int) $amount < 0) {
                return "Jumlah tidak boleh minus!";
            }
        }

        // cek apakah ada produk yang tidak ada
        foreach ($products as $product) {
            if ($this->productService->getOne($product) == null) {
                return "Barang jadi dengan kode {$product} tidak ada!";
            }
        }

        // Membuat code
        $newCode = $this->helper->generateCode("INC", $this->incomeRepository->getLastRow());

        // Menghitung total biaya berdasarkan (harga modal + untung - diskon) dikali jumlah pesanan
        for ($i = 0; $i < count($prices); $i++) { 
            $discountPrice = (int) $prices[$i] - ((int) $prices[$i] * (int) $discounts[$i]/100);
            $total_price += $discountPrice * (int) $amounts[$i];
        }
        $total_price += $inputExtraCharge;

        $formInput = [
            'income_status_id' => 2,
            'code' => $newCode,
            'products' => $inputProducts,
            'amounts' => $inputAmounts,
            'prices' => $inputPrices,
            'discounts' => $inputDiscounts,
            'total_price' => $total_price,
            'extra_charge' => $inputExtraCharge,
            'created_at' => now(),
            'updated_at' => now()
        ];

        // Mengurangi stok tiap produk yang dibeli
        for ($i = 0; $i < count($products); $i++) {
            $product = $this->productService->getOne($products[$i]);
            $stock = $product->stock;
            $basePrice = $product->base_price;

            // mengurangi stok barang jadi
            $decreasedStock = $stock - $amounts[$i];
            if ($decreasedStock < 0) {
                return "Stok {$product->name} kurang!";
            }
            $product->update(['stock' => $decreasedStock]);

            array_push($basePrices, $basePrice);
        }

        // tambahkan data harga modal pada form
        $formInput['base_prices'] = implode(",", $basePrices);

        $this->incomeRepository->insert($formInput);
        request()->session()->remove('cart');
    }

    public function update($code, $income)
    {
        $params = [ 'code' => $code ];
        
        // untuk input base_prices data incomes
        $basePrices = [];

        $inputPrices = request()->input('prices');
        $inputProducts = request()->input('products');
        $inputAmounts = request()->input('amounts');
        $inputDiscounts = request()->input('discounts');
        $inputExtraCharge = request()->input('extra_charge') ? request()->input('extra_charge') : 0;
        $prices = explode(',', $inputPrices);
        $products = explode(',', $inputProducts);
        $amounts = explode(',', $inputAmounts);
        $discounts = explode(',', $inputDiscounts);
        $total_price = 0;
        
        // cek apakah panjang array harga, kode produk, dan jumlah sama
        if ((count($prices) + count($products) + count($amounts) + count($discounts)) % 4 > 0) {
            return "Banyaknya harga, kode produk, jumlah, dan diskon tidak sama!";
        }

        // cek apakah jumlah ada yang minus
        foreach ($amounts as $amount) {
            if ((int) $amount < 0) {
                return "Jumlah tidak boleh minus!";
            }
        }

        // cek apakah ada produk yang tidak ada
        foreach ($products as $product) {
            if ($this->productService->getOne($product) == null) {
                return "Barang jadi dengan kode {$product} tidak ada!";
            }
        }

        // Menghitung total biaya berdasarkan (harga modal + untung) dikali jumlah pesanan
        for ($i = 0; $i < count($prices); $i++) { 
            $discountPrice = (int) $prices[$i] - ((int) $prices[$i] * (int) $discounts[$i]/100);
            $total_price += $discountPrice * (int) $amounts[$i];
        }
        $total_price += $inputExtraCharge;

        $update = [
            'products' => request()->input('products') != null ? request()->input('products') : $income->products,
            'amounts' => request()->input('amounts') != null ? request()->input('amounts') : $income->amounts,
            'prices' => request()->input('prices') != null ? request()->input('prices') : $income->prices,
            'discounts' => request()->input('discounts') != null ? request()->input('discounts') : $income->discounts,
            'total_price' => $total_price,
            'updated_at' => now()
        ];

        // Mengurangi stok tiap produk yang dibeli
        for ($i = 0; $i < count($products); $i++) {
            $product = $this->productService->getOne($products[$i]);
            $stock = $product->stock;
            $basePrice = $product->base_price;
            $newStock = 0;
            $amountsFromIncome = explode(",", $income->amounts);
            $newStock = $stock + $amountsFromIncome[$i] - $amounts[$i];

            if ($newStock < 0) {
                return "Stok {$product->name} kurang!";
            }

            $product->update(['stock' => $newStock]);

            array_push($basePrices, $basePrice);
        }

        // tambahkan data harga modal pada form
        $update['base_prices'] = implode(",", $basePrices);

        $this->incomeRepository->update($params, $update);
    }

    public function changeStatus($code, $status)
    {
        $params = [ 'code' => $code ];
        $update = [ 'income_status_id' => $status ];
        $this->incomeRepository->update($params, $update);
    }

    public function delete($code)
    {
        $income = $this->getOne($code);
        $products = explode(',', $income->products);
        $amounts = explode(',', $income->amounts);

        // Mengurangi stok tiap produk yang dibeli
        for ($i = 0; $i < count($products); $i++) {
            $product = $this->productService->getOne($products[$i]);
            $stock = $product->stock;
            $product->update(['stock' => $stock + $amounts[$i]]);
        }

        $params = [ 'code' => $code ];
        $this->incomeRepository->delete($params);
    }
}