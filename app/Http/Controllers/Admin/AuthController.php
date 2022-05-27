<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyAccount;
use App\Models\Earning;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        $creds = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if(Auth::guard('admin')->attempt($creds))
        {
            toastr()->success('You Login Successfully');
            return redirect()->intended(route('admin.dashboard.index'));
        } else {
            return redirect()->back();
        }
    }
    
    public function logout()
    {
        Auth::logout();
        toastr()->success('You Logout Successfully');
        return redirect('/');
    }
    public function add_earning()
    {
        info("Ads Earning Conrjob Started At" . date("d-M-Y h:i a"));
		$day = date('Y-m-d', strtotime("-1 days"));
		info("Ads Earning CRONJOB:   $day");
        $users = User::where('a_date','!=',null)
                ->get();
        $company_account= CompanyAccount::find(1);
		if ($users) {
            $total_users = $users->count();
            info("Ads Earning CRONJOB Total Users : $total_users");
            foreach($users as $user)
            {
                info("Ads Earning CRONJOB User : $user->name");
                $earning = Earning::where('type','ad_earning')->where('created_at',$day)->first();
                if(!$earning && $user->checkstatus() !='expired')
                {
                    info("Ads Earning CRONJOB Don't have earning");
                    $amount = $user->package->day/$user->package->ads;
                    if($user->balance >= $amount)
                    {
                        info("Ads Earning CRONJOB $user->name balance is $user->balance more than $amount ad earning");
                        $company_account->update([
                            'balance' => $company_account->balance += $user->package->day/$user->package->ads,
                        ]);
                        $user->balance-=($user->package->day/$user->package->ads);
                        $user->save();
                    }else{
                        info("Ads Earning CRONJOB $user->name balance is $user->balance less than $amount ad earning");
                    }
                }else{
                    info("Ads Earning CRONJOB have ad earning");
                }
            }

		} else {
			info("Ads Earning CRONJOB CRONJOB: Users not found. ");
		}
		info("Ads Earning CRONJOB CRONJOB END AT " . date("d-M-Y h:i a"));
    }
    public function block_users()
    {
        info("Expire User Conrjob Started At" . date("d-M-Y h:i a"));
        $users = User::where('a_date','!=',null)
                ->get();
		if ($users) {
            $total_users = $users->count();
            info("Expire User CRONJOB Total Users : $total_users");
            foreach($users as $user)
            {
                info("Expire User CRONJOB User : $user->name");
                if($user->checkstatus() =='expired')
                {
                    info("Ads Earning CRONJOB Don't have earning");
                    $user->status = 'block';
                    $user->balance = 0;
                    $user->save();    
                }
            }

		} else {
			info("Expire User CRONJOB: Users not found. ");
		}
		info("Expire User CRONJOB END AT " . date("d-M-Y h:i a"));
    }
}
