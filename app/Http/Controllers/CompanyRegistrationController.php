<?php

namespace App\Http\Controllers;

use App\Facades\CompanyProfileService;
use App\Facades\UserService;
use App\Models\CompanyProfile;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CompanyRegistrationController extends Controller
{
    public function index()
    {
        $companyProfile = CompanyProfileService::getOne();
        if ($companyProfile != null) return redirect('/login');
        
        $data = [ 'title' => 'Company Registration' ];
        return view('company_registration', $data);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'phone_number' => 'required',
                'email' => 'required|email',
                'address' => 'required',
                'image' => 'image|max:1024'
            ],
            [
                'required' => 'Kolom ini harus diisi!',
                'email' => 'Kolom ini harus diisi dengan email!',
                'image' => 'File harus berupa gambar (jpg, jpeg, dan png)',
                'max' => 'Ukuran gambar maksimal yang diterima adalah sebesar:max MB'
            ]
        );

        try {
            CompanyProfileService::insert();
        } catch (QueryException $ex) {
            return redirect('/registration/company');
        }
        
        try {
            // Mendaftarkan user admin default
            UserService::insertDefaultUser();
            return redirect('/login')->with('success', 'Pendaftaran perusahaanmu berhasil dilakukan. Sistem juga telah menambahkan user baru username: admin dan password: 12345, disarankan untuk menggantinya segera!');
        } catch (QueryException $ex) {
            return redirect('/registration/company');
        }
    }
}
