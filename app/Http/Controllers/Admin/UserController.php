<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showDetail($id)
    {
      $user = User::find($id);
      $placement = User::where('left_refferal',$user->id)->orWhere('right_refferal',$user->id)->get();
      return view('admin.user.detail',compact('user','placement'));
    }
    public function delete($id){
      User::find($id)->delete();
      toastr()->success('User  is Deleted Successfully');
      return redirect()->route('admin.user.index');
  }
  public function activation($id)
  {
      $user = User::find($id);
      $user->update([
          'status' => 'active',
      ]);     
      toastr()->success('User is active Now');
      return redirect()->back();
  } 
  public function block($id)
  {
      $user = User::find($id);
      $user->update([
          'status' => 'block',
      ]);     
      toastr()->success('User is block Now');
      return redirect()->back();
  }
  public function update(Request $request)
  {
      $user = User::find($request->id);
      if($request->password)
      {
          $user->update([
              'password' => $request->password
          ]);
      }
      $user->update($request->except('password'));
      toastr()->success('User is Updated Successfully');
      return redirect()->back();
  }
  public function changePlacement(Request $request)
  {
    $user = User::where('name',$request->username)->first();
    if(!$user)
    {
        toastr()->warning('User is Not Found');
        return back();
    }
    if($user->refer_type != $request->placement)
    {
        toastr()->warning('User Placement is Not Correct');
        return back();
    }
    $main_parent = User::find($request->user_id);
    $parents = User::where('left_refferal',$user->id)->orWhere('right_refferal',$user->id)->get();
    foreach($parents as $parent)
    {
        if($parent->left_refferal == $user->id)
        {
            $parent->update([
                'left_refferal' => null
            ]);
        }
        else if($parent->right_refferal == $user->id){
            $parent->update([
                'right_refferal' => null
            ]);
        }
    }
    // $user = User::find($request->id);
    if($request->placement == 'Left')
    {
        $main_parent->update([
            'left_refferal' => $user->id
        ]);
    }else if($request->placement == 'Right')
    {
        $main_parent->update([
            'right_refferal' => $user->id
        ]);
    }
    toastr()->success('User is Placement Occurred Successfully');
    return redirect()->back();
  }
  public function fakeLogin(User $user)
    {
        // Auth::logout();
        Auth::guard('user')->login($user);
        return redirect()->route('user.dashboard.index');
    }
    public function showTree($id)
    {
        $user = User::find($id);
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
        return view('admin.user.user_tree')->with('user',$user)->with('left',$left)->with('right',$right);
   
    }  
}
