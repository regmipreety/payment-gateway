<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'price',
        'duration_in_days',
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
