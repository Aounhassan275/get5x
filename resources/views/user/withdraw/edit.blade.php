@extends('user.layout.index')
@section('content')
<div class="product-big-title-area">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="product-bit-title text-center">
					<h2>EDIT WITHDRAW</h2>
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
                <form enctype="multipart/form-data" action="{{route('user.withdraw.update',$withdraw->id)}}" class="checkout" method="post" name="checkout">
                    @method('PUT')
                    @csrf
                    <div id="customer_details" class="col2-set">
                        <div class="col-1">
                            <input class="form-control" type="hidden" name="id" value="{{$withdraw->id}}" required/>
                            <div class="woocommerce-billing-fields">
                                <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                    <label class="" for="billing_first_name">Withdraw Payment <abbr title="required" class="required">*</abbr>
                                    </label>
                                    <input type="text"  value="{{$withdraw->payment}}" placeholder="" id="billing_first_name" name="payment" class="input-text ">
                                </p>
                            </div>
                        </div>

                        <div class="col-2">
                            <div class="woocommerce-shipping-fields">
                                <div class="shipping_address" style="display: block;">
                                    <input class="form-control" type="hidden" name="id" value="{{$withdraw->id}}" required/>

                                    <p id="shipping_first_name_field" class="form-row form-row-first validate-required">
                                        <label class="" for="shipping_first_name">Account Holder Name <abbr title="required" class="required">*</abbr>
                                        </label>
                                        <input type="text" value="{{$withdraw->name}}" placeholder="" id="shipping_first_name" name="name" class="input-text ">
                                    </p>

                                </div>
                            </div>

                        </div>
                        <div class="col-2">
                            <div class="woocommerce-shipping-fields">
                                <div class="shipping_address" style="display: block;">
                                    <p id="shipping_first_name_field" class="form-row form-row-first validate-required">
                                        <label class="" for="shipping_first_name">Account Number <abbr title="required" class="required">*</abbr>
                                        </label>
                                        <input type="text" value="{{$withdraw->account}}" placeholder="" id="shipping_first_name" name="account" class="input-text ">
                                    </p>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div id="customer_details" class="col2-set">
                        <div class="col-1">
                            <div class="woocommerce-billing-fields">
                                <p id="billing_country_field" class="form-row form-row-wide address-field update_totals_on_change validate-required woocommerce-validated">
                                    <label class="" for="billing_country">Payment Method <abbr title="required" class="required">*</abbr>
                                    </label>
                                    <select class="country_to_state country_select" id="billing_country" name="method">
                                        <option value="">Select a Payment Method</option>
                                        @foreach(App\Models\Source::all() as $source)
                                            <option @if($source->name == $withdraw->method) selected @endif value="{{$source->name}}">{{$source->name}}</option>
                                        @endforeach
                                    </select>
                                </p>
                            </div>
                        </div>

                        <div class="col-2">
                            <div class="woocommerce-shipping-fields">
                                <div class="shipping_address" style="display: block;">
                                    
                                    <p id="shipping_first_name_field" class="form-row form-row-first validate-required">
                                        <label class="" for="billing_country"> <abbr title="required" class="required">*</abbr>
                                        </label>
                                        <input type="submit" data-value="Update Withdraw" value="Update Withdraw" id="place_order" name="woocommerce_checkout_place_order" class="button alt">
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
@endsection