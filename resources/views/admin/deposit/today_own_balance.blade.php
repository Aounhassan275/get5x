@extends('admin.layout.index')
@section('contents')

<div class="row mb-2 mb-xl-4">
    <div class="col-auto d-none d-sm-block">
    <h3>View User Deposit Request | GET 5X</h3>
    </div>
</div>
<div class="col-12 ">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Today Deposit History Created Through Own Balance</h5>
        </div>
        <table id="datatables-buttons" class="table table-striped">
            <thead>
                <tr>
                    <th style="width:auto;">Sr No.</th>
                    <th style="width:auto;">User Name</th>
                    <th style="width:auto;">User Email</th>
                    <th style="width:auto;">User Package</th>
                    <th style="width:auto;">Deposit Amount</th>
                    <th style="width:auto;">Transction Id</th>
                    <th style="width:auto;">Method</th>
                    <th style="width:auto;">Date</th>
                    <th style="width:auto;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach (App\Models\Deposit::TodayownBalance() as $key => $deposit)
                <tr> 
                <td>{{$key+1}}</td>
                <td>{{$deposit->user->name}}</td>
                <td>{{$deposit->user->email}}</td>
                <td>{{$deposit->package->name}}</td>
                <td>{{$deposit->amount}}</td>
                <td>{{$deposit->payment}}</td>
                <td>{{$deposit->t_id}}</td>
                <td>{{Carbon\Carbon::parse($deposit->updated_at)->format('d M,Y')}}</td>
                <td><a href="{{route('admin.deposit.delete',$deposit->id)}}"><button class="btn btn-danger">Delete</button></a></td>
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