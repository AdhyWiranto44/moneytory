<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;
    protected $fillable = [
        'income_status_id',
        'code',
        'products',
        'amounts',
        'base_prices',
        'prices',
        'total_price',
        'extra_charge',
        'created_at',
        'updated_at',
    ];
}
