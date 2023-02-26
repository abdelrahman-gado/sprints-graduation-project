<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'price',
        'description',
        'discount',
        'category_id',
        'color_id',
        'created_at',
        'updated_at'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function color() {
        return $this->belongsTo(Color::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class, 'product_id', 'id');
    }

    public function getPriceAfterDiscount()
    {
        return $this->price - ($this->price * $this->discount);
    }
}
