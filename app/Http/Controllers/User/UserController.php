<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CompanyAccount;
use App\Models\Earning;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.profile.index');
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
    //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user = User::find($request->id);
        if($request->password)
        {
            $user->update([
                'password' => $request->password
            ]);
        }
        $user->update($request->except('password'));
        toastr()->success('Your Informations Updated successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
    public function refer()
    {
        $user = Auth::user();
        if($user->checkStatus() == 'expired')   
        {
          toastr()->success('Your Package is Expire');
           return redirect(route('user.dashboard.index'));
        }
        return view('user.refer.index')->with('user',$user);
    }
    public function showTree($id)
    {
        $user = User::find($id);
        if($user->checkStatus() == 'expired')   
        {
          toastr()->success('Your Package is Expire');
           return redirect(route('user.dashboard.index'));
        }
        $company_account= CompanyAccount::find(1);
        // if($user->main_owner != Auth::user()->id)
        // {
        //     toastr()->warning('You are Not Authorize To See this');
        // return redirect()->back();
        // }
        if($user->left_amount > $user->right_amount)
        {
            $amount = $user->right_amount*2;
            if($amount > 0)
            {
                $user->update([
                    'right_amount' => 0, 
                    'left_amount' => $user->left_amount -= $amount, 
                    'balance' => $user->balance += $amount,
                    'r_earning' => $user->r_earning += $amount,
                ]);
                Earning::create([
                    "user_id" => $user->id,
                    "price" => $amount,
                    "type" => 'matching_income'
                ]);
                $company_account->update([
                    'balance' => $company_account->balance -= $amount,
                ]);
            }
        }else if($user->right_amount > $user->left_amount)
        {
            $amount = $user->left_amount*2;
            if($amount > 0)
            {
                $user->update([
                    'right_amount' => $user->right_amount -= $amount, 
                    'left_amount' => 0, 
                    'balance' => $user->balance += $amount,
                    'r_earning' => $user->r_earning += $amount,
                ]);
                Earning::create([
                    "user_id" => $user->id,
                    "price" => $amount,
                    "type" => 'matching_income'
                ]);
                $company_account->update([
                    'balance' => $company_account->balance -= $amount,
                ]);
            }
        }else{
            $amount = $user->left_amount*2;
            if($amount > 0)
            {
                $user->update([
                    'right_amount' => 0, 
                    'left_amount' => 0, 
                    'balance' => $user->balance += $amount,
                    'r_earning' => $user->r_earning += $amount,
                ]);
                Earning::create([
                    "user_id" => $user->id,
                    "price" => $amount,
                    "type" => 'matching_income'
                ]);
                $company_account->update([
                    'balance' => $company_account->balance -= $amount,
                ]);
            }
        }
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
        return view('user.refer.new_tree')->with('user',$user)->with('left',$left)->with('right',$right);
    }
    
}