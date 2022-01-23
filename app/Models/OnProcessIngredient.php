<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnProcessIngredient extends Model
{
    protected $fillable = [
        'status_id',
        'raw_ingredient_id',
        'code',
        'purpose',
        'amount',
        'created_at',
        'updated_at',
    ];
}
