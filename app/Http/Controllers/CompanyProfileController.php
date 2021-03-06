<?php

namespace App\Http\Controllers;

use App\Facades\CompanyProfileService;
use App\Helper;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CompanyProfileController extends Controller
{
    public function __construct()
    {
        $this->companyProfileService = new CompanyProfileService();
        $this->helper = new Helper();
    }
    
    public function edit()
    {
        [ $user, $company, $menus ] = $this->helper->getCommonData();
        $data = [
            'title' => 'Ubah Profil Perusahaan',
            'menus' => $menus,
            'username' => $user->username,
            'userImage' => $user->image,
            'company' => $company,
            'companyName' => $company->name,
            'companyLogo' => $company->image,
        ];
        return view('company_profile_edit', $data);
    }

    public function update(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'phone_number' => 'required|min:8|max:14',
                'email' => 'required|email',
                'address' => 'required',
                'image' => 'image|max:1024'
            ],
            [
                'required' => 'Kolom ini harus diisi!',
                'min' => 'Kolom ini harus berisi minimal :min karakter!',
                'email' => 'Kolom ini harus berisi email!',
                'phone_number.max' => 'Kolom ini harus berisi maximal :max karakter!',
                'image.image' => 'File harus berupa gambar (jpg, jpeg, dan png)',
                'image.max' => 'Ukuran gambar maksimal yang diterima adalah sebesar :max MB'
            ]
        );
        
        try {
            $company = $this->companyProfileService->getOne();
            $this->companyProfileService->update($company, $request);
            return redirect('/settings')->with('success', 'Ubah profil perusahaan berhasil!');
        } catch(QueryException $ex) {
            return redirect('/settings')->with('error', 'Ubah profil perusahaan gagal!');
        }
    }
}
