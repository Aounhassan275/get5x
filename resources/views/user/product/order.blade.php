@extends('user.layout.index')
@section('meta')
    
<title>Orders | GET 5X</title>
<meta name="description" content="Multipurpose HTML template.">
@endsection

@section('content')
<div class="product-big-title-area">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="product-bit-title text-center">
					<h2>ORDERS</h2>
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
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Delivery Charges</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tfoot>
                            @foreach (Auth::user()->orders as $key => $order)
                                <tr class="cart-subtotal">
                                    <td>{{$key + 1}}</td>
                                    <td>{{$order->product->name}}</td>
                                    <td >PKR {{$order->price}}</td>
                                    <td >PKR {{$order->delivery_cost}}</td>
                                    <td >{{$order->address}}</td>
                                    <td >{{$order->status}}</td>
                                    <td >{{$order->created_at->format('M d,Y h:i A')}}</td>
                    
                                </tr>
                            @endforeach
                            <tr class="cart-subtotal"> 
                                <td ></td>
                                <td ></td>
                                <td ></td>
                                <td ></td>
                                <td ></td>
                                <td >Total Orders Amount:</td>
                                <td >PKR {{Auth::user()->orders()->sum('price','delivery_cost') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection