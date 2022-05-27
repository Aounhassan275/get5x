@extends('admin.layout.index')

@section('contents')

<div class="row mb-2 mb-xl-4">
    <div class="col-auto d-none d-sm-block">
    <h3>View Sent Emails | GET 5X</h3>
    </div>
</div>
<div class="col-12 ">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">View Sent Emails </h5>
        </div>
        <table id="datatables-buttons" class="table table-striped">
            <thead>
                <tr>
                    <th style="width:auto;">Sr#</th>
                    <th style="width:auto;">Client Name</th>
                    <th style="width:auto;">Client Email</th>
                    <th style="width:auto;">Message</th>
                    <th style="width:auto;">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach (App\Models\Email::all() as $key => $email)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$email->name}}</td>
                <td>{{$email->email}}</td>
                <td>{{$email->message}}</td>
                <td>
                    <span >Send</span> </button>
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