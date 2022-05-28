@extends('user.layout.index')
@section('content')
<div class="product-big-title-area">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="product-bit-title text-center">
					<h2>WITHDRAWS</h2>
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
                                <th>Account Name</th>
                                <th>Account Number</th>
                                <th>Amount</th>
                                <th>Method</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            @foreach (Auth::user()->withdraws as $key => $withdraw)
                                <tr class="cart-subtotal">
                                    <td>{{$key+1}}</td>
                                    <td>{{$withdraw->name}}</td>
                                    <td>{{$withdraw->account}}</td>
                                    <td>{{$withdraw->payment}}</td>
                                    <td>{{$withdraw->method}}</td>
                                    <td> @if($withdraw->status=="Completed")
                                        <span class="badge badge-success">{{$withdraw->status}}</span>
                                        @elseif($withdraw->status=="in process")
                                        <span class="badge badge-danger">{{$withdraw->status}}</span>
                                        @else
                                        <span class="badge badge-primary">{{$withdraw->status}}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($withdraw->status=="Completed")
                                        @elseif($withdraw->status=="in process")
                                        @else
                                        <a href="{{route('user.withdraw.edit',$withdraw->id)}}"><button class="btn btn-primary">Edit</button></a>
                                        <form action="{{route('user.withdraw.destroy',$withdraw->id)}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                        <button class="btn btn-danger">Delete</button>
                                        </form>
                                        @endif

                                    </td>
                    
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