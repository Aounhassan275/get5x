@extends('user.layout.index')
@section('content')
<div class="product-big-title-area">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="product-bit-title text-center">
					<h2>CREATE WITHDRAW</h2>
				</div>
			</div>
		</div>
	</div>
</div>
@if(Auth::user()->checkWithdrawStatus() == false)
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form enctype="multipart/form-data" action="{{route('user.withdraw.store')}}" class="checkout" method="post" name="checkout">
                    @csrf
                    <div id="customer_details" class="col2-set">
                        <div class="col-1">
                            <div class="woocommerce-billing-fields">
                                <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                    <label class="" for="billing_first_name">Withdraw Payment <abbr title="required" class="required">*</abbr>
                                    </label>
                                    <input type="text"  value="" placeholder="" id="billing_first_name" name="payment" class="input-text ">
                                </p>
                            </div>
                        </div>

                        <div class="col-2">
                            <div class="woocommerce-shipping-fields">
                                <div class="shipping_address" style="display: block;">
                                    
                                    <p id="shipping_first_name_field" class="form-row form-row-first validate-required">
                                        <label class="" for="shipping_first_name">Account Holder Name <abbr title="required" class="required">*</abbr>
                                        </label>
                                        <input type="text" value="" placeholder="" id="shipping_first_name" name="name" class="input-text ">
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
                                        <input type="text" value="" placeholder="" id="shipping_first_name" name="account" class="input-text ">
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
                                            <option value="{{$source->name}}">{{$source->name}}</option>
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
                                        <input type="submit" data-value="Create Withdraw" value="Create Withdraw" id="place_order" name="woocommerce_checkout_place_order" class="button alt">
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
@elseif(Auth::user()->checkWithdrawStatus() == true)
<div class="promo-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="single-promo promo1">
                    <p>
                        Your Package Withdraw Limit is Exceeded.Upgrade Your Package to get more withdraw amount.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End promo area -->
@endif
@if(Auth::user()->package)
<div class="promo-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="single-promo promo2">
                    {{-- <i class="fa fa-truck"></i> --}}
                    <p>Package Subcription</p>
                    <p>{{Auth::user()->package->name}}</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="single-promo promo1">
                    <p>Package Price</p>
                    <p>$ {{number_format(Auth::user()->package->price, 2)}}</p>
                </div>
            </div>
            
            <div class="col-md-4 col-sm-6">
                <div class="single-promo promo3">
                    {{-- <i class="fa fa-lock"></i> --}}
                    <p>Package Active On</p>
                    <p>{{Auth::user()->a_date->format('d M,Y')}}</p>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End promo area -->
<div class="promo-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="single-promo promo1">
                    {{-- <i class="fa fa-truck"></i> --}}
                    <p>Package Withdraw Limit</p>
                    <p>$ {{round(Auth::user()->package->withdraw_limit,2)}}</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="single-promo promo2">
                    <p>Your Withdraw Amount</p>
                    <p>$ {{Auth::user()->withdrawLimit()}}</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="single-promo promo4">
                    <p>Pending Withdraw Amount</p>
                    <p>$ {{Auth::user()->withdrawPending()}}</p>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End promo area -->
@endif
@endsection