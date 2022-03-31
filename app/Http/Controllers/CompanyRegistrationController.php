<?php

namespace App\Http\Controllers;

use App\Facades\CompanyProfileService;
use App\Facades\UserService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CompanyRegistrationController extends Controller
{
    public function __construct()
    {
        $this->companyProfileService = new CompanyProfileService();
        $this->userService = new UserService();
    }

    public function index()
    {
        $this->companyProfileService = new CompanyProfileService();
        $isCompanyUnregistered = $this->companyProfileService->isCompanyUnregistered();
        if (!$isCompanyUnregistered) return redirect('/login');
        
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
            $this->companyProfileService->insert();
        } catch (QueryException $ex) {
            return redirect('/registration/company');
        }
        
        try {
            // Mendaftarkan user admin default
            $this->userService->insertDefaultUser();
            return redirect('/login')->with('success', 'Pendaftaran perusahaanmu berhasil dilakukan. Sistem juga telah menambahkan user baru username: admin dan password: 12345, disarankan untuk menggantinya segera!');
        } catch (QueryException $ex) {
            return redirect('/registration/company');
        }
    }
}
