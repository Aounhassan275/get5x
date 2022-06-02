<?php

namespace App\Helpers;

use App\Models\CompanyAccount;
use App\Models\Earning;
use App\Models\User;

class RefferralHelper
{
    public static function DirectLeftRefferral($user,$refer_by,$direct_income,$matching_income)
    {
        $e_wallet_direct = $direct_income/100 * 80;
        $auto_direct = $direct_income/100 * 20;
        if($refer_by->left_refferal == null)
        {
            $refer_by->update([
                'left_refferal' => $user->id,
                'balance' => $refer_by->balance += $e_wallet_direct,
                'auto_wallet' => $refer_by->auto_wallet += $auto_direct,
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
            if($user->main_owner == $refer_by->id)
            {
                RefferralHelper::ownerMatching($refer_by);
            }else{
                RefferralHelper::MatchingEarningForLeft($refer_by,$user,$matching_income);
            }
        }else{
            $left = last($refer_by->getOrginalLeft());
            $left->update([
                'left_refferal' => $user->id,
            ]);
            $refer_by->update([
                'balance' => $refer_by->balance += $e_wallet_direct,
                'auto_wallet' => $refer_by->auto_wallet += $auto_direct,
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
            if($user->main_owner == $left->id)
            {
                RefferralHelper::ownerMatching($left);
            }else{
                RefferralHelper::MatchingEarningForLeft($left,$user,$matching_income);
            }
        }
    } 
    public static function DirectRightRefferral($user,$refer_by,$direct_income,$matching_income)
    {
        if($refer_by->right_refferal == null)
        {
            $refer_by->update([
                'right_refferal' => $user->id,
                'balance' => $refer_by->balance += $direct_income/100 * 80,
                'auto_wallet' => $refer_by->auto_wallet += $direct_income/100 * 20,
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
            if($user->main_owner == $refer_by->id)
            {
                RefferralHelper::ownerMatching($refer_by);
            }else{
                RefferralHelper::MatchingEarningForRight($refer_by,$user,$matching_income);
            }   
        }
        else{
            $right = last($refer_by->getOrginalRight());
            $right->update([
                'right_refferal' => $user->id,
            ]);
            
            $refer_by->update([
                'balance' => $refer_by->balance += $direct_income/100 * 80,
                'auto_wallet' => $refer_by->auto_wallet += $direct_income/100 * 20,
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
            $user->update([
                'top_referral' => 'Done',
            ]);
            if($user->main_owner == $right->id)
            {
                RefferralHelper::ownerMatching($right);
            }else{
                RefferralHelper::MatchingEarningForRight($right,$user,$matching_income);
            }
        }
    }
    public static function MatchingEarningForLeft($chain,$user,$matching_income)
    {
        for($i = 0;$i < 1000;$i++)
        {
            $referrral_chain = User::where('left_refferal',$chain->id)->first();
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
                        'balance' => $chain->balance += $amount/100 * 80,
                        'auto_wallet' => $chain->auto_wallet += $amount/100 * 20,
                        'r_earning' => $chain->r_earning += $amount,
                    ]);
                    Earning::create([
                        "user_id" => $chain->id,
                        "price" => $amount,
                        "type" => 'matching_income'
                    ]);
                    $matching_income= CompanyAccount::matching_income();
                    $matching_income->update([
                        'balance' => $matching_income->balance -= $amount,
                    ]);
                }
            }else if($chain->right_amount > $chain->left_amount)
            {
                $amount = $chain->left_amount*2;
                if($amount > 0)
                {
                    $chain->update([
                        'right_amount' => $chain->right_amount -= $amount, 
                        'left_amount' => 0, 
                        'balance' => $chain->balance += $amount/100*80,
                        'auto_wallet' => $chain->auto_wallet += $amount/100*20,
                        'r_earning' => $chain->r_earning += $amount,
                    ]);
                    Earning::create([
                        "user_id" => $chain->id,
                        "price" => $amount,
                        "type" => 'matching_income'
                    ]);
                    $matching_income= CompanyAccount::matching_income();
                    $matching_income->update([
                        'balance' => $matching_income->balance -= $amount,
                    ]);
                }
            }else{
                $amount = $chain->left_amount*2;
                if($amount > 0)
                {
                    $chain->update([
                        'right_amount' => 0, 
                        'left_amount' => 0, 
                        'balance' => $chain->balance += $amount/100 * 80,
                        'auto_wallet' => $chain->auto_wallet += $amount/100 * 20,
                        'r_earning' => $chain->r_earning += $amount,
                    ]);
                    Earning::create([
                        "user_id" => $chain->id,
                        "price" => $amount,
                        "type" => 'matching_income'
                    ]);
                    $matching_income= CompanyAccount::matching_income();
                    $matching_income->update([
                        'balance' => $matching_income->balance -= $amount,
                    ]);
                }
            }
            $chain = $referrral_chain;
            if($referrral_chain->id == $user->main_owner)
            {
                $i = 1000;
               RefferralHelper::ownerMatching($chain);
            }
        }
    }
    public static function MatchingEarningForRight($chain,$user,$matching_income)
    {
        for($i = 0;$i < 1000;$i++)
            {
                $referrral_chain = User::where('right_refferal',$chain->id)->first();
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
                            'balance' => $chain->balance += $amount/100 * 80,
                            'auto_wallet' => $chain->auto_wallet += $amount/100 * 20,
                            'r_earning' => $chain->r_earning += $amount,
                        ]);
                        Earning::create([
                            "user_id" => $chain->id,
                            "price" => $amount,
                            "type" => 'matching_income'
                        ]);
                        $matching_income= CompanyAccount::matching_income();
                        $matching_income->update([
                            'balance' => $matching_income->balance -= $amount,
                        ]);
                    }
                }else if($chain->right_amount > $chain->left_amount)
                {
                    $amount = $chain->left_amount*2;
                    if($amount > 0)
                    {
                        $chain->update([
                            'right_amount' => $chain->right_amount -= $amount, 
                            'left_amount' => 0, 
                            'balance' => $chain->balance += $amount/100 * 80,
                            'auto_wallet' => $chain->auto_wallet += $amount/100 * 20,
                            'r_earning' => $chain->r_earning += $amount,
                        ]);
                        Earning::create([
                            "user_id" => $chain->id,
                            "price" => $amount,
                            "type" => 'matching_income'
                        ]);
                        $matching_income= CompanyAccount::matching_income();
                        $matching_income->update([
                            'balance' => $matching_income->balance -= $amount,
                        ]);
                    }
                }else{
                    $amount = $chain->left_amount*2;
                    if($amount > 0)
                    {
                        $chain->update([
                            'right_amount' => 0, 
                            'left_amount' => 0, 
                            'balance' => $chain->balance += $amount/100 * 80,
                            'auto_wallet' => $chain->auto_wallet += $amount/100 * 20,
                            'r_earning' => $chain->r_earning += $amount,
                        ]);
                        Earning::create([
                            "user_id" => $chain->id,
                            "price" => $amount,
                            "type" => 'matching_income'
                        ]);
                        $matching_income= CompanyAccount::matching_income();
                        $matching_income->update([
                            'balance' => $matching_income->balance -= $amount,
                        ]);
                    }
                }
                $chain = $referrral_chain;
                if($referrral_chain->id == $user->main_owner)
                {
                    RefferralHelper::ownerMatching($chain);
                    $i = 1000;
                }
            }
    }
    public static function ownerMatching($chain)
    {
        if($chain->left_amount > $chain->right_amount)
        {
            $amount = $chain->right_amount*2;
            if($amount > 0)
            {
                $chain->update([
                    'right_amount' => 0, 
                    'left_amount' => $chain->left_amount -= $amount, 
                    'balance' => $chain->balance += $amount/100 * 80,
                    'auto_wallet' => $chain->auto_wallet += $amount/100 * 20,
                    'r_earning' => $chain->r_earning += $amount,
                ]);
                Earning::create([
                    "user_id" => $chain->id,
                    "price" => $amount,
                    "type" => 'matching_income'
                ]);
                $matching_income= CompanyAccount::matching_income();
                $matching_income->update([
                    'balance' => $matching_income->balance -= $amount,
                ]);
            }
        }else if($chain->right_amount > $chain->left_amount)
        {
            $amount = $chain->left_amount*2;
            if($amount > 0)
            {
                $chain->update([
                    'right_amount' => $chain->right_amount -= $amount, 
                    'left_amount' => 0, 
                    'balance' => $chain->balance += $amount/100 * 80,
                    'auto_wallet' => $chain->auto_wallet += $amount/100 * 20,
                    'r_earning' => $chain->r_earning += $amount,
                ]);
                Earning::create([
                    "user_id" => $chain->id,
                    "price" => $amount,
                    "type" => 'matching_income'
                ]);
                $matching_income= CompanyAccount::matching_income();
                $matching_income->update([
                    'balance' => $matching_income->balance -= $amount,
                ]);
            }
        }else{
            $amount = $chain->left_amount*2;
            if($amount > 0)
            {
                $chain->update([
                    'right_amount' => 0, 
                    'left_amount' => 0, 
                    'balance' => $chain->balance += $amount/100 * 80,
                    'auto_wallet' => $chain->auto_wallet += $amount/100 * 20,
                    'r_earning' => $chain->r_earning += $amount,
                ]);
                Earning::create([
                    "user_id" => $chain->id,
                    "price" => $amount,
                    "type" => 'matching_income'
                ]);
                $matching_income= CompanyAccount::matching_income();
                $matching_income->update([
                    'balance' => $matching_income->balance -= $amount,
                ]);
            }
        }
    }
}