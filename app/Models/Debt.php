<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    use HasFactory;
    protected $fillable = [
        'debt_type_id',
        'debt_status_id',
        'code',
        'name',
        'description',
        'price',
        'on_behalf_of',
        'phone_number',
        'address',
        'created_at',
        'updated_at',
    ];
}
