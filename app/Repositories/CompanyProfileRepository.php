<?php

namespace App\Repositories;

use App\Models\CompanyProfile;

class CompanyProfileRepository
{
    static function update($data)
    {
        CompanyProfile::first()->update($data);
    }

    static function getAll()
    {
        return CompanyProfile::all();
    }
}