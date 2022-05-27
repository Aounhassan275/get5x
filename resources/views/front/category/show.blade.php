@extends('front.layout.index')
@section('meta')
    
<title>{{$category->name}} PRODUCTS | GET 5X</title>
<meta name="description" content="Multipurpose HTML template.">
@endsection

@section('content')
<div class="product-big-title-area">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="product-bit-title text-center">
					<h2>{{$category->name}} PRODUCTS</h2>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="single-product-area">
	<div class="zigzag-bottom"></div>
	<div class="container">
		<div class="row">
			@foreach($products as $product)
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
		
		<div class="row">
			<div class="col-md-12">
				<div class="product-pagination text-center">
					<nav>
					  <ul class="pagination">
						<li>
						  {{$products->links()}}
						</li>
					  </ul>
					</nav>                        
				</div>
			</div>
		</div>
	</div>
</div>
@endsection