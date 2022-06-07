@extends('admin.layout.index')
@section('contents')

<div class="row mb-2 mb-xl-4">
    <div class="col-auto d-none d-sm-block">
    <h3>View User Direct Earning | GET 5X</h3>
    </div>
</div>
<div class="col-12 ">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">View Direct Earning</h5>
        </div>
        <table id="datatables-buttons" class="table table-striped">
            <thead>
                <tr>
                    <th style="width:auto;">Sr No.</th>
                    <th style="width:auto;">User Name</th>
                    <th style="width:auto;">User Email</th>
                    <th style="width:auto;">User Package</th>
                    <th style="width:auto;">Earning</th>
                    <th style="width:auto;">Created</th>
                </tr>
            </thead>
            <tbody>
                @foreach (App\Models\Earning::direct_income() as $key => $direct_income)
                <tr> 
                    <td>{{$key+1}}</td>
                    <td>{{$direct_income->user->name}}</td>
                    <td>{{$direct_income->user->email}}</td>
                    <td>{{@$direct_income->user->package->name}}</td>
                    <td>{{$direct_income->price}}</td>
                    <td>{{Carbon\Carbon::parse($direct_income->created_at)->format('d M,Y')}}</td> 
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