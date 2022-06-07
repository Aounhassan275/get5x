<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Earning extends Model
{
    protected $fillable = [
        'price','user_id','type'
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
    public static function direct_income()
    {
        return (New static)::where('type','direct_income')->get();
    }
    public static function matching_income()
    {
        return (New static)::where('type','matching_income')->get();
    }
}
