@extends('admin.layout.index')
@section('contents')

<div class="row mb-2 mb-xl-4">
    <div class="col-auto d-none d-sm-block">
    <h3>VIEW WITHDRAW REQUEST | GET 5X</h3>
    </div>
</div>
<div class="col-12 ">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">View Withdraw Request Table</h5>
        </div>
        <table id="datatables-buttons" class="table table-striped">
            <thead>
                <tr>
                    <th style="width:auto;">#</th>
                    <th style="width:auto;">User Name</th>
                    <th style="width:auto;">Amount Withdraw</th>
                    <th style="width:auto;">Account Name</th>
                    <th style="width:auto;">Account Number</th>
                    <th style="width:auto;">Method</th>
                    <th style="width:auto;">Status</th>
                    <th style="width:auto;">Date</th>
                    <th style="width:auto;">Action</th>
                    <th style="width:auto;">Action</th>
                    <th style="width:auto;">Action</th>
                    <th style="width:auto;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach (App\Models\Withdraw::completed() as $key => $withdraw)
                <tr>
                    <td>{{$key + 1}}</td> 
                    <td>{{$withdraw->user->name}}</td>
                    <td>{{$withdraw->payment}}</td>
                    <td>{{$withdraw->name}}</td>
                    <td>{{$withdraw->account}}</td>
                    <td>{{$withdraw->method}}</td>
                    <td> @if($withdraw->status=="Completed")
                        <span class="badge badge-success">{{$withdraw->status}}</span>
                        @elseif($withdraw->status=="in process")
                        <span class="badge badge-danger">{{$withdraw->status}}</span>
                        @else
                        <span class="badge badge-primary">{{$withdraw->status}}</span>
                        @endif
                    </td>
                    <td>{{Carbon\Carbon::parse($withdraw->created_at)->format('d M,Y')}}</td>
                    <td> <a href="{{route('admin.withdraw.hold',$withdraw->id)}}" class="button"><button class="btn btn-primary"> Hold</button></a></td>
                    <td> <a href="{{route('admin.withdraw.completed',$withdraw->id)}}" class="button"><button class="btn btn-success">Completed</button></a></td>
                    <td> <a href="{{route('admin.withdraw.delete',$withdraw->id)}}" class="button"><button class="btn btn-danger">Delete</button></a></td>   
                    <td> <a href="{{route('admin.user.detail',$withdraw->user_id)}}" class="button"><button class="btn btn-primary"> Detail</button></a></td>        
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