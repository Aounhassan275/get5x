
@extends('user.layout.index')
@section('style')
@endsection
@section('content')
<div class="product-big-title-area">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="product-bit-title text-center">
					<h2>RIGHT REFERRALS</h2>
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
                <div id="order_review" style="position: relative;">
                    <table class="shop_table">
                        <thead>
                            <tr>
                                <th>Sr#</th>
                                <th>User Name</th>
                                <th>User Email</th>
                                <th>User Refer By</th>
                                <th>User Type</th>
                                <th>User Status</th>
                                <th>User E-Wallet</th>
                                <th>User AutoShip</th>
                            </tr>
                        </thead>
                        <tfoot>
                            @foreach (Auth::user()->getOrginalRight() as $key => $user)
                            <tr> 
                                <td>{{$key + 1}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->refer_by_name($user->refer_by)}}</td>
                                <td>{{$user->refer_type}}</td>
                                <td>
                                @if ($user->checkstatus() =='old')
                                    <span class="badge badge-success">Active</span>       
                                    @else
                                    <span class="badge badge-danger">Pending</span>                                                      
                                    @endif</td>
                                <td>{{$user->balance}}</td>
                                <td>{{$user->auto_wallet}}</td>
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