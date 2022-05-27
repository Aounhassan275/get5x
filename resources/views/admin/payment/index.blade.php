@extends('admin.layout.index')
@section('contents')

<div class="row mb-2 mb-xl-4">
    <div class="col-auto d-none d-sm-block">
    <h3>Add Payment Method | GET 5X</h3>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Add Payment Method</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('admin.payment.store')}}" >
                   @csrf
                   <div class="row">
                        <div class="form-group col-6">
                            <label class="form-label">Account Holder Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Account Holder Name" required>
                        </div>
                        <div class="form-group col-6">
                            <label class="form-label">Account Number</label>
                            <input type="number" name="number" class="form-control" placeholder="Enter Account Number" required>
                        </div>
                    </div>   
                    <div class="row">
                        <div class="form-group col-6">
                            <label class="form-label">Payment Method</label>
                            <select name="method" class="form-control" id="" required>
                                <option value="">Select</option>
                                @foreach(App\Models\Source::all() as $source)
                                <option value="{{$source->name}}">{{$source->name}}</option>
                                @endforeach
                            </select>                    
                        </div>
                        <div class="form-group col-6">
                            <label class="form-label">Bank Name</label>
                            <input type="text" name="bank" class="form-control" placeholder="Enter Bank Name">
                        </div>
                    </div>
                     <div class="row">
                        <div class="form-group col-6">
                            <label class="form-label">Receiver Number</label>
                            <input type="number" name="bnumber" class="form-control" placeholder="Enter Receiver Number">
                        </div>
                        <div class="form-group col-6">
                            <label class="form-label">Image</label>
                            <input type="file" name="image" class="form-control" >
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="col-12 ">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">View Accounts Detail</h5>
        </div>
        <table class="table" id="datatables-reponsive">
            <thead>
                <tr>
                    <th style="width:auto;">Sr#</th>
                    <th style="width:auto;">Image</th>
                    <th style="width:auto;">Account Holder Name</th>
                    <th style="width:auto;">Account Number</th>
                    <th style="width:auto;">Payment Method</th>
                    <th style="width:auto;">Bank Name</th>
                    <th style="width:auto;">Receiver Number</th>
                    <th style="width:auto;">Action</th>
                    <th style="width:auto;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach (App\Models\Payment::all() as $key => $payment)
                <tr> 
                    <td>{{$key+1}}</td>
                    <td>
                        @if($payment->image)
                        <img src="{{asset($payment->image)}}" width="50px;" height="50px;">
                        @endif
                    </td>
                    <td>{{$payment->name}}</td>
                    <td>{{$payment->number}}</td>
                    <td>{{$payment->method}}</td>
                    @if ($payment->method =='Bank Account')
                    <td>{{$payment->bank}}</td>
                    <td>{{$payment->bnumber}}</td>
                    @else
                    <td></td>
                    <td></td>
                    @endif
                    <td class="table-action">
                        <button data-toggle="modal" data-target="#edit_modal" name="{{$payment->name}}" 
                            method="{{$payment->method}}" number="{{$payment->number}}" bnumber="{{$payment->bnumber}}" bank="{{$payment->bank}}" id="{{$payment->id}}" class="edit-btn btn"><i class="align-middle" data-feather="edit-2"></i></button>
                    </td>
                    <td class="table-action">
                        {{-- <a href="{{url('poll/delete',$package->id)}}"><i class="align-middle" data-feather="trash"></i></a> --}}
                        <form action="{{route('admin.payment.destroy',$payment->id)}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn"><i class="align-middle" data-feather="trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div id="edit_modal" class="modal fade">
    <div class="modal-dialog">
        <form id="updateForm" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Update Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Account Holder Name</label>
                        <input class="form-control" type="text" id="name" name="name" required>
                    </div>

                    <div class="form-group">
                        <label>Account Number</label>
                        <input class="form-control" type="text" id="number" name="number" required>
                    </div>  
                    <div class="form-group">
                        <label>Payment Method</label>
                        <select name="method" id="method" class="form-control">
                            <option value="">Select</option>
                            @foreach(App\Models\Source::all() as $source)
                            <option value="{{$source->name}}">{{$source->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Bank Name</label>
                        <input type="text" name="bank" class="form-control" id="bank">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Receiver Number</label>
                        <input type="number" name="bnumber" class="form-control" id="bnumber">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        $('.edit-btn').click(function(){
            let id = $(this).attr('id');
            let name = $(this).attr('name');
            let number = $(this).attr('number');
            let method = $(this).attr('method');
            let bank = $(this).attr('bank');
            let bnumber = $(this).attr('bnumber');
            $('#name').val(name);
            $('#number').val(number);
            $('#bnumber').val(bnumber);
            $('#method').val(method);
            $('#bank').val(bank);
            $('#id').val(id);
            $('#updateForm').attr('action','{{route('admin.payment.update','')}}' +'/'+id);
        });
    });
</script>
<script>
    $(function() {
        // Datatables Responsive
        $("#datatables-reponsive").DataTable({
            responsive: true
        });
    });
</script>
@endsection