@extends('user.layout.index')
@section('contents')

<div class="row mb-2 mb-xl-4">
    <div class="col-auto d-none d-sm-block">
    <h3>VIEW WITHDRAW REQUESTS | GET 5X</h3>
    </div>
</div>
<div class="col-12 ">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">View Withdraw Requests </h5>
        </div>
        <table class="table" id="datatables-reponsive">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>User Balance</th>
                    <th>Amount Withdraw</th>
                    <th>Account Name</th>
                    <th>Account Number</th>
                    <th>Method</th>
                    <th>Status</th>
                    <th>Action</th>
                                        <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach (Auth::user()->withdraws as $key => $withdraw)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$withdraw->user->name}}</td>
                    <td>{{$withdraw->user->email}}</td>
                    <td>{{$withdraw->user->balance}}</td>
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
                     @if($withdraw->status=="Completed")
                        @elseif($withdraw->status=="in process")
                        @else
                    <td><a href="{{route('user.withdraw.edit',$withdraw->id)}}"><button class="btn btn-primary">Edit</button></a></td>
                             <td>
                    <form action="{{route('user.withdraw.destroy',$withdraw->id)}}" method="POST">
                        @method('DELETE')
                        @csrf
                    <button class="btn btn-danger">Delete</button>
                    </form>
                </td>
                
                        @endif 
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
        // Datatables Responsive
        $("#datatables-reponsive").DataTable({
            responsive: true
        });
    });
</script>
@endsection