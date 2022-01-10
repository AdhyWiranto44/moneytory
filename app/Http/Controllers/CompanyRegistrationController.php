<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CompanyRegistrationController extends Controller
{
    public function index()
    {
        $companyProfile = CompanyProfile::first();
        if ($companyProfile != null) {
            return redirect('/login');
        }
        
        $data = [
            'title' => 'Company Registration'
        ];
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
            $formInput = [
                'name' => $request->input('name'),
                'phone_number' => $request->input('phone_number'),
                'email' => $request->input('email'),
                'address' => $request->input('address')
            ];
    
            // Kalau ada gambar yang di-upload
            if ($request->image) {
                $imgName = strtotime('now') . '-' . $request->image->getClientOriginalName();
                $formInput['image'] = $imgName;
                $request->image->storeAs('./public/img', $imgName);
            }
    
            // Simpan data perusahaan
            $companyProfile = CompanyProfile::create($formInput);
            $companyProfile->save();
    
            // Mendaftarkan user admin default
            $this->registerDefaultUser();
    
            return redirect('/login')->with('success', 'Pendaftaran perusahaanmu berhasil dilakukan. Sistem juga telah menambahkan user baru username: admin dan password: 12345, disarankan untuk menggantinya segera!');
        } catch (QueryException $ex) {
            return redirect('/registration/company');
        }
    }

    private function registerDefaultUser()
    {
        $user = User::create([
            'role_id' => 1,
                'username' => 'admin',
                'password' => Hash::make('12345', ['rounds' => 10]),
                'name' => 'Administrator',
                'phone_number' => '088976685446',
                'email' => null,
                'address' => null,
                'image' => null,
                'created_at' => now(),
                'updated_at' => now()
        ]);
        $user->save();
    }
}
