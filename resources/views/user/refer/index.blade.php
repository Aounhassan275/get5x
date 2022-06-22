@extends('user.layout.index')
@section('content')
<div class="product-big-title-area">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="product-bit-title text-center">
					<h2>REFERRALS</h2>
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
                <div id="customer_details" class="col2-set">
                    <div class="col-1">
                        <div class="woocommerce-billing-fields">
                            <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                <label class="" for="billing_first_name">Left Refferral Link <abbr title="required" class="required">*</abbr>
                                </label>
                                <input type="text"  value="{{url('user/register',$user->left)}}" placeholder="" id="billing_first_name" name="payment" class="input-text ">
                            </p>
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="woocommerce-shipping-fields">
                            <div class="shipping_address" style="display: block;">
                                
                                <p id="shipping_first_name_field" class="form-row form-row-first validate-required">
                                    <label class="" for="shipping_first_name">Right Referral Link <abbr title="required" class="required">*</abbr>
                                    </label>
                                    <input type="text" value="{{url('user/register',$user->right)}}" placeholder="" id="shipping_first_name" name="name" class="input-text ">
                                </p>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="promo-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <a href="{{url('user/left_refferal')}}">
                    <div class="single-promo promo3" style="color:white;">
                        <p>Left Refferral</p>
                        <p>{{count(Auth::user()->getOrginalLeft())}}</p>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-sm-6">
                <a href="{{url('user/right_refferal')}}">
                    <div class="single-promo promo4" style="color:white;">
                        <p>Right Refferral</p>
                        <p>{{count(Auth::user()->getOrginalRight())}}</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div> <!-- End promo area -->
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Refer By</th>
                                <th>Placement</th>
                                <th>Left Referral</th>
                                <th>Right Referral</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Earning</th>
                            </tr>
                        </thead>
                        <tfoot>
                            @foreach (Auth::user()->all_refer() as $key => $user)
                                <tr class="cart-subtotal">
                                    <td>{{$key + 1}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->phone}}</td>
                                    
                                    <td>
                                        @if($user->refer_by)
                                        {{$user->refer_by_name($user->refer_by)}}
                                        @endif
                                    </td>
                                    <td>{{$user->placement()}}</td>
                                    <td>{{count($user->getOrginalLeft())}}</td>
                                    <td>{{count($user->getOrginalRight())}}</td>
                                    <td>{{$user->refer_type}}</td>
                                    <td>
                                        @if($user->checkstatus() =='old')
                                        <span class="badge badge-success">Active</span>    
                                        @else
                                        <span class="badge badge-danger">Pending</span>                                                      
                                        @endif</td>
                                    <td>{{$user->balance}}</td>
                    
                                </tr>
                            @endforeach
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection