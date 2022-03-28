<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'status_id',
        'unit_id',
        'code',
        'name',
        'base_price',
        'profit',
        'discount',
        'stock',
        'minimum_stock',
        'image',
        'created_at',
        'updated_at',
    ];
}
