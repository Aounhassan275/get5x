<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{
    public function payment($package)
    {
      return view('user.package.payment')->with('package',$package);
    }
    public function index()
    {
      if(Auth::user()->a_date == Carbon::today())
      {
        toastr()->error('Already Purchase Package');
        return redirect()->route('user.dashboard.index');
      } 
      return view('user.package.index');
    }
    public function upgrade()
    {
      return view('user.package.upgrade');
    }
}
