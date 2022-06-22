<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Deposit;
use App\Models\Earning;
use App\Models\Package;
use App\Models\Payment;
use App\Models\CompanyAccount;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepositController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($payment, $package)
    {
     //
    }
    public function deposit($payment, $package)
    {
        $package= Package::find($package);
        $payment= Payment::find($payment);

        return view('user.deposit.index')
            ->with('payment',$payment)
            ->with('package',$package);
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
   
        $user= User::find(Auth::user()->refer_by);
        $package= Package::find($request->package_id);
            $validator = Validator::make($request->all(),[
                't_id' => 'required|unique:deposits'
            ]);

            if($validator->fails()){
                toastr()->warning('Transaction Id already exists');
                return redirect()->back();
            }

        Deposit::create([
            'user_id' => Auth::user()->id
        ]+$request->all());

        $user = Auth::user();
        $user->update([
            'status' => 'onHold'
        ]);

        toastr()->warning('Your Deposit Request Has Been successfully Submitted.Please Wait 24 Hour For Activation.');
        
        return redirect(route('user.dashboard.index'));
    }
    public function directDeposit($id)
    {
        if(Auth::user()->balance <= 0)
        {
            toastr()->warning('Insufficiant Balance.');
            return redirect(route('user.dashboard.index'));
        }
        $user= User::find(Auth::user()->id);
        $package= Package::find($id);
        // $payment= Payment::find(1);
        $deposit = Deposit::create([
            'user_id' => Auth::user()->id,
            't_id' => uniqid(),
            'payment' => 'Own Balance',
            'package_id' => $package->id,
            'amount' => $package->price,
        ]);
        if($user->a_date)
        {
            $this->upgrade($deposit->id);
        }else{
           $this->active($deposit->id);
        }
        Auth::user()->update([
            'balance' => $user->balance -= $package->price,    
        ]);
        toastr()->warning('Your Package Active Successfully.');
        return redirect(route('user.dashboard.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function show(Deposit $deposit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function edit(Deposit $deposit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deposit $deposit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deposit $deposit)
    {
        //
    }
    public function active($id)
    {
        $deposit = Deposit::find($id);
        $user = Auth::user(); 
        $package= Package::find($deposit->package_id);
        $company_account= CompanyAccount::find(1);
        if($user->refer_by)
        {
            $refer_by = User::find($user->refer_by);
            $direct_income = $deposit->amount/100 * 10;
            $matching_income = $deposit->amount/100 * 5;
            if($user->refer_type == 'Left')
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
                        'top_referral' => 'Left',
                    ]);
                    Earning::create([
                        "user_id" => $refer_by->id,
                        "price" => $direct_income,
                        "type" => 'direct_income'
                    ]);
                    $company_account->update([
                        'balance' => $company_account->balance -= $direct_income,
                    ]);
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
                    // if($refer_by->left_refferal != null &&  $refer_by->right_refferal != null )
                    // {
                    //     if($refer_by->left_amount > $refer_by->right_amount)
                    //     {
                    //         $refer_by->update([
                    //             'balance' => $refer_by->balance += $refer_by->right_amount*2,
                    //             'r_earning' => $refer_by->r_earning += $refer_by->right_amount*2,
                    //         ]);
                    //         $company_account->update([
                    //             'balance' => $company_account->balance -= $refer_by->right_amount*2,
                    //         ]);
                    //         Earning::create([
                    //             "user_id" => $refer_by->id,
                    //             "price" => $refer_by->right_amount*2,
                    //             "type" => 'matching_income'
                    //         ]);
                    //     }else{
                    //         $refer_by->update([
                    //             'balance' => $refer_by->balance += $refer_by->left_amount*2,
                    //             'r_earning' => $refer_by->r_earning += $refer_by->left_amount*2,
                    //         ]);
                    //         Earning::create([
                    //             "user_id" => $refer_by->id,
                    //             "price" => $refer_by->left_amount*2,
                    //             "type" => 'matching_income'
                    //         ]);
                    //         $company_account->update([
                    //             'balance' => $company_account->balance -= $refer_by->left_amount*2,
                    //         ]);
                    //     }
                    // }
                }else{
                    $user->update([
                        'top_referral' => 'Pending',
                    ]);
                }
            }else{
                if($refer_by->right_refferal == null)
                {
                    $refer_by->update([
                        'right_refferal' => $user->id,
                        'balance' => $refer_by->balance += $direct_income,
                        'r_earning' => $refer_by->r_earning += $direct_income,
                        'right_amount' => $matching_income,
                    ]);
                    $user->update([
                        'top_referral' => 'Right',

                    ]);
                    Earning::create([
                        "user_id" => $refer_by->id,
                        "price" => $direct_income,
                        "type" => 'direct_income'
                    ]);
                    $company_account->update([
                        'balance' => $company_account->balance -= $direct_income,
                    ]);
                    $chain = $refer_by;
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
                    // if($refer_by->left_refferal != null &&  $refer_by->right_refferal != null )
                    // {
                    //     if($refer_by->left_amount > $refer_by->right_amount)
                    //     {
                    //         $refer_by->update([
                    //             'balance' => $refer_by->balance += $refer_by->right_amount*2,
                    //             'r_earning' => $refer_by->r_earning += $refer_by->right_amount*2,
                    //         ]);
                    //         Earning::create([
                    //             "user_id" => $refer_by->id,
                    //             "price" => $refer_by->right_amount*2,
                    //             "type" => 'matching_income'
                    //         ]);
                    //         $company_account->update([
                    //             'balance' => $company_account->balance -= $refer_by->right_amount*2,
                    //         ]);
                    //     }else{
                    //         $refer_by->update([
                    //             'balance' => $refer_by->balance += $refer_by->left_amount*2,
                    //             'r_earning' => $refer_by->r_earning += $refer_by->left_amount*2,
                    //         ]);
                    //         Earning::create([
                    //             "user_id" => $refer_by->id,
                    //             "price" => $refer_by->left_amount*2,
                    //             "type" => 'matching_income'
                    //         ]);
                    //         $company_account->update([
                    //             'balance' => $company_account->balance -= $refer_by->left_amount*2,
                    //         ]);
                    //     }
                    // }
                }else{
                    $user->update([
                        'top_referral' => 'Pending',
                    ]);
                }
            }
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
                // $last_left_ = $main_owner->main_owner_left->where('refer_type','Left')->last();
                // $last_right= $main_owner->main_owner_right->where('refer_type','Right')->last();
                // if($last_left_ != null && $last_right == null)
                // {
                //     $logs = ReferralLog::where('leftUser',$last_left_->id)->where('rightUser',$last_right)
                //     ->where('main_owner',$main_owner)->first();
                //     if($logs == null)
                //     {
                //         if($last_left_->left_amount > $last_right->right_amount)
                //         {
                //             $total_amounts = $last_right->right_amount; 
                //         }else{
                //             $total_amounts = $last_left_->left_amount; 
                //         }
                //         $main_owner->update([
                //             'balance' => $main_owner->balance += $total_amounts*2,
                //             'r_earning' => $main_owner->r_earning += $total_amounts*2,
                //         ]);
                //         Earning::create([
                //             "user_id" => $main_owner->id,
                //             "price" => $total_amounts*2,
                //             "type" => 'matching_income'
                //         ]);
                //         $company_account->update([
                //             'balance' => $company_account->balance -= $total_amount*2,
                //         ]);
                //         ReferralLog::create([
                //             "main_owner" => $main_owner->id,
                //             "leftUser" => $last_left_->id,
                //             "rightUser" => $last_right->id,
                //             "amount" => $total_amounts*2,
                //             "countLeft" => $main_owner->main_owner_left->where('refer_type','Left')->count(),
                //             "countRight" => $main_owner->main_owner_right->where('refer_type','Right')->count(),
                //             "type" => 'matching_income'
                //         ]);
                //     }
                // }
               
                
            // }
           
        }
        // dd($deposit);
        $user->update([
            'status' => 'active',
            'a_date' => Carbon::today(),
            // 'balance' => $user->balance += $deposit->amount,
            'package_id' => $deposit->package_id
        ]);
        $deposit->update([
            'status' => 'old'
        ]);
        $admin_amount = $deposit->amount/100 * 10; 
        $rasheed = Admin::where('email','adminr@pty.com')->first();
        // $admin = Admin::where('email','admin1@mail.com')->first();
        $rasheed_amount = $deposit->amount/100 * 8; 
        $taswar_amount = $deposit->amount/100 * 2; 
        if($rasheed)
        {
            $rasheed->update([
                'balance' => $rasheed->balance += $rasheed_amount
            ]);
        }
        $shahid = Admin::where('email','shahidpty@pty.com')->first();
        if($shahid)
        {
            $shahid->update([
                'balance' => $shahid->balance += $rasheed_amount
            ]);
        }
        $murtaza = Admin::where('email','murtazapty@pty.com')->first();
        if($murtaza)
        {
            $murtaza->update([
                'balance' => $murtaza->balance += $taswar_amount
            ]);
        }
        $taswar = Admin::where('email','tassawarhd@pty.com')->first();
        if($taswar)
        {
            $taswar->update([
                'balance' => $taswar->balance += $taswar_amount
            ]);
        }
        $company_amount = $deposit->amount/100 * 80; 
        $company_account->update([
            'balance' => $company_account->balance += $company_amount,
        ]);
        return 'true';
    }
    public function upgrade($id)
    {
        $deposit = Deposit::find($id);
        $user = Auth::user(); 
        $company_account= CompanyAccount::find(1);
        // dd($deposit);
        $user->update([
            'status' => 'active',
            'a_date' => Carbon::today(),
            // 'balance' => $user->balance += $deposit->amount,
            'package_id' => $deposit->package_id
        ]);
        $deposit->update([
            'status' => 'old'
        ]);
        $admin_amount = $deposit->amount/100 * 10; 
        $rasheed = Admin::where('email','adminr@pty.com')->first();
        // $admin = Admin::where('email','admin1@mail.com')->first();
        $rasheed_amount = $deposit->amount/100 * 8; 
        $taswar_amount = $deposit->amount/100 * 2; 
        if($rasheed)
        {
            $rasheed->update([
                'balance' => $rasheed->balance += $rasheed_amount
            ]);
        }
        $shahid = Admin::where('email','shahidpty@pty.com')->first();
        if($shahid)
        {
            $shahid->update([
                'balance' => $shahid->balance += $rasheed_amount
            ]);
        }
        $murtaza = Admin::where('email','murtazapty@pty.com')->first();
        if($murtaza)
        {
            $murtaza->update([
                'balance' => $murtaza->balance += $taswar_amount
            ]);
        }
        $taswar = Admin::where('email','tassawarhd@pty.com')->first();
        if($taswar)
        {
            $taswar->update([
                'balance' => $taswar->balance += $taswar_amount
            ]);
        }
        $company_amount = $deposit->amount/100 * 80; 
        $company_account->update([
            'balance' => $company_account->balance += $company_amount,
        ]);
        return 'true';
    }
}
