<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Expense;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $user = Helper::getUserLogin($request);
        $company = Helper::getCompanyProfile();
        $expenses = Expense::all();
        $menus = Helper::getMenus($request);
        $data = [
            'title' => 'Pengeluaran',
            'menus' => $menus,
            'expenses' => $expenses,
            'username' => $user->username,
            'userImage' => $user->image,
            'companyName' => $company->name,
            'companyLogo' => $company->image,
        ];
        return view('expenses', $data);
    }

    public function create(Request $request)
    {
        $user = Helper::getUserLogin($request);
        $company = Helper::getCompanyProfile();
        $menus = Helper::getMenus($request);
        $data = [
            'title' => 'Tambah',
            'menus' => $menus,
            'username' => $user->username,
            'userImage' => $user->image,
            'companyName' => $company->name,
            'companyLogo' => $company->image,
        ];
        return view('expense_add', $data);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'code' => 'required|unique:expenses',
                'description' => 'required',
                'cost' => 'required|numeric',
                'image' => 'image|max:1024'
            ],
            [
                'required' => 'Kolom ini harus diisi!',
                'numeric' => 'Kolom ini harus berisi bilangan bulat atau bilangan pecahan',
                'unique' => 'Kode barang sudah ada!',
                'image.image' => 'File harus berupa gambar (jpg, jpeg, dan png)',
                'image.max' => 'Ukuran gambar maksimal yang diterima adalah sebesar :max MB'
            ]
        );

        try {
            $formInput = [
                'name' => $request->input('name'),
                'code' => $request->input('code'),
                'description' => $request->input('description'),
                'cost' => $request->input('cost'),
                'created_at' => now(),
                'updated_at' => now()
            ];

            // Kalau ada gambar yang di-upload
            if ($request->image) {
                $imgName = strtotime('now') . '-' . preg_replace('/\s+/', '-', $request->image->getClientOriginalName());
                $formInput['image'] = $imgName;
                $request->image->storeAs('./public/img', $imgName);
            }

            $expense = Expense::create($formInput);
            $expense->save();
    
            return redirect('/expenses')->with('success', 'Tambah Pengeluaran Berhasil!');
        } catch(QueryException $ex) {
            return redirect('/expenses')->with('error', 'Tambah Pengeluaran Gagal!');
        }
    }
}
