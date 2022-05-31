@extends('user.layout.index')
@section('content')
<div class="product-big-title-area">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="product-bit-title text-center">
					<h2>DEPOSIT in {{$payment->method}}</h2>
				</div>
			</div>
		</div>
	</div>
</div>
@if(@$payment->image)
<div class="row">
    <div class="col-12 text-center">
        <img src="{{asset($payment->image)}}" width="250px;" height="250px;">
    </div>
</div>
@endif
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form enctype="multipart/form-data" action="{{route('user.deposit.store')}}" class="checkout" method="post" name="checkout">
                    @csrf
                    <div id="customer_details" class="col2-set">
                        <div class="col-1">
                            <div class="woocommerce-billing-fields">
                                <input type="hidden" name="pakage_id" value="{{$package}}">
                                <input type="hidden" name="method" value="{{$payment}}">
                                <input type="hidden" class="form-control text-violet" name="package_id" value="{{$package->id}}">
                                
                                <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                    <label class="" for="billing_first_name">Trancation ID# <abbr title="required" class="required">*</abbr>
                                    </label>
                                    <input type="text" value="" placeholder="" id="billing_first_name" name="t_id" class="input-text ">
                                </p>
                            </div>
                        </div>

                        <div class="col-2">
                            <div class="woocommerce-shipping-fields">
                                <div class="shipping_address" style="display: block;">
                                    
                                    <p id="shipping_first_name_field" class="form-row form-row-first validate-required">
                                        <label class="" for="shipping_first_name">Deposit Amount <abbr title="required" class="required">*</abbr>
                                        </label>
                                        <input type="text" value="{{$package->price}}" readonly placeholder="" id="shipping_first_name" name="amount" class="input-text ">
                                    </p>

                                </div>
                            </div>

                        </div>
                        <div class="col-2">
                            <div class="woocommerce-shipping-fields">
                                <div class="shipping_address" style="display: block;">
                                    <p id="shipping_first_name_field" class="form-row form-row-first validate-required">
                                        <label class="" for="shipping_first_name">Payment Method <abbr title="required" class="required">*</abbr>
                                        </label>
                                        <input type="text" value="{{$payment->method}}" readonly placeholder="" id="shipping_first_name" name="payment" class="input-text ">
                                    </p>
                                </div>
                            </div>

                        </div>
                        <div class="col-2">
                            <div class="woocommerce-shipping-fields">
                                <div class="shipping_address" style="display: block;">
                                    <p id="shipping_first_name_field" class="form-row form-row-first validate-required">
                                        <label class="" for="shipping_first_name">Transcation Screenshot <abbr title="required" class="required">*</abbr>
                                        </label>
                                        <input type="file" id="shipping_first_name" required name="image" class="input-text ">
                                    </p>
                                </div>
                            </div>

                        </div>

                    </div>


                    <div id="order_review" style="position: relative;">
                        <div id="payment">

                            <div class="form-row place-order">

                                <input type="submit" data-value="Deposit Now" value="Deposit Now" id="place_order" name="woocommerce_checkout_place_order" class="button alt">


                            </div>

                            <div class="clear"></div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection