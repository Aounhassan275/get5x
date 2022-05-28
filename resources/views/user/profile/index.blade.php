@extends('user.layout.index')
@section('content')
<div class="product-big-title-area">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="product-bit-title text-center">
					<h2>PROFILE</h2>
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
                <form enctype="multipart/form-data" action="{{route('user.user.update',Auth::user()->id)}}" class="checkout" method="post" name="checkout">
                    @method('PUT')
                    @csrf
                    <div id="customer_details" class="col2-set">
                        <div class="col-1">
                            <div class="woocommerce-billing-fields">
                                <input type="hidden" name="id" class="form-control" value="{{Auth::user()->id}}">
                                <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                    <label class="" for="billing_first_name">User Name <abbr title="required" class="required">*</abbr>
                                    </label>
                                    <input type="text" readonly value="{{Auth::user()->name}}" placeholder="" id="billing_first_name" name="name" class="input-text ">
                                </p>
                            </div>
                        </div>

                        <div class="col-2">
                            <div class="woocommerce-shipping-fields">
                                <div class="shipping_address" style="display: block;">
                                    
                                    <p id="shipping_first_name_field" class="form-row form-row-first validate-required">
                                        <label class="" for="shipping_first_name">Email Address <abbr title="required" class="required">*</abbr>
                                        </label>
                                        <input type="text" value="{{Auth::user()->email}}" readonly placeholder="" id="shipping_first_name" name="email" class="input-text ">
                                    </p>

                                </div>
                            </div>

                        </div>
                        <div class="col-2">
                            <div class="woocommerce-shipping-fields">
                                <div class="shipping_address" style="display: block;">
                                    <p id="shipping_first_name_field" class="form-row form-row-first validate-required">
                                        <label class="" for="shipping_first_name">Password <abbr title="required" class="required">*</abbr>
                                        </label>
                                        <input type="password" value="" placeholder="" id="shipping_first_name" name="password" class="input-text ">
                                    </p>
                                </div>
                            </div>

                        </div>

                    </div>


                    <div id="order_review" style="position: relative;">
                        <div id="payment">

                            <div class="form-row place-order">

                                <input type="submit" data-value="Update Profile" value="Update Profile" id="place_order" name="woocommerce_checkout_place_order" class="button alt">


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