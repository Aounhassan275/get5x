@extends('admin.layout.index')
@section('contents')

<div class="row mb-2 mb-xl-4">
    <div class="col-auto d-none d-sm-block">
    <h3>View Orders | GET 5X</h3>
    </div>
</div>
<div class="col-12 ">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">View Orders</h5>
        </div>
        <table id="datatables-buttons" class="table table-striped">
            <thead>
                <tr>
                    <th style="width:auto;">Sr No.</th>
                    <th style="width:auto;">User Name</th>
                    <th style="width:auto;">User Email</th>
                    <th style="width:auto;">User Phone</th>
                    <th style="width:auto;">Product Name</th>
                    <th style="width:auto;">Product Price</th>
                    <th style="width:auto;">Product Delivery Cost</th>
                    <th style="width:auto;">Addreess</th>
                    <th style="width:auto;">Status</th>
                    <th style="width:auto;">Date</th>
                    <th style="width:auto;">Action</th>
                    <th style="width:auto;">Action</th>
                    <th style="width:auto;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach (App\Models\Order::all() as $key => $order)
                <tr> 
                    <td>{{$key+1}}</td>
                <td>{{$order->user->name}}</td>
                <td>{{$order->user->email}}</td>
                <td>{{$order->user->phone}}</td>
                <td>{{$order->product->name}}</td>
                <td>{{$order->price}}</td>
                <td>{{$order->delivery_cost}}</td>
                <td>{{$order->address}}</td>
                <td>
                    <span class="badge badge-primary">{{$order->status}}</span>
                </td>
                <td>{{Carbon\Carbon::parse($order->created_at)->format('d M,Y')}}</td>
                <td><a href="{{route('admin.order.onhold',$order->id)}}"><button class="btn btn-info">on Hold</button></a></td>
                <td><a href="{{route('admin.order.deliver',$order->id)}}"><button class="btn btn-primary">Deliver</button></a></td>
                <td>
                    <form action="{{route('admin.order.destroy',$order->id)}}" method="POST">
                        @method('DELETE')
                        @csrf
                    <button class="btn btn-danger">Delete</button>
                    </form>
                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(function() {
        // Datatables with Buttons
        var datatablesButtons = $("#datatables-buttons").DataTable({
            responsive: true,
            lengthChange: !1,
            buttons: ["copy", "print"]
        });
        datatablesButtons.buttons().container().appendTo("#datatables-buttons_wrapper .col-md-6:eq(0)");
    });
</script>
@endsection