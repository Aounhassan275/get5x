<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Deposit;
use App\Models\Earning;
use App\Models\Package;
use App\Models\Payment;
use App\Models\ReferralLog;
use App\Models\CompanyAccount;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ReferralController extends Controller
{
    public function leftReferral($id)
    {
        $user = Auth::user(); 
        $company_account= CompanyAccount::find(1);
        $owner_left_refer = User::find($id);
        $refer_by = User::find($user->refer_by);
        $deposit = Deposit::where('user_id',$user->id)->where('package_id',$user->package_id)->first();
        $direct_income = $deposit->amount/100 * 10;
        $matching_income = $deposit->amount/100 * 5;
        if($owner_left_refer->left_refferal == null)
        {
            $refer_by->update([
                'balance' => $refer_by->balance += $direct_income,
                'r_earning' => $refer_by->r_earning += $direct_income,
            ]);
            $owner_left_refer->update([
                'left_refferal' => $user->id,
                'left_amount' =>  $matching_income,
            ]);
            $user->update([
                'top_referral' => 'Done',
            ]);
            Earning::create([
                "user_id" => $refer_by->id,
                "price" => $direct_income,
                "type" => 'direct_income'
            ]);
            $company_account->update([
                'balance' => $company_account->balance -= $direct_income,
            ]);
            $chain = $owner_left_refer;
            for($i = 0;$i < 1000;$i++)
            {
                $referrral_chain = User::where('left_refferal',$chain->id)->orWhere('right_refferal',$chain->id)->first();
                Log::info('Matching Earning to ' . $referrral_chain->name);
                if($referrral_chain->left_refferal == $chain->id)
                {
                    $referrral_chain->update([
                        'left_amount' =>   $referrral_chain->left_amount += $matching_income,
                    ]);
                }else{
                    $referrral_chain->update([
                        'right_amount' =>   $referrral_chain->right_amount += $matching_income,
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
                        $company_account->update([
                            'balance' => $company_account->balance -= $amount,
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
                            'balance' => $chain->balance += $amount,
                            'r_earning' => $chain->r_earning += $amount,
                        ]);
                        Earning::create([
                            "user_id" => $chain->id,
                            "price" => $amount,
                            "type" => 'matching_income'
                        ]);
                        $company_account->update([
                            'balance' => $company_account->balance -= $amount,
                        ]);
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
                        $company_account->update([
                            'balance' => $company_account->balance -= $amount,
                        ]);
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
                            $company_account->update([
                                'balance' => $company_account->balance -= $amount,
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
                                'balance' => $chain->balance += $amount,
                                'r_earning' => $chain->r_earning += $amount,
                            ]);
                            Earning::create([
                                "user_id" => $chain->id,
                                "price" => $amount,
                                "type" => 'matching_income'
                            ]);
                            $company_account->update([
                                'balance' => $company_account->balance -= $amount,
                            ]);
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
                            $company_account->update([
                                'balance' => $company_account->balance -= $amount,
                            ]);
                        }
                    }
                    $i = 1000;
                }
            }
        }
       
        // if($owner_left_refer->left_refferal != null &&  $owner_left_refer->right_refferal != null )
        // {
        //     if($owner_left_refer->left_amount > $owner_left_refer->right_amount)
        //     {
        //         $owner_left_refer->update([
        //             'balance' => $owner_left_refer->balance += $owner_left_refer->right_amount*2,
        //             'r_earning' => $owner_left_refer->r_earning += $owner_left_refer->right_amount*2,
        //         ]);
        //         Earning::create([
        //             "user_id" => $owner_left_refer->id,
        //             "price" => $owner_left_refer->right_amount*2,
        //             "type" => 'matching_income'
        //         ]);
        //         $company_account->update([
        //             'balance' => $company_account->balance -= $owner_left_refer->right_amount*2,
        //         ]);
        //     }else{
        //         $owner_left_refer->update([
        //             'balance' => $owner_left_refer->balance += $owner_left_refer->left_amount*2,
        //             'r_earning' => $owner_left_refer->r_earning += $owner_left_refer->left_amount*2,
        //         ]);
        //         Earning::create([
        //             "user_id" => $owner_left_refer->id,
        //             "price" => $owner_left_refer->left_amount*2,
        //             "type" => 'matching_income'
        //         ]);
        //         $company_account->update([
        //             'balance' => $company_account->balance -= $owner_left_refer->left_amount*2,
        //         ]);
        //     }
        // }
        // $main_owner = User::find($user->main_owner);
        // if($main_owner->main_owner_referral->count() > 0 && $user->refer_by != $main_owner->id)
        // {
        //     $total_left = $main_owner->main_owner_referral->where('refer_type','Left')->count();
        //     $total_right = $main_owner->main_owner_referral->where('refer_type','Right')->count();
        //     if($total_left == $total_right)
        //     {
        //         $last_left_refferal = $main_owner->main_owner_referral->where('refer_type','Left')->last();
        //         if($last_left_refferal->left_amount > $last_left_refferal->right_amount)
        //         {
        //             $referral_left_amount = $last_left_refferal->right_amount; 
        //         }else{
        //             $referral_left_amount = $last_left_refferal->left_amount; 
        //         }
        //         $last_right_refferal = $main_owner->main_owner_referral->where('refer_type','Right')->last();
        //         if($last_right_refferal->left_amount > $last_right_refferal->right_amount)
        //         {
        //             $referral_right_amount = $last_right_refferal->right_amount; 
        //         }else{
        //             $referral_right_amount = $last_right_refferal->left_amount; 
        //         }
        //         if($referral_right_amount > $referral_left_amount)
        //         {
        //             $total_amount = $referral_left_amount; 
        //         }else{
        //             $total_amount = $referral_right_amount; 
        //         }
        //         $main_owner->update([
        //             'balance' => $main_owner->balance += $total_amount*2,
        //             'r_earning' => $main_owner->r_earning += $total_amount*2,
        //         ]);
        //         Earning::create([
        //             "user_id" => $main_owner->id,
        //             "price" => $total_amount*2,
        //             "type" => 'matching_income'
        //         ]);
        //         $company_account->update([
        //             'balance' => $company_account->balance -= $total_amount*2,
        //         ]);
        //     }
        // }
        // if($main_owner->main_owner_left->where('refer_type','Left')->count() == $main_owner->main_owner_right->where('refer_type','Right')->count())
        // {
        //     $last_left_ = $main_owner->main_owner_left->where('refer_type','Left')->last();
        //     $last_right= $main_owner->main_owner_right->where('refer_type','Right')->last();
        //     if($last_left_ != null && $last_right == null)
        //     {
        //         $logs = ReferralLog::where('leftUser',$last_left_->id)->where('rightUser',$last_right)
        //         ->where('main_owner',$main_owner)->first();
        //         if($logs == null)
        //         {
        //             if($last_left_->left_amount > $last_right->right_amount)
        //             {
        //                 $total_amounts = $last_right->right_amount; 
        //             }else{
        //                 $total_amounts = $last_left_->left_amount; 
        //             }
        //             $main_owner->update([
        //                 'balance' => $main_owner->balance += $total_amounts*2,
        //                 'r_earning' => $main_owner->r_earning += $total_amounts*2,
        //             ]);
        //             Earning::create([
        //                 "user_id" => $main_owner->id,
        //                 "price" => $total_amounts*2,
        //                 "type" => 'matching_income'
        //             ]);
        //             $company_account->update([
        //                 'balance' => $company_account->balance -= $total_amount*2,
        //             ]);
        //             ReferralLog::create([
        //                 "main_owner" => $main_owner->id,
        //                 "leftUser" => $last_left_->id,
        //                 "rightUser" => $last_right->id,
        //                 "amount" => $total_amounts*2,
        //                 "countLeft" => $main_owner->main_owner_left->where('refer_type','Left')->count(),
        //                 "countRight" => $main_owner->main_owner_right->where('refer_type','Right')->count(),
        //                 "type" => 'matching_income'
        //             ]);
        //         }
        //     }            
        // }
        // Auth::logout();
        toastr()->success('You Added In Tree Successfully.');
        return redirect('user/dashboard');
    }
    public function showTree($id)
    {
        $user = User::find($id);
        if($user->checkStatus() == 'expired')   
        {
          toastr()->success('Your Package is Expire');
           return redirect(route('user.dashboard.index'));
        }
        // if($user->main_owner != Auth::user()->main_owner)
        // {
        //     toastr()->warning('You are Not Authorize To See this');
        // return redirect()->back();
        // }
        $left = null;
        $right = null;
        if($user->left_refferal)
        {
            $left = User::find($user->left_refferal);
        }
        if($user->right_refferal)
        {
            $right = User::find($user->right_refferal);
        }
        // dd($user);
        return view('user.refer.user_tree')->with('user',$user)->with('left',$left)->with('right',$right);
   
    }    
    public function showRightLeg($id)
    {
        $user = User::find($id);
        if($user->checkStatus() == 'expired')   
        {
          toastr()->success('Your Package is Expire');
           return redirect(route('user.dashboard.index'));
        }
        return view('user.refer.right_refferal')->with('user',$user);
    }
    public function showLeftLeg($id)
    {
        $user = User::find($id);
        if($user->checkStatus() == 'expired')   
        {
          toastr()->success('Your Package is Expire');
           return redirect(route('user.dashboard.index'));
        }
        return view('user.refer.left_refferal')->with('user',$user);
    }
    public function RightReferral($id)
    {
        $user = Auth::user(); 
        if($user->checkStatus() == 'expired')   
        {
          toastr()->success('Your Package is Expire');
           return redirect(route('user.dashboard.index'));
        }
        $company_account= CompanyAccount::find(1);
        $owner_right_refer = User::find($id);
        $refer_by = User::find($user->refer_by);
        $deposit = Deposit::where('user_id',$user->id)->where('package_id',$user->package_id)->first();
        $direct_income = $deposit->amount/100 * 10;
        $matching_income = $deposit->amount/100 * 5;
        if($owner_right_refer->right_refferal == null)
        {
            $refer_by->update([
                'balance' => $refer_by->balance += $direct_income,
                'r_earning' => $refer_by->r_earning += $direct_income,
            ]);
            $owner_right_refer->update([
                'right_refferal' => $user->id,
                'right_amount' =>  $matching_income,
            ]);
            $user->update([
                'top_referral' => 'Done',
            ]);
            Earning::create([
                "user_id" => $refer_by->id,
                "price" => $direct_income,
                "type" => 'direct_income'
            ]);
            $company_account->update([
                'balance' => $company_account->balance -= $direct_income,
            ]);
            $chain = $owner_right_refer;
            for($i = 0;$i < 1000;$i++)
            {
                $referrral_chain = User::where('left_refferal',$chain->id)->orWhere('right_refferal',$chain->id)->first();
                if($referrral_chain->left_refferal == $chain->id)
                {
                    $referrral_chain->update([
                        'left_amount' =>   $referrral_chain->left_amount += $matching_income,
                    ]);
                }else{
                    $referrral_chain->update([
                        'right_amount' =>   $referrral_chain->right_amount += $matching_income,
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
                        $company_account->update([
                            'balance' => $company_account->balance -= $amount,
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
                            'balance' => $chain->balance += $amount,
                            'r_earning' => $chain->r_earning += $amount,
                        ]);
                        Earning::create([
                            "user_id" => $chain->id,
                            "price" => $amount,
                            "type" => 'matching_income'
                        ]);
                        $company_account->update([
                            'balance' => $company_account->balance -= $amount,
                        ]);
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
                        $company_account->update([
                            'balance' => $company_account->balance -= $amount,
                        ]);
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
                            $company_account->update([
                                'balance' => $company_account->balance -= $amount,
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
                                'balance' => $chain->balance += $amount,
                                'r_earning' => $chain->r_earning += $amount,
                            ]);
                            Earning::create([
                                "user_id" => $chain->id,
                                "price" => $amount,
                                "type" => 'matching_income'
                            ]);
                            $company_account->update([
                                'balance' => $company_account->balance -= $amount,
                            ]);
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
                            $company_account->update([
                                'balance' => $company_account->balance -= $amount,
                            ]);
                        }
                    }
                    $i = 1000;
                }
            }
        }
        
        // if($owner_right_refer->left_refferal != null &&  $owner_right_refer->right_refferal != null )
        // {
        //     if($owner_right_refer->left_amount > $owner_right_refer->right_amount)
        //     {
        //         $owner_right_refer->update([
        //             'balance' => $owner_right_refer->balance += $owner_right_refer->right_amount*2,
        //             'r_earning' => $owner_right_refer->r_earning += $owner_right_refer->right_amount*2,
        //         ]);
        //         Earning::create([
        //             "user_id" => $owner_right_refer->id,
        //             "price" => $owner_right_refer->right_amount*2,
        //             "type" => 'matching_income'
        //         ]);
        //         $company_account->update([
        //             'balance' => $company_account->balance -= $owner_right_refer->right_amount*2,
        //         ]);
        //     }else{
        //         $owner_right_refer->update([
        //             'balance' => $owner_right_refer->balance += $owner_right_refer->left_amount*2,
        //             'r_earning' => $owner_right_refer->r_earning += $owner_right_refer->left_amount*2,
        //         ]);
        //         Earning::create([
        //             "user_id" => $owner_right_refer->id,
        //             "price" => $owner_right_refer->left_amount*2,
        //             "type" => 'matching_income'
        //         ]);
        //         $company_account->update([
        //             'balance' => $company_account->balance -= $owner_right_refer->left_amount*2,
        //         ]);
        //     }
        // }
        // $main_owner = User::find($user->main_owner);
        // if($main_owner->main_owner_referral->count() > 0 && $user->refer_by != $main_owner->id)
        // {
        //     $total_left = $main_owner->main_owner_referral->where('refer_type','Left')->count();
        //     $total_right = $main_owner->main_owner_referral->where('refer_type','Right')->count();
        //     if($total_left == $total_right)
        //     {
        //         $last_left_refferal = $main_owner->main_owner_referral->where('refer_type','Left')->last();
        //         if($last_left_refferal->left_amount > $last_left_refferal->right_amount)
        //         {
        //             $referral_left_amount = $last_left_refferal->right_amount; 
        //         }else{
        //             $referral_left_amount = $last_left_refferal->left_amount; 
        //         }
        //         $last_right_refferal = $main_owner->main_owner_referral->where('refer_type','Right')->last();
        //         if($last_right_refferal->left_amount > $last_right_refferal->right_amount)
        //         {
        //             $referral_right_amount = $last_right_refferal->right_amount; 
        //         }else{
        //             $referral_right_amount = $last_right_refferal->left_amount; 
        //         }
        //         if($referral_right_amount > $referral_left_amount)
        //         {
        //             $total_amount = $referral_left_amount; 
        //         }else{
        //             $total_amount = $referral_right_amount; 
        //         }
        //         $main_owner->update([
        //             'balance' => $main_owner->balance += $total_amount*2,
        //             'r_earning' => $main_owner->r_earning += $total_amount*2,
        //         ]);
        //         Earning::create([
        //             "user_id" => $main_owner->id,
        //             "price" => $total_amount*2,
        //             "type" => 'matching_income'
        //         ]);
        //         $company_account->update([
        //             'balance' => $company_account->balance -= $total_amount*2,
        //         ]);
        //     }
        // }
        // if($main_owner->main_owner_left->where('refer_type','Left')->count() == $main_owner->main_owner_right->where('refer_type','Right')->count())
        // {
        //     $last_left_ = $main_owner->main_owner_left->where('refer_type','Left')->last();
        //     $last_right= $main_owner->main_owner_right->where('refer_type','Right')->last();
        //     if($last_left_ != null && $last_right == null)
        //     {
        //         $logs = ReferralLog::where('leftUser',$last_left_->id)->where('rightUser',$last_right)
        //         ->where('main_owner',$main_owner)->first();
        //         if($logs == null)
        //         {
        //             if($last_left_->left_amount > $last_right->right_amount)
        //             {
        //                 $total_amounts = $last_right->right_amount; 
        //             }else{
        //                 $total_amounts = $last_left_->left_amount; 
        //             }
        //             $main_owner->update([
        //                 'balance' => $main_owner->balance += $total_amounts*2,
        //                 'r_earning' => $main_owner->r_earning += $total_amounts*2,
        //             ]);
        //             Earning::create([
        //                 "user_id" => $main_owner->id,
        //                 "price" => $total_amounts*2,
        //                 "type" => 'matching_income'
        //             ]);
        //             $company_account->update([
        //                 'balance' => $company_account->balance -= $total_amount*2,
        //             ]);
        //             ReferralLog::create([
        //                 "main_owner" => $main_owner->id,
        //                 "leftUser" => $last_left_->id,
        //                 "rightUser" => $last_right->id,
        //                 "amount" => $total_amounts*2,
        //                 "countLeft" => $main_owner->main_owner_left->where('refer_type','Left')->count(),
        //                 "countRight" => $main_owner->main_owner_right->where('refer_type','Right')->count(),
        //                 "type" => 'matching_income'
        //             ]);
        //         }
        //     }
           
            
        // }
        // Auth::logout();
        toastr()->success('You Added In Tree Successfully.');
        return redirect('user/dashboard');
    }
}
