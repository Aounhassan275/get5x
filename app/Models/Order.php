<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'product_id','price','address','name','user_id','status'
    ];
    
    public function user()
    {
        return $this->belongTo(User::class);
    }
    public function product()
    {
        return $this->belongTo(Product::class);
    }
}
