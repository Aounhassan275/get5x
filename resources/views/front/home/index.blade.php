@extends('front.layout.index')
@section('meta')
    
<title>HOME | GET 5X</title>
<meta name="description" content="Multipurpose HTML template.">
@endsection

@section('content')

<div class="slider-area">
    <!-- Slider -->
    <div class="block-slider block-slider4">
        <ul class="" id="bxslider-home4">
            <li>
                <img src="{{asset('front/img/h4-slide.png')}}" alt="Slide">
                {{-- <div class="caption-group">
                    <h2 class="caption title">
                        iPhone <span class="primary">6 <strong>Plus</strong></span>
                    </h2>
                    <h4 class="caption subtitle">Dual SIM</h4>
                    <a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a>
                </div> --}}
            </li>
            <li><img src="{{asset('front/img/h4-slide2.png')}}" alt="Slide">
                {{-- <div class="caption-group">
                    <h2 class="caption title">
                        by one, get one <span class="primary">50% <strong>off</strong></span>
                    </h2>
                    <h4 class="caption subtitle">school supplies & backpacks.*</h4>
                    <a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a>
                </div> --}}
            </li>
            <li><img src="{{asset('front/img/h4-slide3.png')}}" alt="Slide">
                {{-- <div class="caption-group">
                    <h2 class="caption title">
                        Apple <span class="primary">Store <strong>Ipod</strong></span>
                    </h2>
                    <h4 class="caption subtitle">Select Item</h4>
                    <a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a>
                </div> --}}
            </li>
            <li><img src="{{asset('front/img/h4-slide4.png')}}" alt="Slide">
                <div class="caption-group">
                  <h2 class="caption title">
                        Apple <span class="primary">Store <strong>Ipod</strong></span>
                    </h2>
                    <h4 class="caption subtitle">& Phone</h4>
                    <a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a>
                </div>
            </li>
        </ul>
    </div>
    <!-- ./Slider -->
</div> <!-- End slider area -->


<div class="maincontent-area">
<div class="zigzag-bottom"></div>
<div class="container">
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <h2 class="section-title">Latest Products</h2>
                @foreach(App\Models\Product::where('user_id',null)->take(18)->get() as $product)
                <div class="col-md-3 col-sm-6">
                    <div class="single-shop-product">
                        <div class="product-upper">
                            <img src="{{asset(@$product->images->first()->image)}}" alt="">
                        </div>
                        <h2><a href="{{route('product.show',str_replace(' ', '_',$product->name))}}">{{@$product->name}}</a></h2>
                        <div class="product-carousel-price">
                            <ins>PKR {{@$product->price}}</ins>
                        </div>  
                        
                        <div class="product-option-shop">
                            <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="{{route('product.show',str_replace(' ', '_',$product->name))}}">View Product</a>
                        </div>                       
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
</div> <!-- End main content area -->
<div class="product-widget-area">
<div class="zigzag-bottom"></div>
</div> <!-- End product widget area -->
@endsection