<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawIngredient extends Model
{
    use HasFactory;
    protected $fillable = [
        'status_id',
        'code',
        'name',
        'stock',
        'minimum_stock',
        'unit_id',
        'image',
        'created_at',
        'updated_at',
    ];
}
