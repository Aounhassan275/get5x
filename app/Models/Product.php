<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name','category_id','brand_id','user_id','price','phone','description','city'
    ];
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
