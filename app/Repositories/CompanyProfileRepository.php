<?php

namespace App\Repositories;

use App\Models\CompanyProfile;

class CompanyProfileRepository
{
    static function getOne()
    {
        return CompanyProfile::first();
    }
}