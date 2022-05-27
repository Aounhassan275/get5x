<?php

namespace App\Helpers;

use App\Models\Earning;
use App\Models\User;

class RefferralHelper
{
    public static function DirectLeftRefferral($user,$refer_by,$direct_income,$company_account)
    {
        $refer_by->update([
            'balance' => $refer_by->balance += $direct_income,
            'r_earning' => $refer_by->r_earning += $direct_income,
        ]);
        if($refer_by->left_refferal == null)
        {
            $refer_by->update([
                'left_refferal' => $user->id,
            ]);
            Earning::create([
                "user_id" => $refer_by->id,
                "price" => $direct_income,
                "type" => 'direct_income'
            ]);
        }else{
            $left_referral = User::whereNull('left_refferal')->where('refer_type','Left')
                                ->where('main_owner',$user->main_owner)->first();
            $left_referral->update([
                'left_refferal' => $user->id,
            ]);
            Earning::create([
                "user_id" => $left_referral->id,
                "price" => $direct_income,
                "type" => 'direct_income'
            ]);
        }
    } 
    public static function DirectRightRefferral($user,$refer_by,$direct_income,$company_account)
    {
        $refer_by->update([
            // 'right_refferal' => $user->id,
            'balance' => $refer_by->balance += $direct_income,
            'r_earning' => $refer_by->r_earning += $direct_income,
        ]);
        if($refer_by->right_refferal == null)
        {
            $refer_by->update([
                'right_refferal' => $user->id,
            ]);
            Earning::create([
                "user_id" => $refer_by->id,
                "price" => $direct_income,
                "type" => 'direct_income'
            ]);
        }else{
            $right_refferal = User::whereNull('right_refferal')->where('refer_type','Right')
                            ->where('main_owner',$user->main_owner)->first();
            $right_refferal->update([
                'left_refferal' => $user->id,
            ]);
            Earning::create([
                "user_id" => $left_referral->id,
                "price" => $direct_income,
                "type" => 'direct_income'
            ]);
        }
        Earning::create([
            "user_id" => $refer_by->id,
            "price" => $direct_income,
            "type" => 'direct_income'
        ]);
    } 
    
}