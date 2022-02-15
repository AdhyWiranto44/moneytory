<?php

namespace App\Facades;

use App\Repositories\CompanyProfileRepository;

class CompanyProfileService
{
    static function getOne()
    {
        return CompanyProfileRepository::getOne();
    }
}