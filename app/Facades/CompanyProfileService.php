<?php

namespace App\Facades;

use App\Repositories\CompanyProfileRepository;

class CompanyProfileService
{
    static function update($data)
    {
        CompanyProfileRepository::update($data);
    }

    static function getOne()
    {
        $company = CompanyProfileRepository::getAll();
        return $company[0];
    }
}