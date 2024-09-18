<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_charts extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id', // Add customer_id to the fillable array
        'meal_id',
        'date',
        'status',
        'plan_id'
    ];
}
