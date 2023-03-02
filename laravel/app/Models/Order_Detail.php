<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Detail extends Model
{
    use HasFactory;


    protected $table = 'order_details';

    protected $fillable = [
        'product_id',
        'order_id',
        'price',
        'quantity',
        'subTotalPrice'
    ];

    public function order() {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }


    public function product() {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

}
