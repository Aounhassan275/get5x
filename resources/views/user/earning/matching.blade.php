@extends('user.layout.index')
@section('content')
<div class="product-big-title-area">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="product-bit-title text-center">
					<h2>MACTHING EARNING</h2>
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
                            @foreach (Auth::user()->earnings()->where('type','matching_income')->get() as $key => $earning)
                            <tr class="cart-subtotal">
                                    <td>{{$key + 1}}</td>
                                    <td >{{$earning->created_at->format('M d,Y h:i A')}}</td>
                                    <td >PKR {{$earning->price}}</td>
                    
                                </tr>
                            @endforeach
                            <tr class="cart-subtotal"> 
                                <td ></td>
                                <td >Total Maching Income:</td>
                                <td >PKR {{Auth::user()->earnings()->where('type','matching_income')->sum('price')}}</td>
                            </tr>
                            <tr class="cart-subtotal"> 
                                <td ></td>
                                <td >Total Left Amount:</td>
                                <td >PKR {{Auth::user()->left_amount}}</td>
                            </tr>
                            <tr class="cart-subtotal"> 
                                <td ></td>
                                <td >Total Right Amount:</td>
                                <td >PKR {{Auth::user()->right_amount}}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection