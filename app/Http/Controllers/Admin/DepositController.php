<?php

namespace App\Http\Controllers\Admin;
use App\Helpers\Message;
use App\Helpers\RefferralHelper;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Deposit;
use App\Models\Earning;
use App\Models\Package;
use App\Models\ReferralLog;
use App\Models\User;
use App\Models\CompanyAccount;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    public function active($id)
    {
        $deposit = Deposit::find($id);
        $user = $deposit->user; 
        $package = Package::find($deposit->package_id);
        $company_account= CompanyAccount::company_account();
        $direct_income = $deposit->amount/100 * $package->direct_income;
        $matching_income = $deposit->amount/100 * $package->matching_income;
        if($user->refer_by && $user->checkStatus() == 'fresh')
        {
            $refer_by = User::find($user->refer_by);
            if($user->refer_type == 'Left')
            { 
                RefferralHelper::DirectLeftRefferral($user,$refer_by,$direct_income,$matching_income);
            }
            else{
                RefferralHelper::DirectRightRefferral($user,$refer_by,$direct_income,$matching_income);
            }    
            $company_account->update([
                'balance' => $company_account->balance -= $direct_income,
            ]);
            $direct_income = 0;
        }
        $user->update([
            'status' => 'active',
            'a_date' => Carbon::today(),
            'package_id' => $deposit->package_id
        ]);
        $deposit->update([
            'status' => 'old'
        ]);
        toastr()->success('User is Active Successfully');
        return redirect()->back();
    }
    public function delete($id){
        $deposit = Deposit::find($id);
        $user = $deposit->user; 
          $user->update([
            'status' => 'pending'
        ]);
        $deposit->delete();
        toastr()->success('Deposit Request is Deleted Successfully');
        return redirect()->back();
    }
    public function ManageMatchingEarning()
    {
        $users = User::where('status','active')->get();
        foreach($users as $user)
        {
            $left_price = 0;
            $right_price = 0;
            if($user->right_refferal)
            {
                $rights =  $user->getOrginalRight();
                foreach($rights as $right)
                {
                    $right_price = $right_price + $right->package->price/100 *5;
                }
            }
            if($user->left_refferal)
            {
                $lefts =  $user->getOrginalLeft();
                foreach($lefts as $left)
                {
                    $left_price = $left_price + $left->package->price/100 *5;
                }
            }
            $user->update([
            //    'left_amount' => $user->left_amount += $left_price,
               'left_amount' => 0,
            //    'right_amount' => $user->right_amount += $right_price,
               'right_amount' => 0,
            ]);
        }
        // dd($users);
        return 'Done';
    }
}
