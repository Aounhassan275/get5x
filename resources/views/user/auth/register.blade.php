

@extends('front.layout.index')
@section('meta')
    
<title>REGISTER | GET 5X</title>
<meta name="description" content="Multipurpose HTML template.">
@endsection

@section('content')

<div class="product-big-title-area">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="product-bit-title text-center">
					<h2>REGISTER</h2>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="product-content-right">
                    <div class="woocommerce">
                        <form enctype="multipart/form-data" action="{{route('user.register')}}" class="checkout" method="post" name="checkout">
                            @csrf
                            @if(@$user)
                                <h1>Refer By : {{@$user->name}}</h1>                                
                            @endif
                            <div id="customer_details" class="col2-set">
                                <div class="col-1">
                                    <div class="woocommerce-billing-fields">
                                        <input type="hidden" value="{{$code ?? ''}}" name="code">
                                        <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                            <label class="" for="billing_first_name">User Name <abbr title="required" class="required">*</abbr>
                                            </label>
                                            <input type="text" value="" placeholder="" id="billing_first_name" name="name" class="input-text ">
                                        </p>
                                        <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                            <label class="" for="billing_first_name">Email Address <abbr title="required" class="required">*</abbr>
                                            </label>
                                            <input type="text" value="" placeholder="" id="billing_first_name" name="email" class="input-text ">
                                        </p>
                                        <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                            <label class="" for="billing_first_name">Mobile Phone <abbr title="required" class="required">*</abbr>
                                            </label>
                                            <input type="text"  placeholder="" id="billing_first_name" name="phone" class="input-text ">
                                        </p>

                                        <p id="billing_last_name_field" class="form-row form-row-last validate-required">
                                            <label class="" for="billing_last_name">Password <abbr title="required" class="required">*</abbr>
                                            </label>
                                            <input type="password" value="" placeholder="" id="pwd" minlength="4" name="password" class="input-text ">
                                        </p>
                                        <p id="billing_last_name_field" class="form-row form-row-last validate-required">
                                            <label class="" for="billing_last_name">Confirm Password <abbr title="required" class="required">*</abbr>
                                            </label>
                                            <input type="password" value="" placeholder="" id="pwd" minlength="4" name="confirm_password" class="input-text ">
                                        </p>
                                        <div class="clear"></div>

                                    </div>
                                </div>
                            </div>
                            <div id="order_review" style="position: relative;">


                                <div id="payment">

                                    <div class="form-row place-order">

                                        <input type="submit" data-value="Sign Up" value="Sign Up" id="place_order" name="woocommerce_checkout_place_order" class="button alt">


                                    </div>

                                    <div class="clear"></div>

                                </div>
                            </div>
                        </form>

                    </div>                       
                </div>                    
            </div>
            <div class="col-md-4">
                
                <div class="single-sidebar">
                    <h2 class="sidebar-title">Products</h2>
                    @foreach(App\Models\Product::orderby('created_at','desc')->get()->take(10) as $product)
                    <div class="thubmnail-recent">
                        <img src="{{asset(@$product->images->first()->image)}}" class="recent-thumb" alt="">
                        <h2><a href="{{route('product.show',str_replace(' ', '_',$product->name))}}">{{@$product->name}}</a></h2>
                        <div class="product-sidebar-price">
                            <ins>PKR {{@$product->price}}</ins>                         
                        </div>                             
                    </div>
                    @endforeach
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
@section('scripts')

<script>
    function validatePassword(password) {
        
        // Do not show anything when the length of password is zero.
        if (password.length === 0) {
            document.getElementById("msg").innerHTML = "";
            return;
        }
        // Create an array and push all possible values that you want in password
        var matchedCase = new Array();
        matchedCase.push("[$@$!%*#?&]"); // Special Charector
        matchedCase.push("[A-Z]");      // Uppercase Alpabates
        matchedCase.push("[0-9]");      // Numbers
        matchedCase.push("[a-z]");     // Lowercase Alphabates

        // Check the conditions
        var ctr = 0;
        for (var i = 0; i < matchedCase.length; i++) {
            if (new RegExp(matchedCase[i]).test(password)) {
                ctr++;
            }
        }
        // Display it
        var color = "";
        var strength = "";
        switch (ctr) {
            case 0:
            case 1:
            case 2:
                strength = "Very Weak";
                color = "red";
                break;
            case 3:
                strength = "Medium";
                color = "orange";
                break;
            case 4:
                strength = "Strong";
                color = "green";
                break;
        }
        document.getElementById("msg").innerHTML = strength;
        document.getElementById("msg").style.color = color;
    }
</script>
@endsection