<?php

namespace App\Facades;

use App\Helper;
use App\Repositories\CompanyProfileRepository;

class CompanyProfileService
{
    static function insert()
    {
        $formInput = [
            'name' => request()->input('name'),
            'phone_number' => request()->input('phone_number'),
            'email' => request()->input('email'),
            'address' => request()->input('address')
        ];

        // Kalau ada gambar yang di-upload
        if (request()->image) {
            $imgName = strtotime('now') . '-' . preg_replace('/\s+/', '-', request()->image->getClientOriginalName());
            $formInput['image'] = $imgName;
            
            Helper::uploadfile($imgName);
        }

        CompanyProfileRepository::insert($formInput);
    }

    static function update($company, $request)
    {
        $formInput = [
            'name' => $request->input('name') != null ? $request->input('name') : $company->name,
            'phone_number' => $request->input('phone_number') != null ? $request->input('phone_number') : $company->phone_number,
            'email' => $request->input('email') != null ? $request->input('email') : $company->email,
            'address' => $request->input('address') != null ? $request->input('address') : $company->address,
            'updated_at' => now()
        ];

        // Kalau ada gambar yang di-upload
        if ($request->image) {
            $imgName = strtotime('now') . '-' . preg_replace('/\s+/', '-', $request->image->getClientOriginalName());
            $formInput['image'] = $imgName;
            
            Helper::uploadfile($imgName);
        }

        CompanyProfileRepository::update($formInput);
    }

    static function getOne()
    {
        $company = CompanyProfileRepository::getFirst();
        if (!isset($company)) return null;
        return $company;
    }
}