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
					<h2>{{$product->name}} | ORDERS </h2>
				</div>
			</div>
		</div>
	</div>
</div>
@if(Auth::user()->orderStatus($product->price))
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form enctype="multipart/form-data" action="{{route('user.order.store')}}" class="checkout" method="post" name="checkout">
                    @csrf
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                    <input type="hidden" name="status" value="In Process">
                    <div id="customer_details" class="col2-set">
                        <div class="col-1">
                            <div class="woocommerce-billing-fields">
                                <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                    <label class="" for="billing_first_name">Name <abbr title="required" class="required">*</abbr>
                                    </label>
                                    <input type="text"  value="{{Auth::user()->name}}" readonly  placeholder="" id="billing_first_name" name="name" class="input-text ">
                                </p>
                            </div>
                        </div>

                        <div class="col-2">
                            <div class="woocommerce-shipping-fields">
                                <div class="shipping_address" style="display: block;">
                                    
                                    <p id="shipping_first_name_field" class="form-row form-row-first validate-required">
                                        <label class="" for="shipping_first_name">Price <abbr title="required" class="required">*</abbr>
                                        </label>
                                        <input type="text" name="price" readonly value="{{@$product->price}}" placeholder="" id="shipping_first_name" class="input-text ">
                                    </p>

                                </div>
                            </div>

                        </div>
                        <div class="col-2">
                            <div class="woocommerce-shipping-fields">
                                <div class="shipping_address" style="display: block;">
                                    <p id="shipping_first_name_field" class="form-row form-row-first validate-required">
                                        <label class="" for="shipping_first_name">Address <abbr title="required" class="required">*</abbr>
                                        </label>
                                        <input type="text" value="" placeholder="" id="shipping_first_name" required name="address" class="input-text ">
                                    </p>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div id="customer_details" class="col2-set">
                        <div class="col-1">
                            <div class="woocommerce-billing-fields">
                                <p id="shipping_first_name_field" class="form-row form-row-first validate-required">
                                    <label class="" for="shipping_first_name">Delivery Charges <abbr title="required" class="required">*</abbr>
                                    </label>
                                    <input type="text" name="delivery_cost" value="150" readonly placeholder="" id="shipping_first_name"  class="input-text ">
                                </p>
                            </div>
                        </div>

                        <div class="col-2">
                            <div class="woocommerce-shipping-fields">
                                <div class="shipping_address" style="display: block;">
                                    
                                    <p id="shipping_first_name_field" class="form-row form-row-first validate-required">
                                        <label class="" for="billing_country"> <abbr title="required" class="required">*</abbr>
                                        </label>
                                        <input type="submit" data-value="Create Order" value="Create Order" id="place_order" name="woocommerce_checkout_place_order" class="button alt">
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@else 
<div class="promo-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="single-promo promo3">
                    <p>
                        You Don't Have amount to purchase that product.May your Remaining Amount is {{Auth::user()->remainingProductPrice()}} is less than order amount is PKR {{$product->price}} 
                        and delivery cost is PKR 150 So may your balance in e-wallet {{Auth::user()->balance}} is less than delivery cost.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End promo area -->
@endif
@endsection