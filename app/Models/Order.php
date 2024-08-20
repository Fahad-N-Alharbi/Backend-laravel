<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'location', 
        'size', 
        'weight', 
        'pickup_time', 
        'delivery_time', 
        'status'
    ];
}
