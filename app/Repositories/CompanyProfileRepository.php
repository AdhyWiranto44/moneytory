<?php

namespace App\Repositories;

use App\Models\CompanyProfile;

class CompanyProfileRepository
{
    static function insert($data)
    {
        CompanyProfile::create($data)->save();
    }

    static function update($data)
    {
        CompanyProfile::first()->update($data);
    }

    static function getFirst()
    {
        return CompanyProfile::first();
    }
}