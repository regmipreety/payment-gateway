<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class PaymentPlatform extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'namelower',
        'image',
    ];
}
