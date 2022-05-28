@extends('user.layout.index')
@section('meta')
<title>USER PANEL | GET 5X</title>
<meta name="description" content="Multipurpose HTML template.">
@endsection
@section('content')
<div class="product-big-title-area">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="product-bit-title text-center">
					<h2>DASHBOARD</h2>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="promo-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="single-promo promo1">
                    <p>
                        @foreach (App\Models\Ticker::all() as $ticker)



                        {{$ticker->message}} .
        
                        @endforeach
                    </p>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End promo area -->
<div class="promo-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="single-promo promo1">
                    <p>Available Balance</p>
                    <p>$ {{number_format(Auth::user()->balance, 2)}}</p>
                </div>
            </div>
            @if(Auth::user()->package)
            <div class="col-md-3 col-sm-6">
                <div class="single-promo promo2">
                    {{-- <i class="fa fa-truck"></i> --}}
                    <p>Package Subcription</p>
                    <p>{{Auth::user()->package->name}}</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-promo promo3">
                    {{-- <i class="fa fa-lock"></i> --}}
                    <p>Package Active On</p>
                    <p>{{Auth::user()->a_date->format('d M,Y')}}</p>
                </div>
            </div>
            @endif
            @if(Auth::user()->withdraws)
            <div class="col-md-3 col-sm-6">
                <div class="single-promo promo4">
                    {{-- <i class="fa fa-gift"></i> --}}
                    <p>Total Withdraw</p>
                    <p>$ {{Auth::user()->totalWithdraw()}}</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div> <!-- End promo area -->
<div class="promo-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="single-promo promo1">
                    <p>Total Referal Earning</p>
                    <p>$ {{number_format(Auth::user()->r_earning, 2)}}</p>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="single-promo promo2">
                    {{-- <i class="fa fa-truck"></i> --}}
                    <p>Total Referal</p>
                    <p>{{Auth::user()->refers->count()}}</p>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End promo area -->

@endsection

