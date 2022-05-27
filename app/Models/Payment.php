<?php

namespace App\Models;

use App\Helpers\ImageHelper;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'name','number','method','bank','bnumber','image'
    ];
    public function setImageAttribute($value){
        $this->attributes['image'] = ImageHelper::savePImage($value,'/payment/');
    }
}
