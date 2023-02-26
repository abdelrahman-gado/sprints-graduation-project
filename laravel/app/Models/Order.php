<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shipping_price',
        'total_price'
    ];

    function user(){
        return $this->belongsTo(User::class);
    }
    
    function detail(){
        return $this->belongsTo(OrderDetail::class);
    }
}
