
@extends('user.layout.index')
@section('style')
@endsection
@section('contents')

<div class="row mb-2 mb-xl-4">
    <div class="col-auto d-none d-sm-block">
    <h3>RIGHT REFERRALS | GET 5X</h3>
       
    </div>
</div>
<div class="row">   
    @php
    $total_value = 0;  
    @endphp

    <div class="col-12 ">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">View Referral</h5>
            </div>
            <table id="datatables-buttons" class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>User Refer By</th>
                        <th>User Match Income</th>
                        <th>User Type</th>
                        <th>User Status</th>
                        <th>User Earning</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user->getOrginalRight() as $key => $user)
                    <tr> 
                        <td>{{$key + 1}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->refer_by_name($user->refer_by)}}</td>
                        <td>{{$user->package->price/100 * 5}}</td>
                        <td>{{$user->refer_type}}</td>
                        <td>
                        @if ($user->checkstatus() =='old')
                            <span class="badge badge-success">Active</span>                            
                            @elseif($user->checkstatus() =='expired')
                            <span class="badge badge-primary">Expired</span>  
                            @else
                            <span class="badge badge-danger">Pending</span>                                                      
                            @endif</td>
                        <td>{{$user->balance}}</td>
                    </tr>
                    @php 
                    $total_value = $total_value += $user->package->price/100 * 5;
                    @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>  
    <div class="col-12 ">
        <div class="card">

            <table id="datatables-buttons" class="table table-striped">
                <thead>
                    <tr>
                        <th>RIGHT USER TOTAL MATCHING INCOME:</th>
                        <th>$ {{@$total_value}}</th>
                    </tr>
                </thead>
            </table>
        </div>
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