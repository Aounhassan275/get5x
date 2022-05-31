<?php

namespace App\Models;

use App\Helpers\ImageHelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $fillable = [
        't_id','payment','user_id','package_id','amount','status','image'
    ];
    public function setImageAttribute($value){
        $this->attributes['image'] = ImageHelper::savePImage($value,'/deposit/');
    }
    public function package()
    {
        return $this->belongsTo('App\Models\Package');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public static function user_id()
    {
        return (New static)::where('user_id',' ')->get();
    }
    public static function new()
    {
        return (New static)::where('status','new')->get();
    }
    public static function old()
    {
        return (New static)::where('status','old')->get();
    }
    public static function PerfectMoney()
    {
        return (New static)::where('status','old')->get();
    }
    public static function TodayPerfectMoney()
    {
        // return Rthis->PerfectMoney()->whereDate('created_at',Carbon::today())->get();
        return (New static)::where('status','old')->whereDate('created_at',Carbon::today())->get();
    }
}
