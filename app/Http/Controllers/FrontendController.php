<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
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
}
