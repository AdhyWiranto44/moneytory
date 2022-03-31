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
        'address' => request()->input('address'),
        'image' => $this->helper->createImageName()
      ];

      $this->companyProfileRepository->insert($companyProfile);
      $this->helper->uploadFile($companyProfile['image']);
    }

    public function update($company, $request)
    {
        $formInput = [
            'name' => $request->input('name') != null ? $request->input('name') : $company->name,
            'phone_number' => $request->input('phone_number') != null ? $request->input('phone_number') : $company->phone_number,
            'email' => $request->input('email') != null ? $request->input('email') : $company->email,
            'address' => $request->input('address') != null ? $request->input('address') : $company->address,
            'image' => $this->helper->createImageName(),
            'updated_at' => now()
        ];

        $this->companyProfileRepository->update($formInput);
        $this->helper->uploadFile($formInput['image']);
    }

    public function getOne()
    {
        $company = $this->companyProfileRepository->getFirst();
        if (!isset($company)) return null;
        return $company;
    }

    public function isCompanyUnregistered()
    {
      $company = $this->companyProfileRepository->getFirst();
      return $company == null;
    }

    private function isImageUploaded() {
      if (request()->image) {
        $companyProfile['image'] = $this->helper->createImageName();
        $this->helper->uploadFile($companyProfile['image']);
      }
    }
}