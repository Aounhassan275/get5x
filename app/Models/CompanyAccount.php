<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyAccount extends Model
{
    protected $fillable = [
       'name', 'balance'
    ];
    public static function matching_income(){
        return (new static)::where('name','Matching Income')->first();
    }
    public static function product_income(){
        return (new static)::where('name','Product Income')->first();
    }
    public static function expense_income(){
        return (new static)::where('name','Expense Income')->first();
    }
    public static function flash_income(){
        return (new static)::where('name','Flash Income')->first();
    }
    public static function reward_income(){
        return (new static)::where('name','Reward Income')->first();
    }
    public static function loss_income(){
        return (new static)::where('name','Loss Income')->first();
    }
    public static function salary(){
        return (new static)::where('name','Salary')->first();
    }
    
}
