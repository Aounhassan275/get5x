<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use SoftDeletes;
 
    protected $fillable = [
        'name','account','user_id','method','payment','status'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public static function old(){
        return (new static)::withTrashed()->get();
    }
    public static function hold(){
        return (new static)::where('status','On Hold')->get();
    }
	public static function process(){
        return (new static)::where('status','in process')->get();
    }
	public static function completed(){
        return (new static)::where('status','Completed')->get();
    }
}
