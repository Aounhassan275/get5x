<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $fillable = [
        't_id','payment','user_id','package_id','amount','status'
    ];
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
        return (New static)::where('status','new')->where('payment','PerfectMoney')->get();
    }
    public static function old()
    {
        return (New static)::where('status','old')->get();
    }
    public static function PerfectMoney()
    {
        return (New static)::where('status','old')->where('payment','PerfectMoney')->get();
    }
    public static function TodayPerfectMoney()
    {
        // return Rthis->PerfectMoney()->whereDate('created_at',Carbon::today())->get();
        return (New static)::where('status','old')->where('payment','PerfectMoney')->whereDate('created_at',Carbon::today())->get();
    }
    public static function ownBalance()
    {
        return (New static)::where('status','old')->where('payment','Own Balance')->get();
    }
    public static function TodayownBalance()
    {
        return (New static)::where('status','old')->where('payment','Own Balance')->whereDate('created_at',Carbon::today())->get();
    }
}
