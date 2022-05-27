<?php

namespace App\Models;

use App\Helpers\ImageHelper;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = [
        'image','product_id'
    ];
    public function products()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
    public function setImageAttribute($value){
        $this->attributes['image'] = ImageHelper::saveProductImage($value,'/uploaded_images/products/');
    }
}
