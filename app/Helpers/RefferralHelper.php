<?php

namespace App\Helpers;

use App\Models\Earning;
use App\Models\User;

class RefferralHelper
{
    public static function DirectLeftRefferral($user,$refer_by,$direct_income,$matching_income)
    {
        if($refer_by->left_refferal == null)
        {
            $refer_by->update([
                'left_refferal' => $user->id,
                'balance' => $refer_by->balance += $direct_income,
                'r_earning' => $refer_by->r_earning += $direct_income,
                'left_amount' => $matching_income,
            ]);
            $user->update([
                'top_referral' => 'Done',
            ]);
            Earning::create([
                "user_id" => $refer_by->id,
                "price" => $direct_income,
                "type" => 'direct_income'
            ]);
            // $company_account->update([
            //     'balance' => $company_account->balance -= $direct_income,
            // ]);
            $chain = $refer_by;
            for($i = 0;$i < 1000;$i++)
            {
                $referrral_chain = User::where('left_refferal',$chain->id)->orWhere('right_refferal',$chain->id)->first();
                if($referrral_chain->left_refferal == $chain->id)
                {
                    $referrral_chain->update([
                        'left_amount' =>   $referrral_chain->left_amount + $matching_income,
                    ]);
                }else{
                    $referrral_chain->update([
                        'right_amount' =>   $referrral_chain->right_amount + $matching_income,
                    ]);
                }
                if($chain->left_amount > $chain->right_amount)
                {
                    $amount = $chain->right_amount*2;
                    if($amount > 0)
                    {
                        $chain->update([
                            'right_amount' => 0, 
                            'left_amount' => $chain->left_amount -= $amount, 
                            'balance' => $chain->balance += $amount,
                            'r_earning' => $chain->r_earning += $amount,
                        ]);
                        Earning::create([
                            "user_id" => $chain->id,
                            "price" => $amount,
                            "type" => 'matching_income'
                        ]);
                        // $company_account->update([
                        //     'balance' => $company_account->balance -= $amount,
                        // ]);
                    }
                }else if($chain->right_amount > $chain->left_amount)
                {
                    $amount = $chain->left_amount*2;
                    if($amount > 0)
                    {
                        $chain->update([
                            'right_amount' => $chain->right_amount -= $amount, 
                            'left_amount' => 0, 
                            'balance' => $chain->balance += $amount,
                            'r_earning' => $chain->r_earning += $amount,
                        ]);
                        Earning::create([
                            "user_id" => $chain->id,
                            "price" => $amount,
                            "type" => 'matching_income'
                        ]);
                        // $company_account->update([
                        //     'balance' => $company_account->balance -= $amount,
                        // ]);
                    }
                }else{
                    $amount = $chain->left_amount*2;
                    if($amount > 0)
                    {
                        $chain->update([
                            'right_amount' => 0, 
                            'left_amount' => 0, 
                            'balance' => $chain->balance += $amount,
                            'r_earning' => $chain->r_earning += $amount,
                        ]);
                        Earning::create([
                            "user_id" => $chain->id,
                            "price" => $amount,
                            "type" => 'matching_income'
                        ]);
                        // $company_account->update([
                        //     'balance' => $company_account->balance -= $amount,
                        // ]);
                    }
                }
                $chain = $referrral_chain;
                if($referrral_chain->id == $user->main_owner)
                {
                    $i = 1000;
                    if($chain->left_amount > $chain->right_amount)
                    {
                        $amount = $chain->right_amount*2;
                        if($amount > 0)
                        {
                            $chain->update([
                                'right_amount' => 0, 
                                'left_amount' => $chain->left_amount -= $amount, 
                                'balance' => $chain->balance += $amount,
                                'r_earning' => $chain->r_earning += $amount,
                            ]);
                            Earning::create([
                                "user_id" => $chain->id,
                                "price" => $amount,
                                "type" => 'matching_income'
                            ]);
                            // $company_account->update([
                            //     'balance' => $company_account->balance -= $amount,
                            // ]);
                        }
                    }else if($chain->right_amount > $chain->left_amount)
                    {
                        $amount = $chain->left_amount*2;
                        if($amount > 0)
                        {
                            $chain->update([
                                'right_amount' => $chain->right_amount -= $amount, 
                                'left_amount' => 0, 
                                'balance' => $chain->balance += $amount,
                                'r_earning' => $chain->r_earning += $amount,
                            ]);
                            Earning::create([
                                "user_id" => $chain->id,
                                "price" => $amount,
                                "type" => 'matching_income'
                            ]);
                            // $company_account->update([
                            //     'balance' => $company_account->balance -= $amount,
                            // ]);
                        }
                    }else{
                        $amount = $chain->left_amount*2;
                        if($amount > 0)
                        {
                            $chain->update([
                                'right_amount' => 0, 
                                'left_amount' => 0, 
                                'balance' => $chain->balance += $amount,
                                'r_earning' => $chain->r_earning += $amount,
                            ]);
                            Earning::create([
                                "user_id" => $chain->id,
                                "price" => $amount,
                                "type" => 'matching_income'
                            ]);
                            // $company_account->update([
                            //     'balance' => $company_account->balance -= $amount,
                            // ]);
                        }
                    }
                }
            }
        }else{
            $user->update([
                'top_referral' => 'Pending',
            ]);
        }
    } 
    public static function DirectRightRefferral($user,$refer_by,$direct_income,$matching_income)
    {
        if($refer_by->right_refferal == null)
        {
            $refer_by->update([
                'right_refferal' => $user->id,
                'balance' => $refer_by->balance += $direct_income,
                'r_earning' => $refer_by->r_earning += $direct_income,
                'right_amount' => $matching_income,
            ]);
            $user->update([
                'top_referral' => 'Done',
            ]);
            Earning::create([
                "user_id" => $refer_by->id,
                "price" => $direct_income,
                "type" => 'direct_income'
            ]);
            // $company_account->update([
            //     'balance' => $company_account->balance -= $direct_income,
            // ]);
            $chain = $refer_by;
            for($i = 0;$i < 1000;$i++)
            {
                $referrral_chain = User::where('left_refferal',$chain->id)->orWhere('right_refferal',$chain->id)->first();
                if($referrral_chain->left_refferal == $chain->id)
                {
                    $referrral_chain->update([
                        'left_amount' =>   $referrral_chain->left_amount + $matching_income,
                    ]);
                }else{
                    $referrral_chain->update([
                        'right_amount' =>   $referrral_chain->right_amount + $matching_income,
                    ]);
                }
                if($chain->left_amount > $chain->right_amount)
                {
                    $amount = $chain->right_amount*2;
                    if($amount > 0)
                    {
                        $chain->update([
                            'right_amount' => 0, 
                            'left_amount' => $chain->left_amount -= $amount, 
                            'balance' => $chain->balance += $amount,
                            'r_earning' => $chain->r_earning += $amount,
                        ]);
                        Earning::create([
                            "user_id" => $chain->id,
                            "price" => $amount,
                            "type" => 'matching_income'
                        ]);
                        // $company_account->update([
                        //     'balance' => $company_account->balance -= $amount,
                        // ]);
                    }
                }else if($chain->right_amount > $chain->left_amount)
                {
                    $amount = $chain->left_amount*2;
                    if($amount > 0)
                    {
                        $chain->update([
                            'right_amount' => $chain->right_amount -= $amount, 
                            'left_amount' => 0, 
                            'balance' => $chain->balance += $amount,
                            'r_earning' => $chain->r_earning += $amount,
                        ]);
                        Earning::create([
                            "user_id" => $chain->id,
                            "price" => $amount,
                            "type" => 'matching_income'
                        ]);
                        // $company_account->update([
                        //     'balance' => $company_account->balance -= $amount,
                        // ]);
                    }
                }else{
                    $amount = $chain->left_amount*2;
                    if($amount > 0)
                    {
                        $chain->update([
                            'right_amount' => 0, 
                            'left_amount' => 0, 
                            'balance' => $chain->balance += $amount,
                            'r_earning' => $chain->r_earning += $amount,
                        ]);
                        Earning::create([
                            "user_id" => $chain->id,
                            "price" => $amount,
                            "type" => 'matching_income'
                        ]);
                        // $company_account->update([
                        //     'balance' => $company_account->balance -= $amount,
                        // ]);
                    }
                }
                $chain = $referrral_chain;
                if($referrral_chain->id == $user->main_owner)
                {
                    if($chain->left_amount > $chain->right_amount)
                    {
                        $amount = $chain->right_amount*2;
                        if($amount > 0)
                        {
                            $chain->update([
                                'right_amount' => 0, 
                                'left_amount' => $chain->left_amount -= $amount, 
                                'balance' => $chain->balance += $amount,
                                'r_earning' => $chain->r_earning += $amount,
                            ]);
                            Earning::create([
                                "user_id" => $chain->id,
                                "price" => $amount,
                                "type" => 'matching_income'
                            ]);
                            // $company_account->update([
                            //     'balance' => $company_account->balance -= $amount,
                            // ]);
                        }
                    }else if($chain->right_amount > $chain->left_amount)
                    {
                        $amount = $chain->left_amount*2;
                        if($amount > 0)
                        {
                            $chain->update([
                                'right_amount' => $chain->right_amount -= $amount, 
                                'left_amount' => 0, 
                                'balance' => $chain->balance += $amount,
                                'r_earning' => $chain->r_earning += $amount,
                            ]);
                            Earning::create([
                                "user_id" => $chain->id,
                                "price" => $amount,
                                "type" => 'matching_income'
                            ]);
                            // $company_account->update([
                            //     'balance' => $company_account->balance -= $amount,
                            // ]);
                        }
                    }else{
                        $amount = $chain->left_amount*2;
                        if($amount > 0)
                        {
                            $chain->update([
                                'right_amount' => 0, 
                                'left_amount' => 0, 
                                'balance' => $chain->balance += $amount,
                                'r_earning' => $chain->r_earning += $amount,
                            ]);
                            Earning::create([
                                "user_id" => $chain->id,
                                "price" => $amount,
                                "type" => 'matching_income'
                            ]);
                            // $company_account->update([
                            //     'balance' => $company_account->balance -= $amount,
                            // ]);
                        }
                    }
                    $i = 1000;
                }
            }
        }
        else{
            $user->update([
                'top_referral' => 'Pending',
            ]);
        }
    
}