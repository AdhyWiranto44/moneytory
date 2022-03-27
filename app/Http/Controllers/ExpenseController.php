<?php

namespace App\Http\Controllers;

use App\Facades\ExpenseService;
use App\Helper;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->expenseService = new ExpenseService();
        $this->helper = new Helper();
    }

    public function index(Request $request)
    {
        [ $user, $company, $menus ] = $this->helper->getCommonData();
        [ $dateMin, $dateMax ] = $this->helper->getCurrentDate();
        $expenses = $this->expenseService->getByDate($dateMin, $dateMax);

        if ($request->query('tanggal_dari') && $request->query('tanggal_ke') == '') {
            $dateMin = $request->query('tanggal_dari') . ' 00:00:00';
        } else if ($request->query('tanggal_dari') == '' && $request->query('tanggal_ke')) {
            $dateMax = $request->query('tanggal_ke') . ' 23:59:59';
        } else if ($request->query('tanggal_dari') && $request->query('tanggal_ke')) {
            $dateMin = $request->query('tanggal_dari') . ' 00:00:00';
            $dateMax = $request->query('tanggal_ke') . ' 23:59:59';
        }

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

    public function create()
    {
        [ $user, $company, $menus ] = $this->helper->getCommonData();
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
                'description' => 'required',
                'cost' => 'required|numeric',
                'image' => 'image|max:1024'
            ],
            [
                'required' => 'Kolom ini harus diisi!',
                'numeric' => 'Kolom ini harus berisi bilangan bulat atau bilangan pecahan',
                'image.image' => 'File harus berupa gambar (jpg, jpeg, dan png)',
                'image.max' => 'Ukuran gambar maksimal yang diterima adalah sebesar :max MB'
            ]
        );

        try {
            $this->expenseService->insert();
            return redirect('/expenses')->with('success', 'Tambah Pengeluaran Berhasil!');
        } catch(QueryException $ex) {
            return redirect('/expenses')->with('error', 'Tambah Pengeluaran Gagal!');
        }
    }

    public function edit($code)
    {
        [ $user, $company, $menus ] = $this->helper->getCommonData();
        $expense = $this->expenseService->getOne($code);
        $data = [
            'title' => 'Ubah',
            'expense' => $expense,
            'menus' => $menus,
            'username' => $user->username,
            'userImage' => $user->image,
            'companyName' => $company->name,
            'companyLogo' => $company->image,
        ];

        return view('expense_edit', $data);
    }

    public function update(Request $request, $code)
    {
        $expense = $this->expenseService->getOne($code);
        $request->validate(
            [
                'name' => 'required',
                'description' => 'required',
                'cost' => 'required|numeric',
                'image' => 'image|max:1024'
            ],
            [
                'required' => 'Kolom ini harus diisi!',
                'numeric' => 'Kolom ini harus berisi bilangan bulat atau bilangan pecahan',
                'image.image' => 'File harus berupa gambar (jpg, jpeg, dan png)',
                'image.max' => 'Ukuran gambar maksimal yang diterima adalah sebesar :max MB'
            ]
        );

        try {
            $this->expenseService->update($code, $expense);
            return redirect('/expenses')->with('success', 'Ubah pengeluaran berhasil!');
        } catch(QueryException $ex) {
            return redirect('/expenses')->with('error', 'Ubah pengeluaran gagal!');
        }
    }
    
    public function destroy($code)
    {
        try {
            $this->expenseService->delete($code);
            return redirect('/expenses')->with('success', 'Penghapusan pengeluaran berhasil!');
        } catch(QueryException $ex) {
            return redirect('/expenses')->with('error', 'Penghapusan pengeluaran gagal!');
        }
    }
}
