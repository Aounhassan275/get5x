@extends('user.layout.index')
@section('meta')
    
<title>{{$product->name}} | GET 5X</title>
<meta name="description" content="Multipurpose HTML template.">
@endsection

@section('content')
<div class="product-big-title-area">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="product-bit-title text-center">
					<h2>{{$product->name}}</h2>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="single-product-area">
	<div class="zigzag-bottom"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="product-content-right">
					<div class="product-breadcroumb">
						<a href="{{url('/')}}">Home</a>
						<a href="{{route('user.product.index')}}">Products</a>
						<a href="#">{{@$product->name}}</a>
					</div>
					
					<div class="row">
						<div class="col-sm-6">
							<div class="product-images">
								<div class="product-main-img">
									<img src="{{asset($product->images->first()->image)}}" alt="">
								</div>
								
								<div class="product-gallery">
									@foreach($product->images as $image)
									<img src="{{asset($image->image)}}" alt="">
									@endforeach
								</div>
							</div>
						</div>
						
						<div class="col-sm-6">
							<div class="product-inner">
								<h2 class="product-name">{{@$product->name}}</h2>
								<div class="product-inner-price">
									<ins>PKR {{$product->price}}</ins>
								</div>   
								<div class="product-inner-category">
									<p>Category: <a href="{{route('category.show',str_replace(' ', '_',$product->category->name))}}">{{@$product->category->name}}</a>.</p>
									<p>Brand: <a href="{{route('brand.show',str_replace(' ', '_',$product->brand->name))}}">{{@$product->brand->name}}</a>.</p>
									<p>Phone: <a href="tel:{{@$product->phone}}">{{@$product->phone}}</a>.</p>
									<a href="{{route('user.product.order',$product->id)}}" class="btn btn-primary">Order Products</a>
								</div> 
								
								<div role="tabpanel">
									<ul class="product-tab" role="tablist">
										<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
									</ul>
									<div class="tab-content">
										<div role="tabpanel" class="tab-pane fade in active" id="home">
											<h2>Product Description</h2>  
											<p>{!! @$product->description !!}</p>

										</div>
									</div>
								</div>
								
							</div>
						</div>
					</div>
				</div>                    
			</div>
		</div>
	</div>
</div>
@endsection