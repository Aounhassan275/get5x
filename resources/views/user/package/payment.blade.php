@extends('user.layout.index')
@section('content')
<div class="product-big-title-area">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="product-bit-title text-center">
					<h2>SELECT PACKAGE PAYMENT</h2>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            @foreach (App\Models\Payment::all() as $payment)
            <div class="col-md-6">
                <div id="order_review" style="position: relative;">
                    <table class="shop_table">
                        <thead>
                            <tr>
                                <th colspan="2" class="product-name">{{$payment->method}}</th>
                            </tr>
                        </thead>
                        <tfoot>

                            <tr class="cart-subtotal">
                                <th>Account Holder Name</th>
                                <td><span class="amount">{{$payment->name}}</span>
                                </td>
                            </tr>
                            <tr class="cart-subtotal">
                                <th>Account Number</th>
                                <td><span class="amount">{{$payment->number}}</span>
                                </td>
                            </tr>
                            @if ($payment->method =='Bank Account')
                            <tr class="cart-subtotal">
                                <th>Bank Name</th>
                                <td><span class="amount">{{$payment->bank}}</span>
                                </td>
                            </tr>
                            <tr class="cart-subtotal">
                                <th>Receiver Number</th>
                                <td><span class="amount">{{$payment->bnumber}}</span>
                                </td>
                            </tr>
                            @endif
                            <tr class="cart-subtotal">
                                <th>Action</th>
                                <td>
                                    <a href="{{route('user.deposits.index',[$payment->id,$package])}}" class="btn btn-lg btn-primary">Select</a>
                                </td>
                            </tr>

                        </tfoot>
                    </table>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
