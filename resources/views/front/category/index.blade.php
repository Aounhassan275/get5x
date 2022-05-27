@extends('front.layout.index')
@section('meta')
    
<title>CATEGORIES | GET 5X</title>
<meta name="description" content="Multipurpose HTML template.">
@endsection

@section('content')
<div class="product-big-title-area">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="product-bit-title text-center">
					<h2>ALL CATEGORIES</h2>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="promo-area">
	<div class="zigzag-bottom"></div>
	<div class="container">
		<div class="row">
			@foreach($categories as $category)
			<div class="col-md-3 col-sm-6">
					<div class="single-promo promo4">
						<i class="fa fa-gift"></i>
						<a href="{{route('category.show',str_replace(' ', '_',$category->name))}}" style="color:white;">
							<p>{{$category->name}} ({{$category->products->count()}})</p>
						</a>

					</div>
			</div>
			@endforeach
			{!! $categories->links() !!}
		</div>
	</div>
</div> <!-- End promo area -->
@endsection