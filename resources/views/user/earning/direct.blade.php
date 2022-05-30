@extends('user.layout.index')
@section('content')
<div class="product-big-title-area">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="product-bit-title text-center">
					<h2>DIRECT EARNING</h2>
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
                <div id="order_review" style="position: relative;">
                    <table class="shop_table">
                        <thead>
                            <tr>
                                <th>Sr#</th>
                                <th>Date</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tfoot>
                            @foreach (Auth::user()->earnings()->where('type','direct_income')->get() as $key => $earning)
                                <tr class="cart-subtotal">
                                    <td>{{$key + 1}}</td>
                                    <td >{{$earning->created_at->format('M d,Y h:i A')}}</td>
                                    <td >PKR {{$earning->price}}</td>
                    
                                </tr>
                            @endforeach
                            <tr class="cart-subtotal"> 
                                <td ></td>
                                <td >Total Direct Income:</td>
                                <td >PKR {{Auth::user()->earnings()->where('type','direct_income')->sum('price')}}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection