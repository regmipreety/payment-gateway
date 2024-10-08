<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $primaryKey = 'iso';

    public $incrementing = false;

    protected $fillable = [
        'iso',
    ];
}
