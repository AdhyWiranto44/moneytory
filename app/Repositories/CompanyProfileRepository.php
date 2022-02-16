<?php

namespace App\Repositories;

use App\Models\CompanyProfile;

class CompanyProfileRepository
{
    public function __construct()
    {
        $this->companyProfile = new CompanyProfile();
    }

    public function insert($data)
    {
        $this->companyProfile->create($data)->save();
    }

    public function update($data)
    {
        $this->companyProfile->first()->update($data);
    }

    public function getFirst()
    {
        return $this->companyProfile->first();
    }
}