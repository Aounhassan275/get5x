<?php

namespace App\Http\Controllers;

use App\Helpers\RefferralHelper;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CompanyAccount;
use App\Models\Earning;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function showCategory()
    {
        $categories = Category::paginate(30);
        return view('front.category.index',compact('categories'));
    }
    public function showCategoryDetails($name)
    {
        $category = Category::where('name',str_replace('_', ' ',$name))->first();
        $products = Product::where('category_id',$category->id)->paginate(20);
        return view('front.category.show',compact('category','products'));
    }
    public function showBrands()
    {
        $brands = Brand::paginate(30);
        return view('front.brand.index',compact('brands'));
    }
    public function showBrandDetails($name)
    {
        $brand = Brand::where('name',str_replace('_', ' ',$name))->first();
        $products = Product::where('brand_id',$brand->id)->paginate(20);
        return view('front.brand.show',compact('brand','products'));
    }
    public function showProducts()
    {
        $products = Product::paginate(30);
        return view('front.product.index',compact('products'));
    }
    public function showProductDetails($name)
    {
        $product = Product::where('name',str_replace('_', ' ',$name))->first();
        return view('front.product.show',compact('product'));
    }
    public function autoship_cronjob()
    {
        $users = User::where('auto_wallet','500')->get();
        foreach($users as $user)
        {
            $flash_income= CompanyAccount::flash_income();
            $flash_income->update([
                'balance' => $flash_income->balance += $user->auto_wallet/100 * 40,
            ]);
            $product_income= CompanyAccount::product_income();
            $product_income->update([
                'balance' => $product_income->balance += $user->auto_wallet/100 * 40,
            ]);
            $matching_income= CompanyAccount::matching_income();
            $matching_income->update([
                'balance' => $matching_income->balance += $user->auto_wallet/100 * 10,
            ]);
            $direct_income = $user->auto_wallet/100 * 40;
            $matching_income = $user->auto_wallet/100 * 10;
            if($user->refer_by)
            {
                $e_wallet_direct = $direct_income/100 * 80;
                $auto_direct = $direct_income/100 * 20;
                $refer_by = User::find($user->refer_by);
                $refer_by->update([
                    'balance' => $refer_by->balance += $e_wallet_direct,
                    'auto_wallet' => $refer_by->auto_wallet += $auto_direct,
                    'r_earning' => $refer_by->r_earning += $direct_income,
                ]);
                Earning::create([
                    "user_id" => $refer_by->id,
                    "price" => $direct_income,
                    "type" => 'direct_income'
                ]);
                $flash_income->update([
                    'balance' => $flash_income->balance -= $direct_income,
                ]);
            }
            if($user->refer_type == 'Left')
            {
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
            }elseif($user->refer_type == 'Right')
            {
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
            }else{
                RefferralHelper::ownerMatching($user);
            }

            $flash_income->update([
                'balance' => $flash_income->balance += $user->auto_wallet/100 * 1,
            ]);
            $expense_income= CompanyAccount::expense_income();
            $expense_income->update([
                'balance' => $expense_income->balance += $user->auto_wallet/100 * 6,
            ]);
            $reward_income= CompanyAccount::reward_income();
            $reward_income->update([
                'balance' => $reward_income->balance += $user->auto_wallet/100 * 1,
            ]);
            $loss_income= CompanyAccount::loss_income();
            $loss_income->update([
                'balance' => $loss_income->balance += $user->auto_wallet/100 * 1,
            ]);
            $salary= CompanyAccount::salary();
            $salary->update([
                'balance' => $salary->balance += $user->auto_wallet/100 * 1,
            ]);
            $user->update([
                'auto_wallet' => 0
            ]);
        }
        toastr()->success('Earning Transfer Successfully');
        return back();
    }
}
