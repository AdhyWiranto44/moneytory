<?php

namespace App\Facades;

use App\Helper;
use App\Repositories\CompanyProfileRepository;

class CompanyProfileService
{
    public function __construct()
    {
        $this->companyProfileRepository = new CompanyProfileRepository();
        $this->helper = new Helper();
    }

    public function insert()
    {
        $companyProfile = [
            'name' => request()->input('name'),
            'phone_number' => request()->input('phone_number'),
            'email' => request()->input('email'),
            'address' => request()->input('address')
        ];

        // Kalau ada gambar yang di-upload
        if (request()->image) {
            $companyProfile['image'] = $this->helper->createImageName();
            $this->helper->uploadFile($companyProfile['image']);
        }

        $this->companyProfileRepository->insert($companyProfile);
    }

    public function update($company, $request)
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
            $formInput['image'] = $this->helper->createImageName();
            $this->helper->uploadFile($formInput['image']);
        }

        $this->companyProfileRepository->update($formInput);
    }

    public function getOne()
    {
        $company = $this->companyProfileRepository->getFirst();
        if (!isset($company)) return null;
        return $company;
    }

    public function isCompanyUnregistered()
    {
        return $this->getOne() == null;
    }
}