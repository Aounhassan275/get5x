@extends('front.layout.index')
@section('meta')
    
<title>BRANDS | GET 5X</title>
<meta name="description" content="Multipurpose HTML template.">
@endsection

@section('content')

<div class="product-big-title-area">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="product-bit-title text-center">
					<h2>ALL BRANDS</h2>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="promo-area">
	<div class="zigzag-bottom"></div>
	<div class="container">
		<div class="row">
			@foreach($brands as $brand)
			<div class="col-md-3 col-sm-6">
					<div class="single-promo promo4">
						<i class="fa fa-gift"></i>
						<a href="{{route('brand.show',str_replace(' ', '_',$brand->name))}}" style="color:white;">
							<p>{{$brand->name}} ({{$brand->products->count()}})</p>
						</a>

					</div>
			</div>
			@endforeach
			{!! $brands->links() !!}
		</div>
	</div>
</div> <!-- End promo area -->
@endsection