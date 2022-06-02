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
            $all_lefts = $user->getOrginalUpperLeft();
            foreach($all_lefts as $key =>  $upper_left)
            {
                if($key == 0)
                {
                    $upper_left->matchingEarning($user->id,$matching_income);
                }else{
                    $upper_left->matchingEarning($all_lefts[$key-1]->id,$matching_income);
                }
                RefferralHelper::ownerMatching($upper_left);
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
            $all_lefts = $user->getOrginalUpperLeft();
            foreach($all_lefts as $key =>  $upper_left)
            {
                if($key == 0)
                {
                    $upper_left->matchingEarning($user->id,$matching_income);
                }else{
                    $upper_left->matchingEarning($all_lefts[$key-1]->id,$matching_income);
                }
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
            $all_rights = $user->getOrginalUpperRight();
            foreach($all_rights as $key =>  $upper_right)
            {
                if($key == 0)
                {
                    $upper_right->matchingEarning($user->id,$matching_income);
                }else{                    
                    $upper_right->matchingEarning($all_rights[$key-1]->id,$matching_income);
                }
                RefferralHelper::ownerMatching($upper_right);
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
            Earning::create([
                "user_id" => $refer_by->id,
                "price" => $direct_income,
                "type" => 'direct_income'
            ]);
            $user->update([
                'top_referral' => 'Done',
            ]);
            $all_rights = $user->getOrginalUpperRight();
            foreach($all_rights as $key =>  $upper_right)
            {
                if($key == 0)
                {
                    $upper_right->matchingEarning($user->id,$matching_income);
                }else{                    
                    $upper_right->matchingEarning($all_rights[$key-1]->id,$matching_income);
                }
                RefferralHelper::ownerMatching($upper_right);
            }
        }
    }
    public static function MatchingEarningForLeft($chain,$user,$matching_income)
    {
        for($i = 0;$i < 1000;$i++)
        {
            $refferral = User::where('left_refferal',$chain->id)->first();
            if($refferral)
            {
                $refferral->matchingEarning($chain->id,$matching_income);
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
            $chain = $refferral;
            if($chain)
            {
                if($chain->id == $user->main_owner)
                {
                    $i = 1000;
                    RefferralHelper::ownerMatching($chain);
                }
            }
        }
    }
    public static function MatchingEarningForRight($chain,$user,$matching_income)
    {
        for($i = 0;$i < 1000;$i++)
            {
                $refferral = User::where('right_refferal',$chain->id)->first();
                if($refferral)
                {
                    $refferral->matchingEarning($chain->id,$matching_income);
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
                $chain = $refferral;
                if($chain)
                {
                    if($chain->id == $user->main_owner)
                    {
                        $i = 1000;
                        RefferralHelper::ownerMatching($chain);
                    }
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