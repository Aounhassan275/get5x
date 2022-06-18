@extends('user.layout.index')
@section('content')
<div class="product-big-title-area">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="product-bit-title text-center">
					<h2>PACKAGES</h2>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            @foreach (App\Models\Package::orderBy('price', 'ASC')->get()->all() as $package)
            <div class="col-md-6">
                <div id="order_review" style="position: relative;">
                    <table class="shop_table">
                        <thead>
                            <tr>
                                <th class="product-name">Package Name</th>
                                <th class="product-total">{{$package->name}}</th>
                            </tr>
                        </thead>
                        <tfoot>

                            <tr class="cart-subtotal">
                                <th>Package Price</th>
                                <td><span class="amount">PKR {{$package->price}} /-</span>
                                </td>
                            </tr>
                            <tr class="cart-subtotal">
                                <th>Direct Income</th>
                                <td><span class="amount">{{$package->matching_income}} %</span>
                                </td>
                            </tr>

                            <tr class="cart-subtotal">
                                <th>Matching Income</th>
                                <td><span class="amount">{{$package->direct_income}} %</span>
                                </td>
                            </tr>
                            <tr class="cart-subtotal">
                                <th>Withdraw Limit</th>
                                <td><span class="amount">PKR {{$package->withdraw_limit}} /-</span>
                                </td>
                            </tr>
                            <tr class="cart-subtotal">
                                <th>Income Limit</th>
                                <td><span class="amount">PKR {{$package->income_limit}} /-</span>
                                </td>
                            </tr>
                            <tr class="cart-subtotal">
                                <th>Action</th>
                                <td>
                                    @if(Auth::user()->package_id == $package->id && Auth::user()->checkStatus() == 'old')
                                    Already Have
                                    @else
                                    <a href="{{route('user.package.payment',$package->id)}}" class="btn btn-lg btn-primary">Purchase</a>
                                    @endif
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